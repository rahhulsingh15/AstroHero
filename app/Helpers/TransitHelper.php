<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Real planetary transits (sidereal / Lahiri) calculated astronomically,
 * so horoscope text is written from actual graha positions.
 */
class TransitHelper
{
    const SIGNS = [
        'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
        'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces',
    ];

    const NAKSHATRAS = [
        'Ashwini', 'Bharani', 'Krittika', 'Rohini', 'Mrigashirsha', 'Ardra',
        'Punarvasu', 'Pushya', 'Ashlesha', 'Magha', 'Purva Phalguni', 'Uttara Phalguni',
        'Hasta', 'Chitra', 'Swati', 'Vishakha', 'Anuradha', 'Jyeshtha',
        'Mula', 'Purva Ashadha', 'Uttara Ashadha', 'Shravana', 'Dhanishta',
        'Shatabhisha', 'Purva Bhadrapada', 'Uttara Bhadrapada', 'Revati',
    ];

    const TITHIS = [
        'Pratipada', 'Dwitiya', 'Tritiya', 'Chaturthi', 'Panchami', 'Shashthi', 'Saptami', 'Ashtami',
        'Navami', 'Dashami', 'Ekadashi', 'Dwadashi', 'Trayodashi', 'Chaturdashi',
    ];

    const PLANETS = ['Sun', 'Moon', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn', 'Rahu', 'Ketu'];

    private static function rev(float $x): float
    {
        $x = fmod($x, 360);
        return $x < 0 ? $x + 360 : $x;
    }

    // Days since 2000 Jan 0.0 UT
    private static function dayNumber(Carbon $dt): float
    {
        return $dt->getTimestamp() / 86400 + 2440587.5 - 2451543.5;
    }

    // Keplerian orbit -> ecliptic [longitude, latitude, radius]
    private static function orbit(float $N, float $i, float $w, float $a, float $e, float $M): array
    {
        $Mr = deg2rad($M);
        $E = $Mr + $e * sin($Mr) * (1 + $e * cos($Mr));
        for ($k = 0; $k < 10; $k++) {
            $E = $E - ($E - $e * sin($E) - $Mr) / (1 - $e * cos($E));
        }

        $xv = $a * (cos($E) - $e);
        $yv = $a * sqrt(1 - $e * $e) * sin($E);
        $r = hypot($xv, $yv);
        $vw = atan2($yv, $xv) + deg2rad($w);

        $Nr = deg2rad($N);
        $ir = deg2rad($i);
        $xh = $r * (cos($Nr) * cos($vw) - sin($Nr) * sin($vw) * cos($ir));
        $yh = $r * (sin($Nr) * cos($vw) + cos($Nr) * sin($vw) * cos($ir));
        $zh = $r * sin($vw) * sin($ir);

        return [self::rev(rad2deg(atan2($yh, $xh))), rad2deg(atan2($zh, hypot($xh, $yh))), $r];
    }

    // Periodic terms of the Moon's longitude: [D, M, M', F, coefficient in 0.000001°] (Meeus, Astronomical Algorithms, table 47.A)
    const MOON_TERMS = [
        [0, 0, 1, 0, 6288774], [2, 0, -1, 0, 1274027], [2, 0, 0, 0, 658314], [0, 0, 2, 0, 213618],
        [0, 1, 0, 0, -185116], [0, 0, 0, 2, -114332], [2, 0, -2, 0, 58793], [2, -1, -1, 0, 57066],
        [2, 0, 1, 0, 53322], [2, -1, 0, 0, 45758], [0, 1, -1, 0, -40923], [1, 0, 0, 0, -34720],
        [0, 1, 1, 0, -30383], [2, 0, 0, -2, 15327], [0, 0, 1, 2, -12528], [0, 0, 1, -2, 10980],
        [4, 0, -1, 0, 10675], [0, 0, 3, 0, 10034], [4, 0, -2, 0, 8548], [2, 1, -1, 0, -7888],
        [2, 1, 0, 0, -6766], [1, 0, -1, 0, -5163], [1, 1, 0, 0, 4987], [2, -1, 1, 0, 4036],
        [2, 0, 2, 0, 3994], [4, 0, 0, 0, 3861], [2, 0, -3, 0, 3665], [0, 1, -2, 0, -2689],
        [2, 0, -1, 2, -2602], [2, -1, -2, 0, 2390], [1, 0, 1, 0, -2348], [2, -2, 0, 0, 2236],
        [0, 1, 2, 0, -2120], [0, 2, 0, 0, -2069], [2, -2, -1, 0, 2048], [2, 0, 1, -2, -1773],
        [2, 0, 0, 2, -1595], [4, -1, -1, 0, 1215], [0, 0, 2, 2, -1110], [3, 0, -1, 0, -892],
        [2, 1, 1, 0, -810], [4, -1, -2, 0, 759], [0, 2, -1, 0, -713], [2, 2, -1, 0, -700],
        [2, 1, -2, 0, 691], [2, -1, 0, -2, 596], [4, 0, 1, 0, 549], [0, 0, 4, 0, 537],
        [4, -1, 0, 0, 520], [1, 0, -2, 0, -487], [2, 1, 0, -2, -399], [0, 0, 2, -2, -381],
        [1, 1, 1, 0, 351], [3, 0, -2, 0, -340], [4, 0, -3, 0, 330], [2, -1, 2, 0, 327],
        [0, 2, 1, 0, -323], [1, 1, -1, 0, 299], [2, 0, 3, 0, 294],
    ];

    // Seconds by which clock time (UT) lags uniform Terrestrial Time
    private static function deltaT(Carbon $dt): float
    {
        $y = $dt->getTimestamp() / 31557600 + 1970;
        $table = [1900 => -2.8, 1920 => 21.2, 1940 => 24.3, 1960 => 33.1, 1980 => 50.5, 2000 => 63.8, 2020 => 69.4, 2040 => 72.0];

        $years = array_keys($table);
        if ($y <= $years[0]) return $table[$years[0]];

        for ($i = 1; $i < count($years); $i++) {
            if ($y <= $years[$i]) {
                $from = $years[$i - 1];
                return $table[$from] + ($table[$years[$i]] - $table[$from]) * ($y - $from) / 20;
            }
        }

        return end($table);
    }

    /**
     * Geocentric tropical longitude of the Moon (mean equinox of date), good to about 10 arc-seconds.
     * $T = Julian centuries of Terrestrial Time from J2000.0.
     */
    public static function moonLongitude(float $T): float
    {
        $L = 218.3164477 + 481267.88123421 * $T - 0.0015786 * $T ** 2 + $T ** 3 / 538841 - $T ** 4 / 65194000;
        $D = 297.8501921 + 445267.1114034 * $T - 0.0018819 * $T ** 2 + $T ** 3 / 545868 - $T ** 4 / 113065000;
        $M = 357.5291092 + 35999.0502909 * $T - 0.0001536 * $T ** 2 + $T ** 3 / 24490000;
        $Mp = 134.9633964 + 477198.8675055 * $T + 0.0087414 * $T ** 2 + $T ** 3 / 69699 - $T ** 4 / 14712000;
        $F = 93.2720950 + 483202.0175233 * $T - 0.0036539 * $T ** 2 - $T ** 3 / 3526000 + $T ** 4 / 863310000;

        // Terms with the Sun's anomaly shrink as the Earth's orbit becomes rounder
        $E = 1 - 0.002516 * $T - 0.0000074 * $T ** 2;

        $sum = 0;
        foreach (self::MOON_TERMS as [$d, $m, $mp, $f, $coef]) {
            $sum += $coef * $E ** abs($m) * sin(deg2rad($d * $D + $m * $M + $mp * $Mp + $f * $F));
        }

        // Pulls of Venus and Jupiter, and the flattening of the Earth
        $sum += 3958 * sin(deg2rad(119.75 + 131.849 * $T))
            + 1962 * sin(deg2rad($L - $F))
            + 318 * sin(deg2rad(53.09 + 479264.290 * $T));

        return self::rev($L + $sum / 1000000);
    }

    // Geocentric tropical longitudes (degrees) of the nine grahas
    private static function tropicalLongitudes(Carbon $dt): array
    {
        $d = self::dayNumber($dt);
        $sin = fn ($deg) => sin(deg2rad($deg));
        $cos = fn ($deg) => cos(deg2rad($deg));

        // Sun
        $ws = 282.9404 + 4.70935E-5 * $d;
        $Ms = self::rev(356.0470 + 0.9856002585 * $d);
        [$lonSun, , $rs] = self::orbit(0, 0, $ws, 1, 0.016709 - 1.151E-9 * $d, $Ms);
        $xs = $rs * $cos($lonSun);
        $ys = $rs * $sin($lonSun);

        // Moon: full lunar series, because dasha dates need it to a few arc-seconds
        $Nm = self::rev(125.1228 - 0.0529538083 * $d);
        $jdTT = $dt->getTimestamp() / 86400 + 2440587.5 + self::deltaT($dt) / 86400;
        $lonMoon = self::moonLongitude(($jdTT - 2451545.0) / 36525);

        // [N, i, w, a, e, M]
        $elements = [
            'Mercury' => [48.3313 + 3.24587E-5 * $d, 7.0047 + 5.00E-8 * $d, 29.1241 + 1.01444E-5 * $d, 0.387098, 0.205635 + 5.59E-10 * $d, 168.6562 + 4.0923344368 * $d],
            'Venus'   => [76.6799 + 2.46590E-5 * $d, 3.3946 + 2.75E-8 * $d, 54.8910 + 1.38374E-5 * $d, 0.723330, 0.006773 - 1.302E-9 * $d, 48.0052 + 1.6021302244 * $d],
            'Mars'    => [49.5574 + 2.11081E-5 * $d, 1.8497 - 1.78E-8 * $d, 286.5016 + 2.92961E-5 * $d, 1.523688, 0.093405 + 2.516E-9 * $d, 18.6021 + 0.5240207766 * $d],
            'Jupiter' => [100.4542 + 2.76854E-5 * $d, 1.3030 - 1.557E-7 * $d, 273.8777 + 1.64505E-5 * $d, 5.20256, 0.048498 + 4.469E-9 * $d, 19.8950 + 0.0830853001 * $d],
            'Saturn'  => [113.6634 + 2.38980E-5 * $d, 2.4886 - 1.081E-7 * $d, 339.3939 + 2.97661E-5 * $d, 9.55475, 0.055546 - 9.499E-9 * $d, 316.9670 + 0.0334442282 * $d],
        ];

        $Mj = self::rev($elements['Jupiter'][5]);
        $Msat = self::rev($elements['Saturn'][5]);

        $lon = ['Sun' => $lonSun, 'Moon' => self::rev($lonMoon)];

        foreach ($elements as $name => [$N, $i, $w, $a, $e, $M]) {
            [$l, $b, $r] = self::orbit($N, $i, $w, $a, $e, self::rev($M));

            if ($name === 'Jupiter') {
                $l += -0.332 * $sin(2 * $Mj - 5 * $Msat - 67.6)
                    - 0.056 * $sin(2 * $Mj - 2 * $Msat + 21)
                    + 0.042 * $sin(3 * $Mj - 5 * $Msat + 21)
                    - 0.036 * $sin($Mj - 2 * $Msat)
                    + 0.022 * $cos($Mj - $Msat)
                    + 0.023 * $sin(2 * $Mj - 3 * $Msat + 52)
                    - 0.016 * $sin($Mj - 5 * $Msat - 69);
            } elseif ($name === 'Saturn') {
                $l += 0.812 * $sin(2 * $Mj - 5 * $Msat - 67.6)
                    - 0.229 * $cos(2 * $Mj - 4 * $Msat - 2)
                    + 0.119 * $sin($Mj - 2 * $Msat - 3)
                    + 0.046 * $sin(2 * $Mj - 6 * $Msat - 69)
                    + 0.014 * $sin($Mj - 3 * $Msat + 32);
            }

            $xg = $r * $cos($l) * $cos($b) + $xs;
            $yg = $r * $sin($l) * $cos($b) + $ys;
            $lon[$name] = self::rev(rad2deg(atan2($yg, $xg)));
        }

        $lon['Rahu'] = $Nm;
        $lon['Ketu'] = self::rev($Nm + 180);

        return $lon;
    }

    public static function ayanamsa(Carbon $dt): float
    {
        return 23.857092 + 0.0139688 * ((self::dayNumber($dt) - 1.5) / 365.25);
    }

    // Sidereal longitude (0-360) of every graha at an exact moment, e.g. a time of birth
    public static function siderealAt(Carbon $dt): array
    {
        $ayan = self::ayanamsa($dt);

        return array_map(fn ($lon) => self::rev($lon - $ayan), self::tropicalLongitudes($dt));
    }

    // Sunrise-ish reference moment (06:00 IST) for a calendar date
    public static function moment(Carbon $date): Carbon
    {
        return Carbon::parse($date->toDateString() . ' 06:00:00', 'Asia/Kolkata');
    }

    /**
     * Sidereal position of every graha for a date.
     * [planet => ['sign' => 'Virgo', 'signIndex' => 5, 'degree' => 16, 'retro' => false]]
     */
    public static function positions(Carbon $date): array
    {
        $dt = self::moment($date);
        $ayan = self::ayanamsa($dt);
        $now = self::tropicalLongitudes($dt);
        $next = self::tropicalLongitudes($dt->copy()->addDay());

        $out = [];
        foreach (self::PLANETS as $p) {
            $sid = self::rev($now[$p] - $ayan);
            $idx = (int) floor($sid / 30);
            $motion = self::rev($next[$p] - $now[$p] + 180) - 180;

            $out[$p] = [
                'sign'      => self::SIGNS[$idx],
                'signIndex' => $idx,
                'degree'    => (int) floor(fmod($sid, 30)),
                'retro'     => in_array($p, ['Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn']) && $motion < 0,
            ];
        }

        return $out;
    }

    // Tithi, paksha, nakshatra and Moon sign for a date
    public static function panchang(Carbon $date): array
    {
        $dt = self::moment($date);
        $lon = self::tropicalLongitudes($dt);
        $elong = self::rev($lon['Moon'] - $lon['Sun']);
        $tithiNo = (int) floor($elong / 12) + 1; // 1..30

        if ($tithiNo === 15) {
            $tithi = 'Purnima';
        } elseif ($tithiNo === 30) {
            $tithi = 'Amavasya';
        } else {
            $tithi = self::TITHIS[($tithiNo - 1) % 15];
        }

        $moonSid = self::rev($lon['Moon'] - self::ayanamsa($dt));

        return [
            'tithi'      => $tithi,
            'paksha'     => $tithiNo <= 15 ? 'Shukla Paksha' : 'Krishna Paksha',
            'nakshatra'  => self::NAKSHATRAS[(int) floor($moonSid / (360 / 27))],
            'moonSign'   => self::SIGNS[(int) floor($moonSid / 30)],
            'elongation' => $elong,
        ];
    }

    /**
     * Sign changes between two dates (inclusive).
     * [['planet' => 'Venus', 'date' => Carbon, 'from' => 'Virgo', 'to' => 'Libra'], ...]
     */
    public static function ingresses(Carbon $from, Carbon $to, array $planets): array
    {
        $events = [];
        $prev = self::positions($from->copy()->subDay());

        for ($day = $from->copy(); $day->lte($to); $day->addDay()) {
            $cur = self::positions($day);
            foreach ($planets as $p) {
                if ($cur[$p]['signIndex'] !== $prev[$p]['signIndex']) {
                    $events[] = ['planet' => $p, 'date' => $day->copy(), 'from' => $prev[$p]['sign'], 'to' => $cur[$p]['sign']];
                }
            }
            $prev = $cur;
        }

        return $events;
    }

    // Purnima / Amavasya dates between two dates (inclusive)
    public static function moonPhases(Carbon $from, Carbon $to): array
    {
        $events = [];
        $prev = self::panchang($from)['elongation'];

        // The phase completes between the previous sunrise and this one, so it belongs to the previous day
        for ($day = $from->copy()->addDay(); $day->lte($to->copy()->addDay()); $day->addDay()) {
            $cur = self::panchang($day)['elongation'];
            if ($prev < 180 && $cur >= 180) {
                $events[] = ['phase' => 'Purnima (Full Moon)', 'date' => $day->copy()->subDay()];
            } elseif ($cur < $prev) {
                $events[] = ['phase' => 'Amavasya (New Moon)', 'date' => $day->copy()->subDay()];
            }
            $prev = $cur;
        }

        return $events;
    }

    // Abhijit Muhurat (8th muhurta of the day, centred on local noon) in IST
    public static function abhijitMuhurat(Carbon $date, float $lat = 28.6139, float $lng = 77.2090): string
    {
        $noon = Carbon::parse($date->toDateString() . ' 12:00:00', 'Asia/Kolkata');
        $sun = date_sun_info($noon->getTimestamp(), $lat, $lng);
        $half = ($sun['sunset'] - $sun['sunrise']) / 30;

        $start = Carbon::createFromTimestamp((int) ($sun['transit'] - $half), 'Asia/Kolkata');
        $end = Carbon::createFromTimestamp((int) ($sun['transit'] + $half), 'Asia/Kolkata');

        return $start->format('h:i A') . ' - ' . $end->format('h:i A');
    }
}
