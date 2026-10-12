<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Mangal (Manglik / Kuja) Dosha from the real position of Mars at birth,
 * checked from the Lagna, the Moon and Venus (whole-sign houses, Lahiri).
 */
class MangalDoshaHelper
{
    // Houses where Mars gives the dosha
    const DOSHA_HOUSES = [1, 2, 4, 7, 8, 12];

    const ORDINALS = [1 => '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th'];

    // What Mars does in each dosha house
    const HOUSE_EFFECTS = [
        1  => 'Mars in the 1st house makes the nature fiery, impatient and dominating, which can cause ego clashes with the partner.',
        2  => 'Mars in the 2nd house brings harsh speech and disputes within the family, and can disturb savings.',
        4  => 'Mars in the 4th house disturbs peace at home and can cause friction over property or with in-laws.',
        7  => 'Mars in the 7th house, the house of marriage, brings strong friction with the partner and can delay marriage.',
        8  => 'Mars in the 8th house affects marital happiness and the health of the partnership, and brings sudden ups and downs.',
        12 => 'Mars in the 12th house increases expenses and distance between partners and can disturb sleep and peace of mind.',
    ];

    // Lagna-chart house => signs in which Mars there does not give the dosha
    const SIGN_EXCEPTIONS = [
        2  => ['Gemini', 'Virgo'],
        4  => ['Aries', 'Scorpio'],
        7  => ['Cancer', 'Capricorn'],
        8  => ['Sagittarius', 'Pisces'],
        12 => ['Taurus', 'Libra'],
    ];

    // House of a planet counted from a reference sign (1-12)
    private static function house(int $planetSign, int $fromSign): int
    {
        return (($planetSign - $fromSign + 12) % 12) + 1;
    }

