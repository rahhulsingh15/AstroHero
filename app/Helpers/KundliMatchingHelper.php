<?php

namespace App\Helpers;

/**
 * Ashtakoot Guna Milan (36 points) from the Moon of the boy and the girl,
 * with the standard tables used by AstroSage / AstroTalk.
 */
class KundliMatchingHelper
{
    const VARNA_RANK = ['Brahmin' => 4, 'Kshatriya' => 3, 'Vaishya' => 2, 'Shudra' => 1];

    const VASHYA_INDEX = ['Chatushpada' => 0, 'Manav' => 1, 'Jalchar' => 2, 'Vanchar' => 3, 'Keet' => 4];
    // [boy][girl]
    const VASHYA = [
        [2, 1, 1, 0.5, 1],
        [1, 2, 0.5, 0, 1],
        [1, 0.5, 2, 1, 1],
        [0.5, 0, 1, 2, 0],
        [1, 1, 1, 0, 2],
    ];

    const YONI_NAMES = ['Horse', 'Elephant', 'Sheep', 'Serpent', 'Dog', 'Cat', 'Rat', 'Cow', 'Buffalo', 'Tiger', 'Deer', 'Monkey', 'Mongoose', 'Lion'];
    // Yoni of each nakshatra, Ashwini first
    const NAK_YONI = [0, 1, 2, 3, 3, 4, 5, 2, 5, 6, 6, 7, 8, 9, 8, 9, 10, 10, 4, 11, 12, 11, 13, 0, 13, 7, 1];
    const YONI = [
        [4, 2, 2, 3, 2, 2, 2, 1, 0, 1, 3, 3, 2, 1],
        [2, 4, 3, 3, 2, 2, 2, 2, 3, 1, 2, 3, 2, 0],
        [2, 3, 4, 2, 1, 2, 1, 3, 3, 1, 2, 0, 3, 1],
        [3, 3, 2, 4, 2, 1, 1, 1, 1, 2, 2, 2, 0, 2],
        [2, 2, 1, 2, 4, 2, 1, 2, 2, 1, 0, 2, 1, 1],
        [2, 2, 2, 1, 2, 4, 0, 2, 2, 1, 3, 3, 2, 1],
        [2, 2, 1, 1, 1, 0, 4, 2, 2, 2, 2, 2, 1, 2],
        [1, 2, 3, 1, 2, 2, 2, 4, 3, 0, 3, 2, 2, 1],
        [0, 3, 3, 1, 2, 2, 2, 3, 4, 1, 2, 2, 2, 1],
        [1, 1, 1, 2, 1, 1, 2, 0, 1, 4, 1, 1, 2, 1],
        [3, 2, 2, 2, 0, 3, 2, 3, 2, 1, 4, 2, 2, 1],
        [3, 3, 0, 2, 2, 3, 2, 2, 2, 1, 2, 4, 3, 2],
        [2, 2, 3, 0, 1, 2, 1, 2, 2, 2, 2, 3, 4, 2],
        [1, 0, 1, 2, 1, 1, 2, 1, 1, 1, 1, 2, 2, 4],
    ];

    const GANA_INDEX = ['Dev' => 0, 'Manushya' => 1, 'Rakshasa' => 2];
    // [boy][girl]
    const GANA = [[6, 6, 1], [5, 6, 0], [1, 0, 6]];

    const TARA_NAMES = [1 => 'Janma', 'Sampat', 'Vipat', 'Kshema', 'Pratyak', 'Sadhana', 'Vadha', 'Mitra', 'Ati-Mitra'];

    const AREAS = [
        'Varna'        => 'Work',
        'Vashya'       => 'Dominance',
        'Tara'         => 'Destiny',
        'Yoni'         => 'Mentality',
        'Graha Maitri' => 'Compatibility',
        'Gan'          => 'Guna Level',
        'Bhakoot'      => 'Love',
        'Nadi'         => 'Health',
    ];

    const MEANING = [
        'Varna'        => 'Varna shows the spiritual and working temperament of the couple, and how well their egos sit together.',
        'Vashya'       => 'Vashya shows mutual attraction and who influences whom in the relationship.',
        'Tara'         => 'Tara compares the birth stars for health, luck and the well-being of both partners after marriage.',
        'Yoni'         => 'Yoni shows physical and intimate compatibility, based on the animal nature of each birth star.',
        'Graha Maitri' => 'Graha Maitri compares the lords of both Moon signs to show mental friendship and how easily the couple agrees.',
        'Gan'          => 'Gan compares temperament: Dev (gentle), Manushya (balanced) and Rakshasa (strong-willed).',
        'Bhakoot'      => 'Bhakoot compares the Moon signs for emotional bond, family welfare and prosperity.',
        'Nadi'         => 'Nadi relates to health and children. The same Nadi in both charts is traditionally avoided.',
    ];

