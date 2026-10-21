<?php

namespace App\Http\Controllers;

use App\Helpers\AscendantHelper;
use App\Helpers\DoshaHelper;
use App\Helpers\FreeKundliHelper;
use App\Helpers\JaiminiHelper;
use App\Helpers\KundliHelper;
use App\Helpers\KundliMatchingHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Report pages of the calculators that work from the birth details
 * (name, date, time and place of birth).
 */
class KundliCalculatorController extends Controller
{
    public function freeKundli()
    {
        return view('free-kundli');
    }

    public function freeKundliReport(Request $request)
    {
        $input = $this->birthInput($request);
        $report = FreeKundliHelper::generateReport(
            $input['birth'],
            $input['lat'],
            $input['lng'],
            $input['name'],
            $input['gender'],
            $input['place'],
            $input['timeUnknown']
        );

        return view('free-kundli-report', $input + ['report' => $report]);
    }

    public function freeKundliPdf(Request $request)
    {
        $input = $this->birthInput($request);
        $report = FreeKundliHelper::generateReport(
            $input['birth'],
            $input['lat'],
            $input['lng'],
            $input['name'],
            $input['gender'],
            $input['place'],
            $input['timeUnknown']
        );

        return view('free-kundli-pdf', $input + ['report' => $report]);
    }

    // Kundli Matching: both birth charts, Ashtakoot Guna Milan and Manglik check
    public function kundliMatchingReport(Request $request)
    {
        $you = $this->birthInput($request, 'you_');
        $partner = $this->birthInput($request, 'partner_');

        $build = fn (array $in) => FreeKundliHelper::generateReport($in['birth'], $in['lat'], $in['lng'], $in['name'], $in['gender'], $in['place'], $in['timeUnknown']);
        $youReport = $build($you);
        $partnerReport = $build($partner);

        // Guna Milan reads the boy's and the girl's charts in fixed roles
        $swap = $you['gender'] === 'female' && $partner['gender'] !== 'female';
        [$boy, $girl] = $swap ? [$partnerReport, $youReport] : [$youReport, $partnerReport];

        return view('kundli-matching-report', [
            'boy'   => $boy,
            'girl'  => $girl,
            'match' => KundliMatchingHelper::match($boy, $girl),
        ]);
    }

    public function guideHowToReadKundli()
    {
        return view('guides.how-to-read-kundli');
    }

    public function guideHowToReadHouses()
    {
        return view('guides.how-to-read-houses-in-kundli');
    }

    public function guideHowToReadPlanets()
    {
        return view('guides.how-to-read-planets-in-astrology');
    }

    public function guidePlanetsSignsHouses()
    {
        return view('guides.planets-signs-houses-in-astrology');
    }

    public function guidePlanetsSignsSignificance()
    {
        return view('guides.planets-signs-and-their-significance-in-astrology');
    }

    public function atmakarakaDarakaraka(Request $request)
    {
        $input = $this->birthInput($request);

        return view('atmakaraka-darakaraka-report', $input + ['report' => JaiminiHelper::report($input['birth'])]);
    }

    public function sunSign(Request $request)
    {
        $input = $this->birthInput($request);

        return view('sun-sign-report', $input + ['report' => KundliHelper::sunSign($input['birth'])]);
    }

    public function rashi(Request $request)
    {
        $input = $this->birthInput($request);

        return view('rashi-report', $input + ['report' => KundliHelper::rashi($input['birth'])]);
    }

    public function nakshatra(Request $request)
    {
        $input = $this->birthInput($request);

        return view('nakshatra-report', $input + ['report' => KundliHelper::nakshatra($input['birth'])]);
    }

    public function sadeSati(Request $request)
    {
        $input = $this->birthInput($request);

        return view('shani-sade-sati-report', $input + ['report' => DoshaHelper::sadeSati($input['birth'])]);
    }

    public function birthChart(Request $request)
    {
        $input = $this->birthInput($request);

        return view('birth-chart-report', $input + ['report' => KundliHelper::birthChart($input['birth'], $input['lat'], $input['lng'])]);
    }

