<?php

namespace App\Http\Controllers;

use App\Helpers\NumerologyHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MulankCalculatorController extends Controller
{
    public function index()
    {
        return view('mulank-calculator');
    }

    public function report(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:50', 'regex:/[a-z]/i'],
            'day'   => 'required|integer|between:1,31',
            'month' => 'required|integer|between:1,12',
            'year'  => 'required|integer|between:1900,' . date('Y'),
        ], [
            'name.regex' => 'Please enter the name in English letters.',
        ]);

        if (!checkdate($data['month'], $data['day'], $data['year'])) {
            return back()->withInput()->withErrors(['day' => 'Please choose a valid date of birth.']);
        }

        $name = trim($data['name']);

        return view('mulank-report', [
            'name'   => $name,
            'birth'  => Carbon::create($data['year'], $data['month'], $data['day']),
            'report' => NumerologyHelper::mulank((int) $data['day'], (int) $data['month'], (int) $data['year']),
            // Name number (Namank) from the same Chaldean chart the Numerology Calculator uses
            'namank' => NumerologyHelper::report($name, 'chaldean')['destiny'],
        ]);
    }
}