    /**
     * Full Mangal Dosha report for a birth moment and place.
     */
    public static function report(Carbon $birth, float $lat, float $lng): array
    {
        $planets = TransitHelper::siderealAt($birth);
        $lagna = fmod(AscendantHelper::tropicalAscendant($birth, $lat, $lng) - TransitHelper::ayanamsa($birth) + 360, 360);

        $sign = fn (float $lon) => (int) floor($lon / 30);
        $marsSign = $sign($planets['Mars']);
        $marsSignName = TransitHelper::SIGNS[$marsSign];

        // "Virgo (6th sign)": the rashi with its number counted from Aries
        $label = fn (int $index) => TransitHelper::SIGNS[$index] . ' (' . self::ORDINALS[$index + 1] . ' sign)';

        // Mars counted from the Lagna, the Moon and Venus
        $charts = [];
        foreach (['Lagna' => $lagna, 'Moon' => $planets['Moon'], 'Venus' => $planets['Venus']] as $name => $lon) {
            $house = self::house($marsSign, $sign($lon));
            $charts[$name] = [
                'sign'      => TransitHelper::SIGNS[$sign($lon)],
                'signLabel' => $label($sign($lon)),
                'house'     => $house,
                'ordinal'   => self::ORDINALS[$house],
                'manglik'   => in_array($house, self::DOSHA_HOUSES),
            ];
        }

        $present = $charts['Lagna']['manglik'] || $charts['Moon']['manglik'] || $charts['Venus']['manglik'];

        // How the dosha is formed, chart by chart
        $formation = [];
        foreach ($charts as $name => $chart) {
            if ($chart['manglik']) {
                $formation[] = 'Counted from your ' . $name . ' in ' . $chart['sign'] . ', Mars falls in the ' . $chart['ordinal'] . ' house, which is a dosha house.';
            }
        }

        $jupiterSign = $sign($planets['Jupiter']);
        $moonSign = $sign($planets['Moon']);

        // Classical conditions that cancel the dosha: [['title' => ..., 'detail' => ...]]
        $cancellations = [];
        if ($present) {
            if (in_array($marsSignName, ['Aries', 'Scorpio'])) {
                $cancellations[] = [
                    'title'  => 'Mars is in its own sign, ' . $marsSignName . '.',
                    'detail' => 'Aries and Scorpio are ruled by Mars itself. A planet in its own sign is comfortable and behaves well, so Mars gives courage and drive here instead of conflict in married life.',
                ];
            }
            if ($marsSignName === 'Capricorn') {
                $cancellations[] = [
                    'title'  => 'Mars is exalted in Capricorn.',
                    'detail' => 'Capricorn is the sign where Mars is at its best. An exalted Mars is disciplined and constructive, so its harmful side does not show.',
                ];
            }
            if (in_array($marsSignName, ['Gemini', 'Virgo'])) {
                $cancellations[] = [
                    'title'  => 'Mars is in ' . $marsSignName . ', which is an enemy sign.',
                    'detail' => $marsSignName . ' is ruled by Mercury, the enemy of Mars. In an enemy sign Mars loses its strength and cannot give the full result of the dosha.',
                ];
            }
            if ($jupiterSign === $marsSign) {
                $cancellations[] = [
                    'title'  => 'Mars is together with Jupiter in ' . $marsSignName . '.',
                    'detail' => 'Jupiter is the greatest benefic. When it sits with Mars, its wisdom and calm take control of the aggression of Mars.',
                ];
            } elseif (in_array(self::house($marsSign, $jupiterSign), [5, 7, 9])) {
                $cancellations[] = [
                    'title'  => 'Mars is aspected by Jupiter.',
                    'detail' => 'Jupiter is in ' . TransitHelper::SIGNS[$jupiterSign] . ' and looks at the 5th, 7th and 9th signs from itself. Mars in ' . $marsSignName . ' is the ' . self::ORDINALS[self::house($marsSign, $jupiterSign)] . ' from Jupiter, so it receives Jupiter\'s benefic sight, which calms the dosha.',
                ];
            }
            if ($moonSign === $marsSign) {
                $cancellations[] = [
                    'title'  => 'Mars is together with the Moon in ' . $marsSignName . ' (Chandra-Mangal Yoga).',
                    'detail' => 'The Moon with Mars forms Chandra-Mangal Yoga, a combination for wealth and energy, which turns the force of Mars towards gains instead of quarrels.',
                ];
            } elseif (self::house($marsSign, $moonSign) === 7) {
                $cancellations[] = [
                    'title'  => 'Mars is completely aspected by the Moon, which is a benefic planet.',
                    'detail' => 'The Moon is in ' . TransitHelper::SIGNS[$moonSign] . ', exactly opposite Mars in ' . $marsSignName . '. Every planet fully aspects the 7th sign from itself, so the cool and gentle Moon looks straight at Mars and softens it.',
                ];
            }
            if ($charts['Lagna']['manglik'] && in_array($marsSignName, self::SIGN_EXCEPTIONS[$charts['Lagna']['house']] ?? [])
                && !in_array($marsSignName, ['Aries', 'Scorpio', 'Capricorn', 'Gemini', 'Virgo'])) {
                $cancellations[] = [
                    'title'  => 'Mars in the ' . $charts['Lagna']['ordinal'] . ' house is in ' . $marsSignName . '.',
                    'detail' => 'The classical texts make an exception for this placement: Mars in the ' . $charts['Lagna']['ordinal'] . ' house does not give the dosha when the sign there is ' . $marsSignName . '.',
                ];
            }
        }

        if (!$present) {
            $status = 'Non-Manglik';
            $level = 'none';
            $summary = 'Mars is not in the 1st, 2nd, 4th, 7th, 8th or 12th house from your Lagna, Moon or Venus, so there is no Mangal Dosha in your chart.';
        } elseif ($cancellations) {
            $status = 'Mangal Dosha Cancelled';
            $level = 'cancelled';
            $summary = 'Mars sits in a dosha house (counted from your Lagna, Moon or Venus), but the dosha is cancelled by the conditions listed below, so it should not trouble your married life.';
        } elseif ($charts['Lagna']['manglik'] && $charts['Moon']['manglik']) {
            $status = 'High Manglik';
            $level = 'high';
            $summary = 'Mars is in a dosha house from both your Lagna and your Moon, which makes this a strong (Purna) Mangal Dosha.';
        } elseif ($charts['Lagna']['manglik']) {
            $status = 'Manglik';
            $level = 'medium';
            $summary = 'Mars is in the ' . $charts['Lagna']['ordinal'] . ' house from your Lagna, which forms Mangal Dosha in your birth chart.';
        } else {
            $status = 'Mild Manglik (Anshik)';
            $level = 'low';
            $summary = 'Mars is not in a dosha house from your Lagna, but it is from your ' . ($charts['Moon']['manglik'] ? 'Moon' : 'Venus') . ', which forms a mild (Anshik) Mangal Dosha.';
        }

        $inSign = fmod($planets['Mars'], 30);
        $lagnaInSign = fmod($lagna, 30);

        return [
            'status'        => $status,
            'level'         => $level,
            'safe'          => in_array($level, ['none', 'cancelled']),
            'summary'       => $summary,
            'present'       => $present,
            'cancellations' => $cancellations,
            'formation'     => $formation,
            'charts'        => $charts,
            'marsSign'      => $marsSignName,
            'marsSignLabel' => $label($marsSign),
            'jupiterSignLabel' => $label($jupiterSign),
            'marsDegree'    => (int) floor($inSign),
            'marsMinute'    => (int) floor(($inSign - floor($inSign)) * 60),
            'effect'        => $charts['Lagna']['manglik'] ? self::HOUSE_EFFECTS[$charts['Lagna']['house']] : null,
            // close to a sign boundary, where a few minutes' error in the birth time changes the houses
            'nearCusp'      => $lagnaInSign < 1.5 || $lagnaInSign > 28.5,
        ];
    }
}
