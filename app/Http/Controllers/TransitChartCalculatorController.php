<?php

namespace App\Http\Controllers;

use App\Helpers\AscendantHelper;
use App\Helpers\TransitHelper;
use App\Models\TransitChartCalculatorContent;
use App\Models\TransitChartReportContent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransitChartCalculatorController extends Controller
{
    // What each house stands for
    const HOUSE_AREAS = [
        1  => 'Self, health and personality',
        2  => 'Money, family and speech',
        3  => 'Courage, siblings and effort',
        4  => 'Home, mother and peace of mind',
        5  => 'Children, love and learning',
        6  => 'Health, debts and rivals',
        7  => 'Marriage and partnerships',
        8  => 'Sudden changes and obstacles',
        9  => 'Luck, father and dharma',
        10 => 'Career and status',
        11 => 'Gains, income and friends',
        12 => 'Expenses, travel and rest',
    ];

    // Houses from the Moon sign where each planet's transit is traditionally favourable (gochar)
    const GOOD_HOUSES = [
        'Sun'     => [3, 6, 10, 11],
        'Moon'    => [1, 3, 6, 7, 10, 11],
        'Mars'    => [3, 6, 11],
        'Mercury' => [2, 4, 6, 8, 10, 11],
        'Jupiter' => [2, 5, 7, 9, 11],
        'Venus'   => [1, 2, 3, 4, 5, 8, 9, 11, 12],
        'Saturn'  => [3, 6, 11],
        'Rahu'    => [3, 6, 11],
        'Ketu'    => [3, 6, 11],
    ];

    public function index()
    {
        $content = TransitChartCalculatorContent::firstOrNew([]);
        return view('transit-chart-calculator', compact('content'));
    }

    public function report(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:50',
            'gender' => 'nullable|in:male,female',
            'day'    => 'required|integer|between:1,31',
            'month'  => 'required|integer|between:1,12',
            'year'   => 'required|integer|between:1900,' . date('Y'),
            'hour'   => 'required_without:time_unknown|nullable|integer|between:1,12',
            'minute' => 'required_without:time_unknown|nullable|integer|between:0,59',
            'ampm'   => 'required_without:time_unknown|nullable|in:AM,PM',
            'place'  => 'required|string|max:120',
            'lat'    => 'nullable|numeric|between:-90,90',
            'lng'    => 'nullable|numeric|between:-180,180',
            'tz'     => 'nullable|timezone',
        ]);

        if (!checkdate($data['month'], $data['day'], $data['year'])) {
            return back()->withInput()->withErrors(['day' => 'Please choose a valid date of birth.']);
        }

        // Place typed but not picked from the list: look it up here
        if (empty($data['lat']) || empty($data['lng']) || empty($data['tz'])) {
            $match = AscendantHelper::searchPlaces($data['place'], 1)[0] ?? null;

            if (!$match) {
                return back()->withInput()->withErrors(['place' => 'We could not find this place. Please type the city name and pick it from the list.']);
            }

            $data = array_merge($data, ['place' => $match['label'], 'lat' => $match['lat'], 'lng' => $match['lng'], 'tz' => $match['tz']]);
        }

        // Without a birth time the Lagna cannot be fixed; noon is used for the Moon and the Lagna column is left out
        $timeUnknown = $request->boolean('time_unknown');
        $hour = $timeUnknown ? 12 : ($data['hour'] % 12) + ($data['ampm'] === 'PM' ? 12 : 0);
        $minute = $timeUnknown ? 0 : (int) $data['minute'];

        $birth = Carbon::create($data['year'], $data['month'], $data['day'], $hour, $minute, 0, $data['tz']);

        $natal = TransitHelper::siderealAt($birth);
        $moonSign = (int) floor($natal['Moon'] / 30);
        $nakshatra = TransitHelper::NAKSHATRAS[(int) floor($natal['Moon'] / (360 / 27))];

        $lagnaSign = null;
        if (!$timeUnknown) {
            $lagna = fmod(AscendantHelper::tropicalAscendant($birth, (float) $data['lat'], (float) $data['lng']) - TransitHelper::ayanamsa($birth) + 360, 360);
            $lagnaSign = (int) floor($lagna / 30);
        }

        $today = Carbon::today('Asia/Kolkata');
        $house = fn (int $planetSign, int $fromSign) => (($planetSign - $fromSign + 12) % 12) + 1;

        $rows = [];
        foreach (TransitHelper::positions($today) as $planet => $pos) {
            $fromMoon = $house($pos['signIndex'], $moonSign);

            $rows[$planet] = [
                'sign'      => $pos['sign'],
                'degree'    => $pos['degree'],
                'retro'     => $pos['retro'],
                'fromMoon'  => $fromMoon,
                'fromLagna' => $lagnaSign === null ? null : $house($pos['signIndex'], $lagnaSign),
                'area'      => self::HOUSE_AREAS[$fromMoon],
                'good'      => in_array($fromMoon, self::GOOD_HOUSES[$planet]),
            ];
        }

        // Saturn around the Moon sign: Sade Sati (12th, 1st, 2nd) or Dhaiya (4th, 8th)
        $saturn = $rows['Saturn']['fromMoon'];
        $saturnNote = match (true) {
            $saturn === 12 => 'Saturn is in the 12th house from your Moon sign. This is the first phase of Sade Sati.',
            $saturn === 1  => 'Saturn is passing over your Moon sign. This is the middle and strongest phase of Sade Sati.',
            $saturn === 2  => 'Saturn is in the 2nd house from your Moon sign. This is the last phase of Sade Sati.',
            $saturn === 4, $saturn === 8 => 'Saturn is in the ' . $saturn . 'th house from your Moon sign. This period is called Dhaiya (small Panoti).',
            default        => 'You are not under Sade Sati or Dhaiya right now.',
        };

        return view('transit-chart-report', [
            'name'        => $data['name'],
            'birth'       => $birth,
            'place'       => $data['place'],
            'timeUnknown' => $timeUnknown,
            'today'       => $today,
            'content'     => TransitChartReportContent::firstOrNew([]),
            'moon'        => ['sign' => TransitHelper::SIGNS[$moonSign], 'hindi' => AscendantHelper::HINDI[$moonSign], 'symbol' => AscendantHelper::SYMBOLS[$moonSign]],
            'lagna'       => $lagnaSign === null ? null : ['sign' => TransitHelper::SIGNS[$lagnaSign], 'hindi' => AscendantHelper::HINDI[$lagnaSign], 'symbol' => AscendantHelper::SYMBOLS[$lagnaSign]],
            'nakshatra'   => $nakshatra,
            'rows'        => $rows,
            'saturnNote'  => $saturnNote,
            'inSadeSati'  => in_array($saturn, [12, 1, 2]),
            'areas'       => self::HOUSE_AREAS,
        ]);
    }
}
