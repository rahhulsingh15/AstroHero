<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AgeCalculatorController extends Controller
{
    public function index()
    {
        return view('age-calculator');
    }

    public function report(Request $request)
    {
        $data = $request->validate([
            'day'      => 'required|integer|between:1,31',
            'month'    => 'required|integer|between:1,12',
            'year'     => 'required|integer|between:1900,' . date('Y'),
            'on_day'   => 'required|integer|between:1,31',
            'on_month' => 'required|integer|between:1,12',
            'on_year'  => 'required|integer|between:1900,' . date('Y'),
        ]);

        if (!checkdate($data['month'], $data['day'], $data['year'])) {
            return back()->withInput()->withErrors(['day' => 'Please choose a valid date of birth.']);
        }

        if (!checkdate($data['on_month'], $data['on_day'], $data['on_year'])) {
            return back()->withInput()->withErrors(['on_day' => 'Please choose a valid "Age as on" date.']);
        }

        $birth = Carbon::create($data['year'], $data['month'], $data['day']);
        $on = Carbon::create($data['on_year'], $data['on_month'], $data['on_day']);

        if ($birth->gt($on)) {
            return back()->withInput()->withErrors(['on_day' => 'The "Age as on" date cannot be before the date of birth.']);
        }

        $age = $birth->diff($on);
        $totalDays = (int) $age->days;

        // Next birthday on or after the "as on" date
        $next = $this->birthdayIn($birth, $on->year);
        if ($next->lt($on)) {
            $next = $this->birthdayIn($birth, $on->year + 1);
        }

        return view('age-report', [
            'birth'       => $birth,
            'on'          => $on,
            'years'       => $age->y,
            'months'      => $age->m,
            'days'        => $age->d,
            'totalMonths' => $age->y * 12 + $age->m,
            'totalWeeks'  => intdiv($totalDays, 7),
            'totalDays'   => $totalDays,
            'totalHours'  => $totalDays * 24,
            'next'        => $next,
            'daysToNext'  => (int) $on->diffInDays($next),
            'turning'     => $next->year - $birth->year,
        ]);
    }

    // Birthday in a given year; someone born on 29 February gets 1 March in a non-leap year
    private function birthdayIn(Carbon $birth, int $year): Carbon
    {
        return checkdate($birth->month, $birth->day, $year)
            ? Carbon::create($year, $birth->month, $birth->day)
            : Carbon::create($year, 3, 1);
    }
}
