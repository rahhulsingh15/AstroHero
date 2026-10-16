<?php

namespace App\Http\Controllers;

use App\Helpers\AscendantHelper;
use App\Helpers\MoonPhaseHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MoonPhaseCalculatorContent;
use App\Models\MoonPhaseReportContent;

class MoonPhaseCalculatorController extends Controller
{
    public function index()
    {
        $content = MoonPhaseCalculatorContent::firstOrNew([]);
        return view('moon-phase-calculator', compact('content'));
    }

    public function report(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:50',
            'gender' => 'nullable|in:male,female,other',
            'dob'    => 'required|date_format:Y-m-d|after_or_equal:1900-01-01|before_or_equal:today',
            'tob'    => 'nullable|date_format:H:i',
            'place'  => 'required|string|max:120',
            'lat'    => 'nullable|numeric|between:-90,90',
            'lng'    => 'nullable|numeric|between:-180,180',
            'tz'     => 'nullable|timezone',
        ], [], ['dob' => 'date of birth', 'tob' => 'time of birth']);

        // Place typed but not picked from the list: look it up here
        if (empty($data['lat']) || empty($data['lng']) || empty($data['tz'])) {
            $match = AscendantHelper::searchPlaces($data['place'], 1)[0] ?? null;

            if (!$match) {
                return back()->withInput()->withErrors(['place' => 'We could not find this place. Please type the city name and pick it from the list.']);
            }

            $data = array_merge($data, ['place' => $match['label'], 'tz' => $match['tz']]);
        }

        // Without a birth time noon is used and the report says so
        $timeUnknown = empty($data['tob']);
        $birth = Carbon::parse($data['dob'] . ' ' . ($timeUnknown ? '12:00' : $data['tob']), $data['tz']);

        return view('moon-phase-calculator-report', [
            'name'        => $data['name'],
            'birth'       => $birth,
            'place'       => $data['place'],
            'timeUnknown' => $timeUnknown,
            'content'     => MoonPhaseReportContent::firstOrNew([]),
            'report'      => MoonPhaseHelper::report($birth),
        ]);
    }
}
