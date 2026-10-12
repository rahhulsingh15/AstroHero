<?php

namespace App\Http\Controllers;

use App\Helpers\NumerologyHelper;
use Illuminate\Http\Request;

class NumberologyCalculatorController extends Controller
{
    public function index()
    {
        return view('numerology-calculator');
    }

    public function report(Request $request)
    {
        $name = mb_substr(trim((string) $request->query('name')), 0, 50);
        $report = NumerologyHelper::report($name, (string) $request->query('system'));

        // no name, or a name without any English letters
        if (!$report) {
            return redirect()->route('numerology-calculator');
        }

        return view('numerology-report', compact('name', 'report'));
    }
}
