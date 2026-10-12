<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Kaal Sarp Dosh from the real Rahu-Ketu axis at birth, and Shani Sade Sati
 * from the real dates on which Saturn changes sign (sidereal, Lahiri).
 */
class DoshaHelper
{
    // Type of Kaal Sarp Dosh by the house of Rahu: [name, areas of life it presses on]
    const KAAL_SARP_TYPES = [
        1  => ['Anant', 'With Rahu in the 1st house and Ketu in the 7th, the pressure falls on self-confidence, health and married life. Success comes through your own long effort, and partnerships need patience.'],
        2  => ['Kulik', 'With Rahu in the 2nd house and Ketu in the 8th, the pressure falls on savings, family harmony and speech. Money comes and goes, and care is needed with health and harsh words.'],
        3  => ['Vasuki', 'With Rahu in the 3rd house and Ketu in the 9th, the pressure falls on relations with brothers and sisters and on luck. You work harder than others for the same result, but courage is your strength.'],
        4  => ['Shankhpal', 'With Rahu in the 4th house and Ketu in the 10th, the pressure falls on peace at home, mother, property and career stability. Changes of residence or job are common.'],
        5  => ['Padma', 'With Rahu in the 5th house and Ketu in the 11th, the pressure falls on education, love affairs and children. Gains come late, and speculation should be avoided.'],
        6  => ['Mahapadma', 'With Rahu in the 6th house and Ketu in the 12th, the pressure falls on health, debts and hidden opponents. You do defeat your rivals in the end, but expenses stay high.'],
        7  => ['Takshak', 'With Rahu in the 7th house and Ketu in the 1st, the pressure falls on marriage and business partnerships. Choose partners carefully and avoid hasty decisions in relationships.'],
        8  => ['Karkotak', 'With Rahu in the 8th house and Ketu in the 2nd, the pressure falls on inheritance, family wealth and sudden events. Avoid risky ventures and look after your health.'],
        9  => ['Shankhachur', 'With Rahu in the 9th house and Ketu in the 3rd, the pressure falls on luck, father and higher education. Fortune rises after repeated attempts, and respect for elders helps.'],
        10 => ['Ghatak', 'With Rahu in the 10th house and Ketu in the 4th, the pressure falls on career, reputation and dealings with authority. Work brings ups and downs, and peace at home needs attention.'],
        11 => ['Vishdhar', 'With Rahu in the 11th house and Ketu in the 5th, the pressure falls on income, elder brothers and sisters and children. Earnings fluctuate, though the later years are usually comfortable.'],
        12 => ['Sheshnag', 'With Rahu in the 12th house and Ketu in the 6th, the pressure falls on expenses, sleep and hidden enemies. Foreign lands can bring gains, and legal matters need care.'],
    ];

    // House of Saturn from the Moon => phase of Sade Sati
    const SADE_SATI_PHASES = [
        12 => ['Rising phase', 'Saturn is in the 12th sign from your Moon. Expenses, travel and changes of place are common, and old matters come up to be settled.'],
        1  => ['Peak phase', 'Saturn is over your Moon sign. This phase is usually felt most strongly, with pressure on health, the mind and close relationships.'],
        2  => ['Setting phase', 'Saturn is in the 2nd sign from your Moon. Attention moves to money, family and speech, and the pressure slowly eases.'],
    ];

    // The two shorter periods of Saturn, of about two and a half years each
    const DHAIYA_PHASES = [
        4 => ['Kantaka Shani (4th from Moon)', 'Home, mother, property and peace of mind'],
        8 => ['Ashtama Shani (8th from Moon)', 'Health, sudden obstacles and hidden worries'],
    ];

    private static function rev(float $x): float
    {
        $x = fmod($x, 360);
        return $x < 0 ? $x + 360 : $x;
    }

