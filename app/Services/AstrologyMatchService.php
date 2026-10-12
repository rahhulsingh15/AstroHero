<?php

namespace App\Services;

class AstrologyMatchService
{
    // 27 Nakshatras
    protected $nakshatras = [
        'Ashwini', 'Bharani', 'Krittika', 'Rohini', 'Mrigashira', 'Ardra',
        'Punarvasu', 'Pushya', 'Ashlesha', 'Magha', 'Purva Phalguni', 'Uttara Phalguni',
        'Hasta', 'Chitra', 'Swati', 'Vishakha', 'Anuradha', 'Jyeshtha',
        'Mula', 'Purva Ashadha', 'Uttara Ashadha', 'Shravana', 'Dhanishta', 'Shatabhisha',
        'Purva Bhadrapada', 'Uttara Bhadrapada', 'Revati'
    ];

    // 12 Rashis
    protected $rashis = [
        'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
        'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
    ];

    // Gana list: 0: Deva, 1: Manushya, 2: Rakshasa
    protected $ganas = [
        0 => [0, 4, 6, 7, 12, 14, 16, 21, 26],         // Deva
        1 => [1, 2, 3, 5, 10, 11, 19, 20, 24, 25],     // Manushya
        2 => [8, 9, 13, 15, 17, 18, 22, 23]            // Rakshasa
    ];

    // Nadi list: 0: Aadi, 1: Madhya, 2: Antya
    protected $nadis = [
        0 => [0, 5, 6, 11, 12, 17, 18, 23, 24],        // Aadi
        1 => [1, 4, 7, 10, 13, 16, 19, 22, 25],        // Madhya
        2 => [2, 3, 8, 9, 14, 15, 20, 21, 26]          // Antya
    ];

    /**
     * Compute approximate Moon index based on date/time hash
     */
    public function getAstronomicalDetails($dob, $tob)
    {
        $timestamp = strtotime($dob . ' ' . $tob);
        $nakshatraIndex = ($timestamp / 86400) % 27;
        if ($nakshatraIndex < 0) $nakshatraIndex += 27;

        $rashiIndex = ($timestamp / (86400 * 2.25)) % 12;
        if ($rashiIndex < 0) $rashiIndex += 12;

        return [
            'nakshatra_index' => (int)$nakshatraIndex,
            'nakshatra'       => $this->nakshatras[(int)$nakshatraIndex],
            'rashi_index'     => (int)$rashiIndex,
            'rashi'           => $this->rashis[(int)$rashiIndex],
        ];
    }

