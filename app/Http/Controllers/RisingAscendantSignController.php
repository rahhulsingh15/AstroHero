<?php

namespace App\Http\Controllers;

use App\Helpers\AscendantHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RisingAscendantSignController extends Controller
{
    public function index()
    {
        return view('rising-ascendant-sign-calculator');
    }

    // Place suggestions for the birth-place box
    public function places(Request $request)
    {
        return response()->json(AscendantHelper::searchPlaces((string) $request->query('q')));
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

        // Without a birth time the Lagna cannot be fixed; noon is used and the report says so
        $timeUnknown = $request->boolean('time_unknown');
        $hour = $timeUnknown ? 12 : ($data['hour'] % 12) + ($data['ampm'] === 'PM' ? 12 : 0);
        $minute = $timeUnknown ? 0 : (int) $data['minute'];

        $birth = Carbon::create($data['year'], $data['month'], $data['day'], $hour, $minute, 0, $data['tz']);

        return view('rising-ascendant-report', [
            'name'        => $data['name'],
            'gender'      => $data['gender'] ?? 'male',
            'birth'       => $birth,
            'place'       => $data['place'],
            'lat'         => (float) $data['lat'],
            'lng'         => (float) $data['lng'],
            'timeUnknown' => $timeUnknown,
            'report'      => AscendantHelper::report($birth, (float) $data['lat'], (float) $data['lng']),
        ]);
    }
}