    private static function relation(string $a, string $b): string
    {
        if ($a === $b) return 'self';
        if (in_array($b, KundliHelper::FRIENDS[$a])) return 'friend';
        if (in_array($b, KundliHelper::ENEMIES[$a])) return 'enemy';
        return 'neutral';
    }

    private static function grahaMaitri(string $boyLord, string $girlLord): float
    {
        if ($boyLord === $girlLord) return 5;
        $pair = [self::relation($boyLord, $girlLord), self::relation($girlLord, $boyLord)];
        sort($pair);
        return match (implode('-', $pair)) {
            'friend-friend' => 5,
            'friend-neutral' => 4,
            'neutral-neutral' => 3,
            'enemy-friend' => 1,
            'enemy-neutral' => 0.5,
            default => 0,
        };
    }

    private static function tara(int $from, int $to): int
    {
        $count = ($to - $from + 27) % 27 + 1;
        $r = $count % 9;
        return $r === 0 ? 9 : $r;
    }

    /**
     * $boy / $girl: FreeKundliHelper reports (Moon, avakhada and Mangal dosha are read from them).
     */
    public static function match(array $boy, array $girl): array
    {
        $bm = $boy['planets']['Moon'];
        $gm = $girl['planets']['Moon'];
        $ba = $boy['avakhada'];
        $ga = $girl['avakhada'];

        // 1. Varna
        $varna = self::VARNA_RANK[$ba['varna']] >= self::VARNA_RANK[$ga['varna']] ? 1 : 0;

        // 2. Vashya
        $vashya = self::VASHYA[self::VASHYA_INDEX[$ba['vashya']]][self::VASHYA_INDEX[$ga['vashya']]];

        // 3. Tara: counted both ways, 1.5 for each auspicious direction (3rd, 5th, 7th taras are bad)
        $taraBG = self::tara($gm['nakIndex'], $bm['nakIndex']);
        $taraGB = self::tara($bm['nakIndex'], $gm['nakIndex']);
        $tara = (in_array($taraBG, [3, 5, 7]) ? 0 : 1.5) + (in_array($taraGB, [3, 5, 7]) ? 0 : 1.5);

        // 4. Yoni
        $by = self::NAK_YONI[$bm['nakIndex']];
        $gy = self::NAK_YONI[$gm['nakIndex']];
        $yoni = self::YONI[$by][$gy];

        // 5. Graha Maitri
        $maitri = self::grahaMaitri($bm['lord'], $gm['lord']);

        // 6. Gana
        $gana = self::GANA[self::GANA_INDEX[$ba['gan']]][self::GANA_INDEX[$ga['gan']]];

        // 7. Bhakoot: 2/12, 5/9 and 6/8 positions of the Moon signs give 0
        $d1 = ($gm['signIndex'] - $bm['signIndex'] + 12) % 12 + 1;
        $d2 = ($bm['signIndex'] - $gm['signIndex'] + 12) % 12 + 1;
        $pair = [min($d1, $d2), max($d1, $d2)];
        $bhakootDosha = in_array($pair, [[2, 12], [5, 9], [6, 8]]);
        $bhakoot = $bhakootDosha ? 0 : 7;

        // 8. Nadi
        $nadiDosha = $ba['nadi'] === $ga['nadi'];
        $nadi = $nadiDosha ? 0 : 8;

        $rows = [
            ['name' => 'Varna', 'boy' => $ba['varna'], 'girl' => $ga['varna'], 'max' => 1, 'got' => $varna],
            ['name' => 'Vashya', 'boy' => $ba['vashya'], 'girl' => $ga['vashya'], 'max' => 2, 'got' => $vashya],
            ['name' => 'Tara', 'boy' => self::TARA_NAMES[$taraGB], 'girl' => self::TARA_NAMES[$taraBG], 'max' => 3, 'got' => $tara],
            ['name' => 'Yoni', 'boy' => self::YONI_NAMES[$by], 'girl' => self::YONI_NAMES[$gy], 'max' => 4, 'got' => $yoni],
            ['name' => 'Graha Maitri', 'boy' => $bm['lord'], 'girl' => $gm['lord'], 'max' => 5, 'got' => $maitri],
            ['name' => 'Gan', 'boy' => $ba['gan'], 'girl' => $ga['gan'], 'max' => 6, 'got' => $gana],
            ['name' => 'Bhakoot', 'boy' => $bm['sign'], 'girl' => $gm['sign'], 'max' => 7, 'got' => $bhakoot],
            ['name' => 'Nadi', 'boy' => $ba['nadi'], 'girl' => $ga['nadi'], 'max' => 8, 'got' => $nadi],
        ];
        foreach ($rows as &$row) {
            $row['area'] = self::AREAS[$row['name']];
            $row['meaning'] = self::MEANING[$row['name']];
        }
        unset($row);

        $total = array_sum(array_column($rows, 'got'));

        // Classical cancellations, shown as notes (the score itself is not changed)
        $notes = [];
        if ($nadiDosha) {
            $cancel = match (true) {
                $bm['signIndex'] === $gm['signIndex'] && $bm['nakIndex'] !== $gm['nakIndex'] => 'Both Moons are in the same sign but in different nakshatras, which cancels Nadi Dosha.',
                $bm['nakIndex'] === $gm['nakIndex'] && $bm['signIndex'] !== $gm['signIndex'] => 'Both have the same nakshatra but different Moon signs, which cancels Nadi Dosha.',
                $bm['nakIndex'] === $gm['nakIndex'] && $bm['pada'] !== $gm['pada'] => 'Both have the same nakshatra in different padas, which reduces Nadi Dosha.',
                default => null,
            };
            $notes[] = ['title' => 'Nadi Dosha is present', 'text' => 'Both partners have ' . $ba['nadi'] . ' Nadi. ' . ($cancel ?? 'No standard cancellation applies, so an astrologer should review it before marriage.'), 'ok' => $cancel !== null];
        }
        if ($bhakootDosha) {
            $rel = self::relation($bm['lord'], $gm['lord']);
            $cancel = $bm['lord'] === $gm['lord'] || ($rel === 'friend' && self::relation($gm['lord'], $bm['lord']) === 'friend');
            $notes[] = ['title' => 'Bhakoot Dosha is present', 'text' => "The Moon signs are in a {$pair[0]}/{$pair[1]} position. " . ($cancel ? 'The lords of both Moon signs are the same or friends, which cancels Bhakoot Dosha.' : 'The sign lords are not friends, so the dosha stays.'), 'ok' => $cancel];
        }

        // Manglik
        $bmg = $boy['doshas']['mangal'];
        $gmg = $girl['doshas']['mangal'];
        $bActive = $bmg['present'] && !$bmg['safe'];
        $gActive = $gmg['present'] && !$gmg['safe'];
        $manglik = match (true) {
            $bActive && $gActive => ['ok' => true, 'text' => 'Both partners are Manglik, so the Mangal Dosha of one cancels the other. This combination is considered acceptable.'],
            !$bActive && !$gActive => ['ok' => true, 'text' => 'Neither partner has an active Mangal Dosha, so there is no Manglik mismatch.'],
            default => ['ok' => false, 'text' => ($bActive ? $boy['name'] : $girl['name']) . ' has an active Mangal Dosha while ' . ($bActive ? $girl['name'] : $boy['name']) . ' does not. Traditionally this needs remedies or an astrologer\'s review before marriage.'],
        };

        $verdict = match (true) {
            $total >= 33 => ['label' => 'Excellent Match', 'text' => 'This is an excellent match. The two charts agree on almost every point of Guna Milan.'],
            $total >= 25 => ['label' => 'Good Match', 'text' => 'This is a good match. Most kootas agree, and the couple is likely to find harmony easily.'],
            $total >= 18 => ['label' => 'Average Match', 'text' => 'This is an acceptable match. The score crosses the traditional minimum of 18, though some areas will need understanding and effort.'],
            default => ['label' => 'Not Recommended', 'text' => 'The score is below the traditional minimum of 18. Other factors in the charts can still balance this, so consult an astrologer before deciding.'],
        };

        return [
            'rows'    => $rows,
            'total'   => $total,
            'verdict' => $verdict,
            'notes'   => $notes,
            'manglik' => $manglik,
        ];
    }
}