    /**
     * Kaal Sarp Dosh: all seven planets on one side of the Rahu-Ketu axis.
     */
    public static function kaalSarp(Carbon $birth, float $lat, float $lng): array
    {
        $chart = KundliHelper::chart($birth, $lat, $lng);
        $planets = $chart['planets'];
        $rahu = $planets['Rahu']['lon'];

        // Which half each planet is in: going forward through the zodiac from Rahu to Ketu, or from Ketu to Rahu
        $afterRahu = [];
        $afterKetu = [];
        foreach (['Sun', 'Moon', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn'] as $name) {
            self::rev($planets[$name]['lon'] - $rahu) < 180 ? $afterRahu[] = $name : $afterKetu[] = $name;
        }

        $smaller = count($afterRahu) < count($afterKetu) ? $afterRahu : $afterKetu;
        $level = [0 => 'full', 1 => 'partial'][count($smaller)] ?? 'none';

        [$type, $effect] = self::KAAL_SARP_TYPES[$planets['Rahu']['house']];

        if ($level === 'full') {
            $status = $type . ' Kaal Sarp Dosh';
            $summary = 'All seven planets are on one side of the Rahu-Ketu axis in your birth chart, so Kaal Sarp Dosh is present.';
        } elseif ($level === 'partial') {
            $status = 'Partial Kaal Sarp Dosh';
            $summary = 'Six of the seven planets are on one side of the Rahu-Ketu axis and only ' . $smaller[0] . ' is outside it. This is called a partial (Anshik) Kaal Sarp Dosh, and its effect is much milder.';
        } else {
            $status = 'No Kaal Sarp Dosh';
            $summary = 'The planets are spread on both sides of the Rahu-Ketu axis in your birth chart, so there is no Kaal Sarp Dosh.';
        }

        return [
            'level'     => $level,
            'status'    => $status,
            'summary'   => $summary,
            'type'      => $type,
            'effect'    => $effect,
            'lagna'     => $chart['lagna'],
            'planets'   => $planets,
            'houses'    => KundliHelper::houses($chart['lagna']['signIndex'], array_map(fn ($p) => $p['signIndex'], $planets)),
            'afterRahu' => $afterRahu,
            'afterKetu' => $afterKetu,
            'outside'   => $level === 'partial' ? $smaller[0] : null,
            // planets between Ketu and Rahu are moving towards Rahu, the mouth of the serpent
            'towardsRahu' => count($afterKetu) > count($afterRahu),
            // close to a sign boundary, where a few minutes' error in the birth time changes the houses
            'nearCusp'  => $chart['lagna']['inSign'] < 1.5 || $chart['lagna']['inSign'] > 28.5,
        ];
    }

    private static function saturnSign(int $ts): int
    {
        return (int) floor(TransitHelper::siderealAt(Carbon::createFromTimestamp($ts))['Saturn'] / 30);
    }

    /**
     * Every stay of Saturn in a sign between two moments, including its retrograde returns.
     * [['sign' => 10, 'start' => timestamp, 'end' => timestamp], ...]
     */
    private static function saturnPeriods(int $from, int $to): array
    {
        $step = 10 * 86400;
        $periods = [];
        $start = $from;
        $sign = self::saturnSign($from);

        for ($t = $from; $t < $to; $t += $step) {
            $nextSign = self::saturnSign($t + $step);
            if ($nextSign === $sign) continue;

            // Narrow the change of sign down to the hour
            [$lo, $hi] = [$t, $t + $step];
            while ($hi - $lo > 3600) {
                $mid = intdiv($lo + $hi, 2);
                self::saturnSign($mid) === $sign ? $lo = $mid : $hi = $mid;
            }

            $periods[] = ['sign' => $sign, 'start' => $start, 'end' => $hi];
            $start = $hi;
            $sign = $nextSign;
        }

        return $periods;
    }

    /**
     * Sade Sati and Dhaiya periods for the first hundred years of life.
     */
    public static function sadeSati(Carbon $birth): array
    {
        $moon = KundliHelper::point(TransitHelper::siderealAt($birth)['Moon']);
        $birthTs = $birth->getTimestamp();
        $nowTs = Carbon::now()->getTimestamp();

        $date = fn (int $ts) => Carbon::createFromTimestamp($ts, $birth->timezone);

        $sadeSati = [];
        $dhaiya = [];
        $cycle = 0;
        $lastEnd = null;

        foreach (self::saturnPeriods($birthTs, $birth->copy()->addYears(100)->getTimestamp()) as $period) {
            $house = ($period['sign'] - $moon['signIndex'] + 12) % 12 + 1;

            $row = [
                'sign'      => TransitHelper::SIGNS[$period['sign']],
                'start'     => $date($period['start']),
                'end'       => $date($period['end']),
                'fromBirth' => $period['start'] === $birthTs,
                'status'    => $period['end'] <= $nowTs ? 'past' : ($period['start'] <= $nowTs ? 'current' : 'upcoming'),
            ];

            if (isset(self::SADE_SATI_PHASES[$house])) {
                // A gap of more than three years means Saturn has gone round and a new Sade Sati has begun
                if ($lastEnd === null || $period['start'] - $lastEnd > 3 * 365 * 86400) $cycle++;
                $lastEnd = $period['end'];

                [$phase, $text] = self::SADE_SATI_PHASES[$house];
                $sadeSati[] = $row + ['phase' => $phase, 'text' => $text, 'cycle' => $cycle];
            } elseif (isset(self::DHAIYA_PHASES[$house])) {
                [$phase, $area] = self::DHAIYA_PHASES[$house];
                $dhaiya[] = $row + ['phase' => $phase, 'area' => $area];
            }
        }

        // First and last day of each complete Sade Sati
        $cycles = [];
        foreach ($sadeSati as $row) {
            $cycles[$row['cycle']]['start'] ??= $row['start'];
            $cycles[$row['cycle']]['fromBirth'] ??= $row['fromBirth'];
            $cycles[$row['cycle']]['end'] = $row['end'];
        }
        foreach ($cycles as &$c) {
            $c['status'] = $c['end']->getTimestamp() <= $nowTs ? 'past' : ($c['start']->getTimestamp() <= $nowTs ? 'current' : 'upcoming');
        }
        unset($c);

        $rows = collect($sadeSati);

        return [
            'moon'          => $moon,
            'saturnSign'    => TransitHelper::SIGNS[self::saturnSign($nowTs)],
            'rows'          => $sadeSati,
            'cycles'        => $cycles,
            'dhaiya'        => $dhaiya,
            'current'       => $rows->firstWhere('status', 'current'),
            'currentCycle'  => collect($cycles)->firstWhere('status', 'current'),
            'next'          => $rows->firstWhere('status', 'upcoming'),
            'currentDhaiya' => collect($dhaiya)->firstWhere('status', 'current'),
            // the Moon crosses one degree in about two hours
            'nearCusp'      => $moon['inSign'] < 1 || $moon['inSign'] > 29,
        ];
    }
}