    public function kaalSarpDosh(Request $request)
    {
        $input = $this->birthInput($request);

        return view('kaal-sarp-dosh-report', $input + ['report' => DoshaHelper::kaalSarp($input['birth'], $input['lat'], $input['lng'])]);
    }

    public function ishtaDevataCalculator()
    {
        $content = \App\Models\IshtaDevataCalculatorContent::firstOrNew([]);
        return view('ishta-devata-calculator', compact('content'));
    }

    public function ishtaDevata(Request $request)
    {
        $input = $this->birthInput($request);
        $content = \App\Models\IshtaDevataReportContent::firstOrNew([]);

        return view('ishta-devata-report', $input + [
            'content' => $content,
            'report'  => JaiminiHelper::ishtaDevata($input['birth']),
        ]);
    }

    /**
     * Checks the birth form and returns name, gender, birth moment, place and coordinates.
     * A wrong value sends the visitor back to the form with the message.
     */
    private function birthInput(Request $request, string $p = ''): array
    {
        // Free Kundli needs a time or the "don't know" tick; matching treats an empty time as unknown
        $timeRule = $p === '' ? 'required_without:time_unknown|nullable' : 'nullable';
        $rules = [
            'name'   => 'required|string|max:50',
            'gender' => 'nullable|in:male,female,other',
            'day'    => 'required|integer|between:1,31',
            'month'  => 'required|integer|between:1,12',
            'year'   => 'required|integer|between:1900,' . date('Y'),
            'hour'   => $timeRule . '|integer|between:1,12',
            'minute' => $timeRule . '|integer|between:0,59',
            'ampm'   => $timeRule . '|in:AM,PM',
            'place'  => 'required|string|max:120',
            'lat'    => 'nullable|numeric|between:-90,90',
            'lng'    => 'nullable|numeric|between:-180,180',
            'tz'     => 'nullable|timezone',
        ];
        $who = $p === 'you_' ? 'your' : ($p === 'partner_' ? "partner's" : '');
        $attributes = [];
        foreach (array_keys($rules) as $k) {
            $attributes[$p . $k] = trim($who . ' ' . str_replace('_', ' ', $k));
        }
        $validated = $request->validate(array_combine(array_map(fn ($k) => $p . $k, array_keys($rules)), $rules), [], $attributes);
        $data = [];
        foreach (array_keys($rules) as $k) {
            $data[$k] = $validated[$p . $k] ?? null;
        }

        if (!checkdate($data['month'], $data['day'], $data['year'])) {
            throw ValidationException::withMessages([$p . 'day' => 'Please choose a valid date of birth' . ($who ? " ($who details)." : '.')]);
        }

        // Place typed but not picked from the list: look it up here
        if (empty($data['lat']) || empty($data['lng']) || empty($data['tz'])) {
            $match = AscendantHelper::searchPlaces($data['place'], 1)[0] ?? null;

            if (!$match) {
                throw ValidationException::withMessages([$p . 'place' => 'We could not find "' . $data['place'] . '". Please type the city name and pick it from the list.']);
            }

            $data = array_merge($data, ['place' => $match['label'], 'lat' => $match['lat'], 'lng' => $match['lng'], 'tz' => $match['tz']]);
        }

        // Without a birth time noon is used and the report says so
        $timeUnknown = $request->boolean($p . 'time_unknown') || ($p !== '' && $data['hour'] === null);
        $hour = $timeUnknown ? 12 : ($data['hour'] % 12) + (($data['ampm'] ?? 'AM') === 'PM' ? 12 : 0);
        $minute = $timeUnknown ? 0 : (int) $data['minute'];

        return [
            'name'        => $data['name'],
            'gender'      => $data['gender'] ?? 'male',
            'birth'       => Carbon::create($data['year'], $data['month'], $data['day'], $hour, $minute, 0, $data['tz']),
            'place'       => $data['place'],
            'lat'         => (float) $data['lat'],
            'lng'         => (float) $data['lng'],
            'timeUnknown' => $timeUnknown,
        ];
    }
}
