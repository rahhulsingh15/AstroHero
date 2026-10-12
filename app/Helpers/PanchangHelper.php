<?php

namespace App\Helpers;

use Carbon\Carbon;

class PanchangHelper
{
    public static function getTodayPanchang($lat = 19.0760, $lng = 72.8777, $locationName = 'Mumbai, India')
    {
        $today = Carbon::now();

        // 1. Sunrise & Sunset (PHP Built-in Astronomical Calculation)
        $sunInfo = date_sun_info($today->timestamp, $lat, $lng);
        $sunrise = date("H:i", $sunInfo['sunrise']);
        $sunset  = date("H:i", $sunInfo['sunset']);

        // 2. Approximate Astronomical Tithi Calculation (Lunar Day Algorithm)
        // 360 degrees / 30 tithis = 12 degrees per tithi
        $knownNewMoon = Carbon::create(2000, 1, 6, 18, 14, 0); // Reference new moon
        $diffDays = $today->floatDiffInDays($knownNewMoon);
        $synodicMonth = 29.53058867; // Lunar month days
        $phase = fmod($diffDays, $synodicMonth);
        $tithiIndex = (int) floor(($phase / $synodicMonth) * 30) + 1;

        $tithiNames = [
            1 => 'Pratipada', 2 => 'Dwitiya', 3 => 'Tritiya', 4 => 'Chaturthi',
            5 => 'Panchami', 6 => 'Shashthi', 7 => 'Saptami', 8 => 'Ashtami',
            9 => 'Navami', 10 => 'Dashami', 11 => 'Ekadashi', 12 => 'Dwadashi',
            13 => 'Trayodashi', 14 => 'Chaturdashi', 15 => 'Purnima',
            16 => 'Pratipada', 17 => 'Dwitiya', 18 => 'Tritiya', 19 => 'Chaturthi',
            20 => 'Panchami', 21 => 'Shashthi', 22 => 'Saptami', 23 => 'Ashtami',
            24 => 'Navami', 25 => 'Dashami', 26 => 'Ekadashi', 27 => 'Dwadashi',
            28 => 'Trayodashi', 29 => 'Chaturdashi', 30 => 'Amavasya'
        ];

        $paksha = ($tithiIndex <= 15) ? 'Shukla Paksha' : 'Krishna Paksha';
        $currentTithi = ($tithiNames[$tithiIndex] ?? 'Pratipada') . ' (' . $paksha . ')';

        // 3. Nakshatra calculation (27 Nakshatras across 27.32166 days)
        $nakshatras = [
            'Ashwini', 'Bharani', 'Krittika', 'Rohini', 'Mrigashirsha', 'Ardra',
            'Punarvasu', 'Pushya', 'Ashlesha', 'Magha', 'Purva Phalguni', 'Uttara Phalguni',
            'Hasta', 'Chitra', 'Swati', 'Vishakha', 'Anuradha', 'Jyeshtha',
            'Mula', 'Purva Ashadha', 'Uttara Ashadha', 'Shravana', 'Dhanishta',
            'Shatabhisha', 'Purva Bhadrapada', 'Uttara Bhadrapada', 'Revati'
        ];
        $siderealMonth = 27.32166;
        $nakshatraIndex = (int) floor(fmod($diffDays, $siderealMonth) / $siderealMonth * 27);
        $currentNakshatra = $nakshatras[$nakshatraIndex] ?? 'Ashwini';

        return [
            'location'       => $locationName,
            'tithi'          => $currentTithi,
            'sunrise'        => $sunrise,
            'sunset'         => $sunset,
            'nakshatra'      => $currentNakshatra,
            'paksha'         => $paksha,
            'day'            => $today->format('d'),
            'month'          => strtoupper($today->format('M')),
            'year'           => $today->format('Y'),
        ];
    }
}