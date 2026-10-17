<?php

namespace App\Http\Controllers;

use App\Helpers\NumerologyHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\FlamesCalculatorContent;
use App\Models\FlamesReportContent;
use App\Models\FriendshipCalculatorContent;
use App\Models\FriendshipReportContent;

/**
 * Report pages of the calculators that work from names, numbers and the date of birth.
 */
class NumerologyToolsController extends Controller
{
    const NAME_RULE = ['required', 'string', 'max:50', 'regex:/[a-z]/i'];

    const DATE_RULES = [
        'day'   => 'required|integer|between:1,31',
        'month' => 'required|integer|between:1,12',
    ];

    public function flamesCalculator()
    {
        $content = FlamesCalculatorContent::firstOrNew([]);
        return view('flames-calculator', compact('content'));
    }

    public function flames(Request $request)
    {
        [$name1, $name2] = $this->twoNames($request);
        $report = NumerologyHelper::flames($name1, $name2);

        if (!$report) {
            throw ValidationException::withMessages(['name2' => 'Both names have exactly the same letters, so nothing is left to count. Try adding a surname.']);
        }

        $content = FlamesReportContent::firstOrNew([]);
        return view('flames-report', compact('name1', 'name2', 'report', 'content'));
    }

    public function friendshipCalculator()
    {
        $content = FriendshipCalculatorContent::firstOrNew([]);
        return view('friendship-calculator', compact('content'));
    }

    public function friendship(Request $request)
    {
        [$name1, $name2] = $this->twoNames($request);
        $content = FriendshipReportContent::firstOrNew([]);

        return view('friendship-report', compact('name1', 'name2', 'content') + ['report' => NumerologyHelper::friendship($name1, $name2)]);
    }

    public function nameCompatibility(Request $request)
    {
        [$name1, $name2] = $this->twoNames($request);

        return view('name-compatibility-report', compact('name1', 'name2') + ['report' => NumerologyHelper::nameCompatibility($name1, $name2)]);
    }

    public function destinyNumber(Request $request)
    {
        $data = $this->validated($request, ['name' => self::NAME_RULE]);
        $name = trim($data['name']);

        return view('destiny-number-report', [
            'name'   => $name,
            'birth'  => $this->birth($data),
            'report' => NumerologyHelper::destiny($name, (int) $data['day'], (int) $data['month'], (int) $data['year']),
        ]);
    }

    public function loShuGrid(Request $request)
    {
        $data = $this->validated($request);

        return view('lo-shu-grid-report', [
            'birth'  => $this->birth($data),
            'report' => NumerologyHelper::loShu((int) $data['day'], (int) $data['month'], (int) $data['year']),
        ]);
    }

    public function mobileNumber(Request $request)
    {
        $data = $this->validated($request, ['mobile' => 'required|digits:10'], ['mobile.digits' => 'Please enter a 10-digit mobile number.']);

        return view('mobile-number-numerology-report', [
            'mobile' => $data['mobile'],
            'birth'  => $this->birth($data),
            'report' => NumerologyHelper::mobile($data['mobile'], (int) $data['day'], (int) $data['month'], (int) $data['year']),
        ]);
    }

    public function vehicleNumber(Request $request)
    {
        $data = $this->validated($request, ['vehicle' => 'required|string|max:15']);
        $report = NumerologyHelper::vehicle($data['vehicle'], (int) $data['day'], (int) $data['month'], (int) $data['year']);

        if (!$report) {
            throw ValidationException::withMessages(['vehicle' => 'Please enter a vehicle number that has digits in it, e.g. DL3CAB1234.']);
        }

        return view('lucky-vehicle-number-report', ['birth' => $this->birth($data), 'report' => $report]);
    }

    public function luckyName(Request $request)
    {
        $data = $this->validated($request, ['name' => self::NAME_RULE, 'system' => 'nullable|in:cheiro,chaldean,pythagorean']);
        $name = trim($data['name']);

        return view('lucky-name-numerology-report', [
            'name'   => $name,
            'birth'  => $this->birth($data),
            'report' => NumerologyHelper::luckyName($name, $data['system'] ?? 'chaldean', (int) $data['day'], (int) $data['month'], (int) $data['year']),
        ]);
    }

    // Both names of a two-name form, each with at least one English letter
    private function twoNames(Request $request): array
    {
        $data = $request->validate(['name1' => self::NAME_RULE, 'name2' => self::NAME_RULE], [
            'name1.regex' => 'Please enter the names in English letters.',
            'name2.regex' => 'Please enter the names in English letters.',
        ]);

        return [trim($data['name1']), trim($data['name2'])];
    }

    // Date of birth plus whatever else the form has
    private function validated(Request $request, array $rules = [], array $messages = []): array
    {
        $data = $request->validate($rules + self::DATE_RULES + ['year' => 'required|integer|between:1900,' . date('Y')], $messages + [
            'name.regex' => 'Please enter the name in English letters.',
        ]);

        if (!checkdate($data['month'], $data['day'], $data['year'])) {
            throw ValidationException::withMessages(['day' => 'Please choose a valid date of birth.']);
        }

        return $data;
    }

    private function birth(array $data): Carbon
    {
        return Carbon::create($data['year'], $data['month'], $data['day']);
    }
}