    /**
     * Calculate 36 Gunas Ashtakoota
     */
    public function calculateMatch($boyDetails, $girlDetails)
    {
        $b = $this->getAstronomicalDetails($boyDetails['dob'], $boyDetails['tob']);
        $g = $this->getAstronomicalDetails($girlDetails['dob'], $girlDetails['tob']);

        // 1. Varna (1 Point)
        $bVarna = (int)($b['rashi_index'] % 4);
        $gVarna = (int)($g['rashi_index'] % 4);
        $varnaScore = ($bVarna >= $gVarna) ? 1 : 0;

        // 2. Vashya (2 Points)
        $vashyaDiff = abs($b['rashi_index'] - $g['rashi_index']);
        $vashyaScore = ($vashyaDiff == 0) ? 2 : (($vashyaDiff % 2 == 0) ? 1 : 0);

        // 3. Tara (3 Points)
        $bToG = (($g['nakshatra_index'] - $b['nakshatra_index'] + 27) % 9);
        $gToB = (($b['nakshatra_index'] - $g['nakshatra_index'] + 27) % 9);
        $taraScore = 0;
        if (!in_array($bToG, [2, 4, 6])) $taraScore += 1.5;
        if (!in_array($gToB, [2, 4, 6])) $taraScore += 1.5;

        // 4. Yoni (4 Points)
        $yoniDiff = abs($b['nakshatra_index'] - $g['nakshatra_index']) % 14;
        $yoniScore = ($yoniDiff == 0) ? 4 : (($yoniDiff <= 3) ? 3 : (($yoniDiff <= 7) ? 2 : 1));

        // 5. Graha Maitri (5 Points)
        $maitriDiff = abs($b['rashi_index'] - $g['rashi_index']);
        if ($maitriDiff == 0) {
            $maitriScore = 5;
        } elseif (in_array($maitriDiff, [4, 8, 3, 9])) {
            $maitriScore = 4;
        } elseif (in_array($maitriDiff, [1, 5, 7])) {
            $maitriScore = 3;
        } else {
            $maitriScore = 1;
        }

        // 6. Gana (6 Points)
        $bGana = $this->getGanaIndex($b['nakshatra_index']);
        $gGana = $this->getGanaIndex($g['nakshatra_index']);
        if ($bGana == $gGana) {
            $ganaScore = 6;
        } elseif (($bGana == 0 && $gGana == 1) || ($bGana == 1 && $gGana == 0)) {
            $ganaScore = 5;
        } elseif ($bGana == 0 && $gGana == 2) {
            $ganaScore = 1;
        } else {
            $ganaScore = 0;
        }

        // 7. Bhakoot (7 Points)
        $bhakootDiff = abs($b['rashi_index'] - $g['rashi_index']) + 1;
        if (in_array($bhakootDiff, [2, 6, 8, 12])) {
            $bhakootScore = 0; // Bhakoot Dosha
        } else {
            $bhakootScore = 7;
        }

        // 8. Nadi (8 Points)
        $bNadi = $this->getNadiIndex($b['nakshatra_index']);
        $gNadi = $this->getNadiIndex($g['nakshatra_index']);
        if ($bNadi != $gNadi) {
            $nadiScore = 8;
        } else {
            $nadiScore = 0; // Nadi Dosha
        }

        $totalScore = $varnaScore + $vashyaScore + $taraScore + $yoniScore + $maitriScore + $ganaScore + $bhakootScore + $nadiScore;

        return [
            'boy' => array_merge($boyDetails, $b),
            'girl' => array_merge($girlDetails, $g),
            'scores' => [
                'varna' => ['name' => 'Varna (Spiritual)', 'max' => 1, 'obtained' => $varnaScore],
                'vashya' => ['name' => 'Vashya (Dominance)', 'max' => 2, 'obtained' => $vashyaScore],
                'tara' => ['name' => 'Tara (Destiny & Health)', 'max' => 3, 'obtained' => $taraScore],
                'yoni' => ['name' => 'Yoni (Physical & Intimacy)', 'max' => 4, 'obtained' => $yoniScore],
                'maitri' => ['name' => 'Graha Maitri (Mental Harmony)', 'max' => 5, 'obtained' => $maitriScore],
                'gana' => ['name' => 'Gana (Temperament)', 'max' => 6, 'obtained' => $ganaScore],
                'bhakoot' => ['name' => 'Bhakoot (Emotional & Family)', 'max' => 7, 'obtained' => $bhakootScore],
                'nadi' => ['name' => 'Nadi (Genetics & Progeny)', 'max' => 8, 'obtained' => $nadiScore],
            ],
            'total_score' => $totalScore,
            'verdict' => $this->getVerdict($totalScore),
        ];
    }

    protected function getGanaIndex($idx)
    {
        foreach ($this->ganas as $gana => $list) {
            if (in_array($idx, $list)) return $gana;
        }
        return 1;
    }

    protected function getNadiIndex($idx)
    {
        foreach ($this->nadis as $nadi => $list) {
            if (in_array($idx, $list)) return $nadi;
        }
        return 0;
    }

    protected function getVerdict($score)
    {
        if ($score >= 28) {
            return ['status' => 'Excellent Match', 'class' => 'success', 'desc' => 'Both partners have exceptional astrological compatibility for a peaceful and prosperous married life.'];
        } elseif ($score >= 18) {
            return ['status' => 'Good / Acceptable Match', 'class' => 'primary', 'desc' => 'Above average compatibility. Common adjustments and basic astrological remedies can ensure mutual harmony.'];
        } else {
            return ['status' => 'Not Recommended Match', 'class' => 'danger', 'desc' => 'Gun Milan score is below 18. Astrological remedies and senior astrologer consultation recommended.'];
        }
    }
}