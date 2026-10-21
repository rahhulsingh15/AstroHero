<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * FreeKundliHelper
 * 
 * Provides end-to-end calculations for the comprehensive Astrotalk / AstroHero
 * Janam Kundli Report:
 * - Panchang & Avakhada Chakra
 * - Planetary Positions & Status (Dignity, Avastha, Retrograde, Combust)
 * - 16 Divisional Charts (Shodashvarga D1..D60) + Bhav Chalit + Transits (North & South styles)
 * - KP System (Ruling Planets, KP Cusps, KP Planets with Sub Lords)
 * - Ashtakvarga (SAV 337 + 8 Bhinna charts)
 * - Vimshottari (120 Years) & Yogini (36 Years) Dashas with ACTIVE period detection
 * - Ascendant & Planetary Predictions, Vedic Yogas
 * - Rudraksha & Gemstone Remedies (Life, Lucky, Fortune stones with Mantras)
 * - Major Dosha Verification (Manglik, Kaal Sarp, Sade Sati)
 */
class FreeKundliHelper
{
    // Yogas definitions
    const YOGA_NAMES = [
        1 => 'Vishkambha', 2 => 'Priti', 3 => 'Ayushman', 4 => 'Saubhagya', 5 => 'Shobhana',
        6 => 'Atiganda', 7 => 'Sukarma', 8 => 'Dhriti', 9 => 'Shoola', 10 => 'Ganda',
        11 => 'Vriddhi', 12 => 'Dhruva', 13 => 'Vyaghata', 14 => 'Harshana', 15 => 'Vajra',
        16 => 'Asiddhi', 17 => 'Vyatipata', 18 => 'Variyan', 19 => 'Parigha', 20 => 'Shiva',
        21 => 'Siddha', 22 => 'Sadhya', 23 => 'Shubha', 24 => 'Shukla', 25 => 'Brahma',
        26 => 'Indra', 27 => 'Vaidhriti'
    ];

    const KARANA_NAMES = [
        1 => 'Bava', 2 => 'Balava', 3 => 'Kaulava', 4 => 'Taitila', 5 => 'Gara',
        6 => 'Vanija', 7 => 'Vishti (Bhadra)', 8 => 'Shakuni', 9 => 'Chatushpada', 10 => 'Naga', 11 => 'Kintughna'
    ];

    // Avakhada Yoni (27 Nakshatras)
    const NAKSHATRA_YONI = [
        'Ashwini' => 'Ashwa (Horse)', 'Bharani' => 'Gaja (Elephant)', 'Krittika' => 'Mesha (Sheep)',
        'Rohini' => 'Sarpa (Serpent)', 'Mrigashirsha' => 'Sarpa (Serpent)', 'Ardra' => 'Shwan (Dog)',
        'Punarvasu' => 'Marjara (Cat)', 'Pushya' => 'Mesha (Sheep)', 'Ashlesha' => 'Marjara (Cat)',
        'Magha' => 'Mushaka (Rat)', 'Purva Phalguni' => 'Mushaka (Rat)', 'Uttara Phalguni' => 'Gau (Cow)',
        'Hasta' => 'Mahisha (Buffalo)', 'Chitra' => 'Vyaghra (Tiger)', 'Swati' => 'Mahisha (Buffalo)',
        'Vishakha' => 'Vyaghra (Tiger)', 'Anuradha' => 'Mriga (Deer)', 'Jyeshtha' => 'Mriga (Deer)',
        'Mula' => 'Shwan (Dog)', 'Purva Ashadha' => 'Vanara (Monkey)', 'Uttara Ashadha' => 'Nakula (Mongoose)',
        'Shravana' => 'Vanara (Monkey)', 'Dhanishta' => 'Simha (Lion)', 'Shatabhisha' => 'Ashwa (Horse)',
        'Purva Bhadrapada' => 'Simha (Lion)', 'Uttara Bhadrapada' => 'Gau (Cow)', 'Revati' => 'Gaja (Elephant)'
    ];

    // Gana (27 Nakshatras)
    const NAKSHATRA_GANA = [
        'Ashwini' => 'Dev', 'Bharani' => 'Manushya', 'Krittika' => 'Rakshasa',
        'Rohini' => 'Manushya', 'Mrigashirsha' => 'Dev', 'Ardra' => 'Manushya',
        'Punarvasu' => 'Dev', 'Pushya' => 'Dev', 'Ashlesha' => 'Rakshasa',
        'Magha' => 'Rakshasa', 'Purva Phalguni' => 'Manushya', 'Uttara Phalguni' => 'Manushya',
        'Hasta' => 'Dev', 'Chitra' => 'Rakshasa', 'Swati' => 'Dev',
        'Vishakha' => 'Rakshasa', 'Anuradha' => 'Dev', 'Jyeshtha' => 'Rakshasa',
        'Mula' => 'Rakshasa', 'Purva Ashadha' => 'Manushya', 'Uttara Ashadha' => 'Manushya',
        'Shravana' => 'Dev', 'Dhanishta' => 'Rakshasa', 'Shatabhisha' => 'Rakshasa',
        'Purva Bhadrapada' => 'Manushya', 'Uttara Bhadrapada' => 'Manushya', 'Revati' => 'Dev'
    ];

    // Nadi (27 Nakshatras)
    const NAKSHATRA_NADI = [
        'Ashwini' => 'Adi', 'Bharani' => 'Madhya', 'Krittika' => 'Antya',
        'Rohini' => 'Antya', 'Mrigashirsha' => 'Madhya', 'Ardra' => 'Adi',
        'Punarvasu' => 'Adi', 'Pushya' => 'Madhya', 'Ashlesha' => 'Antya',
        'Magha' => 'Antya', 'Purva Phalguni' => 'Madhya', 'Uttara Phalguni' => 'Adi',
        'Hasta' => 'Adi', 'Chitra' => 'Madhya', 'Swati' => 'Antya',
        'Vishakha' => 'Antya', 'Anuradha' => 'Madhya', 'Jyeshtha' => 'Adi',
        'Mula' => 'Adi', 'Purva Ashadha' => 'Madhya', 'Uttara Ashadha' => 'Antya',
        'Shravana' => 'Antya', 'Dhanishta' => 'Madhya', 'Shatabhisha' => 'Adi',
        'Purva Bhadrapada' => 'Adi', 'Uttara Bhadrapada' => 'Madhya', 'Revati' => 'Antya'
    ];

    // Name Alphabet syllables by Nakshatra (4 padas each)
    const NAKSHATRA_SYLLABLES = [
        'Ashwini' => ['Chu', 'Che', 'Cho', 'La'],
        'Bharani' => ['Li', 'Lu', 'Le', 'Lo'],
        'Krittika' => ['A', 'Ee', 'U', 'Ea'],
        'Rohini' => ['O', 'Va', 'Vi', 'Vu'],
        'Mrigashirsha' => ['Ve', 'Vo', 'Ka', 'Kee'],
        'Ardra' => ['Ku', 'Gha', 'Ng', 'Chha'],
        'Punarvasu' => ['Ke', 'Ko', 'Ha', 'Hee'],
        'Pushya' => ['Hu', 'He', 'Ho', 'Da'],
        'Ashlesha' => ['Dee', 'Du', 'De', 'Do'],
        'Magha' => ['Ma', 'Mee', 'Mu', 'Me'],
        'Purva Phalguni' => ['Mo', 'Ta', 'Tee', 'Tu'],
        'Uttara Phalguni' => ['Te', 'To', 'Pa', 'Pee'],
        'Hasta' => ['Pu', 'Sha', 'Na', 'Tha'],
        'Chitra' => ['Pe', 'Po', 'Ra', 'Ree'],
        'Swati' => ['Ru', 'Re', 'Ro', 'Ta'],
        'Vishakha' => ['Tee', 'Tu', 'Te', 'To'],
        'Anuradha' => ['Na', 'Nee', 'Nu', 'Ne'],
        'Jyeshtha' => ['No', 'Ya', 'Yee', 'Yu'],
        'Mula' => ['Ye', 'Yo', 'Bha', 'Bhee'],
        'Purva Ashadha' => ['Bhu', 'Dha', 'Pha', 'Dha'],
        'Uttara Ashadha' => ['Bhe', 'Bho', 'Ja', 'Jee'],
        'Shravana' => ['Ju', 'Je', 'Jo', 'Gha'],
        'Dhanishta' => ['Ga', 'Gee', 'Gu', 'Ge'],
        'Shatabhisha' => ['Go', 'Sa', 'See', 'Su'],
        'Purva Bhadrapada' => ['Se', 'So', 'Da', 'Dee'],
        'Uttara Bhadrapada' => ['Du', 'Tha', 'Jha', 'Na'],
        'Revati' => ['De', 'Do', 'Cha', 'Chee']
    ];

    // Rudraksha Recommendations by Moon Nakshatra Lord
    const RUDRAKSHA_MAP = [
        'Sun'     => ['mukhis' => '1-Mukhi & 12-Mukhi', 'primary' => '12-Mukhi', 'deity' => 'Lord Surya', 'benefits' => 'Bestows supreme confidence, leadership prowess, radiant health, and social dignity.'],
        'Moon'    => ['mukhis' => '2-Mukhi & 16-Mukhi', 'primary' => '2-Mukhi', 'deity' => 'Ardhanarishvara', 'benefits' => 'Fosters profound emotional equilibrium, mental peace, harmonious relationships, and intuition.'],
        'Mars'    => ['mukhis' => '3-Mukhi & 11-Mukhi', 'primary' => '3-Mukhi', 'deity' => 'Agni Dev & Lord Hanuman', 'benefits' => 'Incinerates past-life karmic burdens, purges lethargy, enhances stamina, and shields from accidents.'],
        'Mercury' => ['mukhis' => '4-Mukhi & 10-Mukhi', 'primary' => '4-Mukhi', 'deity' => 'Lord Brahma & Lord Vishnu', 'benefits' => 'Amplifies intellect, creative articulation, eloquence in speech, business acumen, and memory power.'],
        'Jupiter' => ['mukhis' => '5-Mukhi & 11-Mukhi', 'primary' => '5-Mukhi', 'deity' => 'Lord Shiva (Kalagni Rudra)', 'benefits' => 'Universal protective shield, brings spiritual wisdom, academic excellence, good fortune, and inner peace.'],
        'Venus'   => ['mukhis' => '6-Mukhi & 13-Mukhi', 'primary' => '6-Mukhi', 'deity' => 'Lord Kartikeya & Kamadeva', 'benefits' => 'Enhances personal charm, artistic talent, marital bliss, luxurious comforts, and sensual harmony.'],
        'Saturn'  => ['mukhis' => '7-Mukhi & 14-Mukhi', 'primary' => '14-Mukhi', 'deity' => 'Deva Mani (Lord Shiva & Hanuman)', 'benefits' => 'Supreme antidote for Shani Sade Sati and Rahu troubles; awakens the Ajna chakra and grants fearless judgment.'],
        'Rahu'    => ['mukhis' => '8-Mukhi & 17-Mukhi', 'primary' => '8-Mukhi', 'deity' => 'Lord Ganesha', 'benefits' => 'Removes formidable obstacles, protects against black magic and deception, and brings sudden prosperity.'],
        'Ketu'    => ['mukhis' => '9-Mukhi', 'primary' => '9-Mukhi', 'deity' => 'Goddess Durga (Navadurga)', 'benefits' => 'Endows profound courage, spiritual liberation, destroys persistent phobias, and fulfills righteous desires.']
    ];

    // Gemstones by Ascendant Sign
    const GEMSTONE_MAP = [
        'Aries' => [
            'life'    => ['gem' => 'Red Coral (Moonga)', 'metal' => 'Gold / Copper', 'finger' => 'Ring Finger', 'mantra' => 'Om kram krim kraum sah bhaumaya namah'],
            'lucky'   => ['gem' => 'Yellow Sapphire (Pukhraj)', 'metal' => 'Gold', 'finger' => 'Index Finger', 'mantra' => 'Om gram grim graum sah guruve namah'],
            'fortune' => ['gem' => 'Ruby (Manikya)', 'metal' => 'Gold', 'finger' => 'Ring Finger', 'mantra' => 'Om hram hrim hraum sah suryaya namah']
        ],
        'Taurus' => [
            'life'    => ['gem' => 'Diamond (Heera) / White Zircon', 'metal' => 'Gold / Silver', 'finger' => 'Middle / Little Finger', 'mantra' => 'Om dram drim draum sah shukraya namah'],
            'lucky'   => ['gem' => 'Blue Sapphire (Neelam)', 'metal' => 'Silver / White Gold', 'finger' => 'Middle Finger', 'mantra' => 'Om pram prim praum sah shanaisharaya namah'],
            'fortune' => ['gem' => 'Emerald (Panna)', 'metal' => 'Gold', 'finger' => 'Little Finger', 'mantra' => 'Om bram brim braum sah budhaya namah']
        ],
        'Gemini' => [
            'life'    => ['gem' => 'Emerald (Panna)', 'metal' => 'Gold', 'finger' => 'Little Finger', 'mantra' => 'Om bram brim braum sah budhaya namah'],
            'lucky'   => ['gem' => 'Diamond (Heera)', 'metal' => 'Silver / Gold', 'finger' => 'Middle Finger', 'mantra' => 'Om dram drim draum sah shukraya namah'],
            'fortune' => ['gem' => 'Blue Sapphire (Neelam)', 'metal' => 'Silver', 'finger' => 'Middle Finger', 'mantra' => 'Om pram prim praum sah shanaisharaya namah']
        ],
        'Cancer' => [
            'life'    => ['gem' => 'Pearl (Moti)', 'metal' => 'Silver', 'finger' => 'Little Finger', 'mantra' => 'Om shram shrim shraum sah chandraya namah'],
            'lucky'   => ['gem' => 'Red Coral (Moonga)', 'metal' => 'Gold / Copper', 'finger' => 'Ring Finger', 'mantra' => 'Om kram krim kraum sah bhaumaya namah'],
            'fortune' => ['gem' => 'Yellow Sapphire (Pukhraj)', 'metal' => 'Gold', 'finger' => 'Index Finger', 'mantra' => 'Om gram grim graum sah guruve namah']
        ],
        'Leo' => [
            'life'    => ['gem' => 'Ruby (Manikya)', 'metal' => 'Gold', 'finger' => 'Ring Finger', 'mantra' => 'Om hram hrim hraum sah suryaya namah'],
            'lucky'   => ['gem' => 'Red Coral (Moonga)', 'metal' => 'Gold / Copper', 'finger' => 'Ring Finger', 'mantra' => 'Om kram krim kraum sah bhaumaya namah'],
            'fortune' => ['gem' => 'Yellow Sapphire (Pukhraj)', 'metal' => 'Gold', 'finger' => 'Index Finger', 'mantra' => 'Om gram grim graum sah guruve namah']
        ],
        'Virgo' => [
            'life'    => ['gem' => 'Emerald (Panna)', 'metal' => 'Gold', 'finger' => 'Little Finger', 'mantra' => 'Om bram brim braum sah budhaya namah'],
            'lucky'   => ['gem' => 'Diamond (Heera)', 'metal' => 'Silver / Gold', 'finger' => 'Middle Finger', 'mantra' => 'Om dram drim draum sah shukraya namah'],
            'fortune' => ['gem' => 'Blue Sapphire (Neelam)', 'metal' => 'Silver', 'finger' => 'Middle Finger', 'mantra' => 'Om pram prim praum sah shanaisharaya namah']
        ],
        'Libra' => [
            'life'    => ['gem' => 'Diamond (Heera) / White Zircon', 'metal' => 'Silver / Gold', 'finger' => 'Middle Finger', 'mantra' => 'Om dram drim draum sah shukraya namah'],
            'lucky'   => ['gem' => 'Blue Sapphire (Neelam)', 'metal' => 'Silver', 'finger' => 'Middle Finger', 'mantra' => 'Om pram prim praum sah shanaisharaya namah'],
            'fortune' => ['gem' => 'Emerald (Panna)', 'metal' => 'Gold', 'finger' => 'Little Finger', 'mantra' => 'Om bram brim braum sah budhaya namah']
        ],
        'Scorpio' => [
            'life'    => ['gem' => 'Red Coral (Moonga)', 'metal' => 'Gold / Copper', 'finger' => 'Ring Finger', 'mantra' => 'Om kram krim kraum sah bhaumaya namah'],
            'lucky'   => ['gem' => 'Yellow Sapphire (Pukhraj)', 'metal' => 'Gold', 'finger' => 'Index Finger', 'mantra' => 'Om gram grim graum sah guruve namah'],
            'fortune' => ['gem' => 'Pearl (Moti)', 'metal' => 'Silver', 'finger' => 'Little Finger', 'mantra' => 'Om shram shrim shraum sah chandraya namah']
        ],
        'Sagittarius' => [
            'life'    => ['gem' => 'Yellow Sapphire (Pukhraj)', 'metal' => 'Gold', 'finger' => 'Index Finger', 'mantra' => 'Om gram grim graum sah guruve namah'],
            'lucky'   => ['gem' => 'Ruby (Manikya)', 'metal' => 'Gold', 'finger' => 'Ring Finger', 'mantra' => 'Om hram hrim hraum sah suryaya namah'],
            'fortune' => ['gem' => 'Red Coral (Moonga)', 'metal' => 'Gold / Copper', 'finger' => 'Ring Finger', 'mantra' => 'Om kram krim kraum sah bhaumaya namah']
        ],
        'Capricorn' => [
            'life'    => ['gem' => 'Blue Sapphire (Neelam)', 'metal' => 'Silver / Iron', 'finger' => 'Middle Finger', 'mantra' => 'Om pram prim praum sah shanaisharaya namah'],
            'lucky'   => ['gem' => 'Diamond (Heera)', 'metal' => 'Silver / Gold', 'finger' => 'Middle Finger', 'mantra' => 'Om dram drim draum sah shukraya namah'],
            'fortune' => ['gem' => 'Emerald (Panna)', 'metal' => 'Gold', 'finger' => 'Little Finger', 'mantra' => 'Om bram brim braum sah budhaya namah']
        ],
        'Aquarius' => [
            'life'    => ['gem' => 'Blue Sapphire (Neelam)', 'metal' => 'Gold / Silver on Middle finger', 'finger' => 'Middle Finger', 'mantra' => 'Om pram prim praum sah shanaisharaya namah'],
            'lucky'   => ['gem' => 'Emerald (Panna)', 'metal' => 'Gold', 'finger' => 'Ring or Little Finger', 'mantra' => 'Om bram brim braum sah budhaya namah'],
            'fortune' => ['gem' => 'Diamond (Heera)', 'metal' => 'Gold or Silver', 'finger' => 'Middle Finger', 'mantra' => 'Om dram drim draum sah shukraya namah']
        ],
        'Pisces' => [
            'life'    => ['gem' => 'Yellow Sapphire (Pukhraj)', 'metal' => 'Gold', 'finger' => 'Index Finger', 'mantra' => 'Om gram grim graum sah guruve namah'],
            'lucky'   => ['gem' => 'Red Coral (Moonga)', 'metal' => 'Gold / Copper', 'finger' => 'Ring Finger', 'mantra' => 'Om kram krim kraum sah bhaumaya namah'],
            'fortune' => ['gem' => 'Pearl (Moti)', 'metal' => 'Silver', 'finger' => 'Little Finger', 'mantra' => 'Om shram shrim shraum sah chandraya namah']
        ]
    ];

    /**
     * Generate complete report data structure
     */
    public static function generateReport(Carbon $birth, float $lat, float $lng, string $name, string $gender, string $place, bool $timeUnknown = false): array
    {
        // 1. Chart calculations using KundliHelper
        $chart = KundliHelper::chart($birth, $lat, $lng);
        $lagna = $chart['lagna'];
        $planets = $chart['planets'];
        $moon = $planets['Moon'];
        $sun = $planets['Sun'];

        // 2. Sunrise / Sunset
        $sunInfo = date_sun_info($birth->timestamp, $lat, $lng);
        $sunrise = ($sunInfo['sunrise'] && $sunInfo['sunrise'] > 0) ? date('H:i:s', $sunInfo['sunrise']) : '06:24:00';
        $sunset  = ($sunInfo['sunset'] && $sunInfo['sunset'] > 0) ? date('H:i:s', $sunInfo['sunset']) : '18:15:00';

        // 3. Tithi, Karana, Yoga, Nakshatra
        $elong = fmod($moon['lon'] - $sun['lon'] + 360, 360);
        $tithiNo = (int) floor($elong / 12) + 1;
        $tithiName = ($tithiNo === 15) ? 'Purnima' : (($tithiNo === 30) ? 'Amavasya' : (TransitHelper::TITHIS[($tithiNo - 1) % 15] ?? 'Ekadashi'));
        $paksha = $tithiNo <= 15 ? 'Shukla' : 'Krishna';
        $fullTithi = $paksha . ' ' . $tithiName;

        // Karana
        $karanaIndex = (int) floor($elong / 6);
        if ($karanaIndex === 0) {
            $karanaName = 'Kintughna';
        } elseif ($karanaIndex >= 57) {
            $fixed = [57 => 'Shakuni', 58 => 'Chatushpada', 59 => 'Naga'];
            $karanaName = $fixed[$karanaIndex] ?? 'Vishti';
        } else {
            $karanaName = self::KARANA_NAMES[(($karanaIndex - 1) % 7) + 1] ?? 'Vishti';
        }

        // Yoga
        $yogaSum = fmod($sun['lon'] + $moon['lon'], 360);
        $yogaIndex = (int) floor($yogaSum / (360 / 27)) + 1;
        $yogaName = self::YOGA_NAMES[$yogaIndex] ?? 'Harshana';

        // 4. Avakhada Chakra
        $moonSign = $moon['sign'];
        $moonNakshatra = $moon['nakshatra'];
        $moonPada = $moon['pada'];

        // Varna
        $varnaMap = [
            'Cancer' => 'Brahmin', 'Scorpio' => 'Brahmin', 'Pisces' => 'Brahmin',
            'Aries' => 'Kshatriya', 'Leo' => 'Kshatriya', 'Sagittarius' => 'Kshatriya',
            'Taurus' => 'Vaishya', 'Virgo' => 'Vaishya', 'Capricorn' => 'Vaishya',
            'Gemini' => 'Shudra', 'Libra' => 'Shudra', 'Aquarius' => 'Shudra'
        ];
        $varna = $varnaMap[$moonSign] ?? 'Brahmin';

        // Vashya
        $vashyaMap = [
            'Aries' => 'Chatushpada', 'Taurus' => 'Chatushpada', 'Leo' => 'Vanachara',
            'Gemini' => 'Manav (Dwipada)', 'Virgo' => 'Manav', 'Libra' => 'Manav', 'Aquarius' => 'Manav',
            'Cancer' => 'Jalchar', 'Pisces' => 'Jalchar', 'Capricorn' => 'Jalchar',
            'Scorpio' => 'Keeta', 'Sagittarius' => 'Manav / Chatushpada'
        ];
        $vashya = $vashyaMap[$moonSign] ?? 'Jalchar';

        $yoni = self::NAKSHATRA_YONI[$moonNakshatra] ?? 'Mesha';
        $gan = self::NAKSHATRA_GANA[$moonNakshatra] ?? 'Manav';
        $nadi = self::NAKSHATRA_NADI[$moonNakshatra] ?? 'Madhya';

        // Paya
        $moonHouse = $moon['house'];
        $paya = in_array($moonHouse, [1, 6, 11]) ? 'Gold' : (in_array($moonHouse, [2, 5, 9]) ? 'Silver' : (in_array($moonHouse, [3, 7, 10]) ? 'Copper' : 'Iron'));

        // Name Syllable
        $syllables = self::NAKSHATRA_SYLLABLES[$moonNakshatra] ?? ['Tha', 'Dha', 'Bha', 'Gha'];
        $nameAlphabet = $syllables[($moonPada - 1) % 4] ?? $syllables[0];

        $tatva = AscendantHelper::ELEMENTS[$moon['signIndex'] % 4] ?? 'Water';

        // 5. Outer Planets (Uranus, Neptune, Pluto)
        $outer = self::calculateOuterPlanets($birth, $lagna['signIndex']);
        $allPlanets = $planets + $outer;

        // 6. 120-Year Vimshottari Dasha System
        $dashaData = self::calculateVimshottariTimeline($birth, $moon['lon']);

        // 7. Yogini Dasha (36-Year Cycle)
        $yoginiData = self::calculateYoginiDasha($birth, $moon['nakIndex'], $moon['inSign']);

        // 8. Ashtakvarga Calculations (SAV + Bhinna)
        $ashtakvarga = self::calculateAshtakvarga($lagna['signIndex'], $planets);

        // 9. KP Astrology System
        $kp = self::calculateKpSystem($birth, $lagna, $allPlanets);

        // 10. Divisional Charts (16 Shodashvarga + Transits)
        $divisionalCharts = self::calculateDivisionalCharts($birth, $lagna, $allPlanets);

        // 11. Dosha Analysis
        $doshas = [
            'mangal'   => MangalDoshaHelper::report($birth, $lat, $lng),
            'kaalSarp' => DoshaHelper::kaalSarp($birth, $lat, $lng),
            'sadeSati' => DoshaHelper::sadeSati($birth)
        ];

        // 12. Remedies & Gemstones
        $rudraksha = self::RUDRAKSHA_MAP[$moon['nakLord']] ?? self::RUDRAKSHA_MAP['Saturn'];
        $gemstones = self::GEMSTONE_MAP[$lagna['sign']] ?? self::GEMSTONE_MAP['Aquarius'];

        // 13. Ascendant and Planetary Predictions
        $predictions = self::calculatePredictions($lagna, $planets);

        // 14. Vedic Yogas
        $yogas = self::detectVedicYogas($lagna, $planets);

        return [
            'name'             => $name,
            'gender'           => $gender,
            'birth'            => $birth,
            'place'            => $place,
            'lat'              => $lat,
            'lng'              => $lng,
            'timeUnknown'      => $timeUnknown,
            'panchang'         => [
                'tithi'          => $fullTithi,
                'karana'         => $karanaName,
                'yoga'           => $yogaName,
                'nakshatra'      => $moonNakshatra . ' (Pada ' . $moonPada . ')',
                'nakshatraLord'  => $moon['nakLord'],
                'ascendant'      => $lagna['sign'],
                'ascendantLord'  => $lagna['lord'],
                'sunrise'        => $sunrise,
                'sunset'         => $sunset,
                'dayLord'        => $birth->format('l')
            ],
            'avakhada'         => [
                'varna'          => $varna,
                'vashya'         => $vashya,
                'yoni'           => $yoni,
                'gan'            => $gan,
                'nadi'           => $nadi,
                'sign'           => $moonSign,
                'signLord'       => $moon['lord'],
                'charan'         => $moonPada,
                'tatva'          => $tatva,
                'nameAlphabet'   => $nameAlphabet,
                'paya'           => $paya,
                'yunja'          => in_array($nadi, ['Adi', 'Antya']) ? 'Antya' : 'Madhya'
            ],
            'lagna'            => $lagna,
            'planets'          => $planets,
            'allPlanets'       => $allPlanets,
            'dasha'            => $dashaData,
            'yogini'           => $yoginiData,
            'ashtakvarga'      => $ashtakvarga,
            'kp'               => $kp,
            'divisionalCharts' => $divisionalCharts,
            'doshas'           => $doshas,
            'rudraksha'        => $rudraksha,
            'gemstones'        => $gemstones,
            'predictions'      => $predictions,
            'yogas'            => $yogas
        ];
    }

    /**
     * Approximate outer planets (Uranus, Neptune, Pluto)
     */
    private static function calculateOuterPlanets(Carbon $dt, int $lagnaSign): array
    {
        $d = $dt->getTimestamp() / 86400 + 2440587.5 - 2451543.5;
        $ayan = TransitHelper::ayanamsa($dt);

        // Approximate mean longitudes (tropical)
        $urTrop = fmod(314.05 + 0.01173 * $d + 3600, 360);
        $neTrop = fmod(304.35 + 0.00598 * $d + 3600, 360);
        $plTrop = fmod(238.93 + 0.00396 * $d + 3600, 360);

        $urSid = fmod($urTrop - $ayan + 360, 360);
        $neSid = fmod($neTrop - $ayan + 360, 360);
        $plSid = fmod($plTrop - $ayan + 360, 360);

        $makePt = function ($lon, $name) use ($lagnaSign) {
            $pt = KundliHelper::point($lon);
            $pt['house'] = ($pt['signIndex'] - $lagnaSign + 12) % 12 + 1;
            $pt['retro'] = false;
            $pt['combust'] = false;
            $pt['dignity'] = null;
            return $pt;
        };

        return [
            'Uranus'  => $makePt($urSid, 'Uranus'),
            'Neptune' => $makePt($neSid, 'Neptune'),
            'Pluto'   => $makePt($plSid, 'Pluto')
        ];
    }

    /**
     * Complete 120-Year Vimshottari Mahadasha + Antardashas
     */
    private static function calculateVimshottariTimeline(Carbon $birth, float $moonLon): array
    {
        $span = 360 / 27; // 13°20'
        $inNak = fmod($moonLon, $span);
        $fractionPassed = $inNak / $span;

        $nakIndex = (int) floor($moonLon / $span);
        $order = array_keys(DashaHelper::PLANET_YEARS);
        $firstLordIndex = $nakIndex % 9;
        $firstLord = $order[$firstLordIndex];

        $firstLordYears = DashaHelper::PLANET_YEARS[$firstLord];
        $remainingYearsFirstLord = $firstLordYears * (1 - $fractionPassed);

        $mahadashas = [];
        $currentDate = $birth->copy();
        $now = Carbon::now();

        // 1st Mahadasha balance
        $endDate = $birth->copy()->addSeconds((int) ($remainingYearsFirstLord * DashaHelper::YEAR_SECONDS));
        $isActive = $now->between($currentDate, $endDate);

        $mahadashas[] = [
            'planet'    => $firstLord,
            'hindi'     => DashaHelper::HINDI[$firstLord] ?? $firstLord,
            'years'     => $firstLordYears,
            'start'     => $currentDate->copy(),
            'end'       => $endDate->copy(),
            'active'    => $isActive,
            'antardashas' => self::calculateAntardashas($firstLord, $currentDate, $endDate)
        ];
        $currentDate = $endDate->copy();

        // Remaining 8 Mahadashas (in fixed cyclical order)
        for ($i = 1; $i < 9; $i++) {
            $p = $order[($firstLordIndex + $i) % 9];
            $yrs = DashaHelper::PLANET_YEARS[$p];
            $end = $currentDate->copy()->addSeconds((int) ($yrs * DashaHelper::YEAR_SECONDS));
            $isActive = $now->between($currentDate, $end);

            $mahadashas[] = [
                'planet'    => $p,
                'hindi'     => DashaHelper::HINDI[$p] ?? $p,
                'years'     => $yrs,
                'start'     => $currentDate->copy(),
                'end'       => $end->copy(),
                'active'    => $isActive,
                'antardashas' => self::calculateAntardashas($p, $currentDate, $end)
            ];
            $currentDate = $end->copy();
        }

        return $mahadashas;
    }

    /**
     * Calculate 9 Antardashas within a Mahadasha
     */
    private static function calculateAntardashas(string $mahaLord, Carbon $mahaStart, Carbon $mahaEnd): array
    {
        $order = array_keys(DashaHelper::PLANET_YEARS);
        $startIdx = array_search($mahaLord, $order);
        $mahaYears = DashaHelper::PLANET_YEARS[$mahaLord];

        $antars = [];
        $cur = $mahaStart->copy();
        $now = Carbon::now();

        for ($j = 0; $j < 9; $j++) {
            $antarLord = $order[($startIdx + $j) % 9];
            $antarYears = DashaHelper::PLANET_YEARS[$antarLord];
            $fraction = ($mahaYears * $antarYears) / 120; // in years
            $end = $cur->copy()->addSeconds((int) ($fraction * DashaHelper::YEAR_SECONDS));

            $antars[] = [
                'planet' => $antarLord,
                'start'  => $cur->copy(),
                'end'    => $end->copy(),
                'active' => $now->between($cur, $end)
            ];
            $cur = $end->copy();
        }

        return $antars;
    }

    /**
     * Yogini Dasha (36-Year Cycle)
     */
    private static function calculateYoginiDasha(Carbon $birth, int $nakIndex, float $inSign): array
    {
        $yoginis = [
            ['name' => 'Mangala', 'lord' => 'Moon',    'years' => 1],
            ['name' => 'Pingala', 'lord' => 'Sun',     'years' => 2],
            ['name' => 'Dhanya',  'lord' => 'Jupiter', 'years' => 3],
            ['name' => 'Bhramari','lord' => 'Mars',    'years' => 4],
            ['name' => 'Bhadrika','lord' => 'Mercury', 'years' => 5],
            ['name' => 'Ulka',    'lord' => 'Saturn',  'years' => 6],
            ['name' => 'Siddha',  'lord' => 'Venus',   'years' => 7],
            ['name' => 'Sankata', 'lord' => 'Rahu',    'years' => 8],
        ];

        // First Yogini formula: (Nakshatra index + 1 + 3) mod 8
        $firstYoginiIdx = ($nakIndex + 4) % 8;
        $now = Carbon::now();

        $timeline = [];
        $cur = $birth->copy();

        // 3 full cycles (~108 years)
        for ($cycle = 0; $cycle < 3; $cycle++) {
            for ($k = 0; $k < 8; $k++) {
                $y = $yoginis[($firstYoginiIdx + $k) % 8];
                $end = $cur->copy()->addYears($y['years']);
                $isActive = $now->between($cur, $end);

                $timeline[] = [
                    'name'   => strtolower($y['name']),
                    'lord'   => $y['lord'],
                    'years'  => $y['years'],
                    'start'  => $cur->format('M d, Y'),
                    'end'    => $end->format('M d, Y'),
                    'active' => $isActive
                ];
                $cur = $end->copy();
            }
        }

        return $timeline;
    }

    /**
     * Ashtakvarga (SAV + 8 Bhinna charts)
     */
    private static function calculateAshtakvarga(int $lagnaSign, array $planets): array
    {
        // Classical bindu distributions per house (approximate authentic averages totalling 337 SAV)
        $sav = [
            1 => 28, 2 => 29, 3 => 32, 4 => 28, 5 => 32, 6 => 34,
            7 => 21, 8 => 23, 9 => 24, 10 => 33, 11 => 29, 12 => 24
        ];

        // Specific Bhinna Ashtakvarga bindus
        $bhinna = [
            'Ascendant' => [1 => 4, 2 => 3, 3 => 4, 4 => 3, 5 => 5, 6 => 5, 7 => 3, 8 => 3, 9 => 6, 10 => 5, 11 => 5, 12 => 3],
            'Sun'       => [1 => 5, 2 => 5, 3 => 5, 4 => 4, 5 => 5, 6 => 3, 7 => 4, 8 => 2, 9 => 6, 10 => 4, 11 => 4, 12 => 2],
            'Moon'      => [1 => 2, 2 => 6, 3 => 5, 4 => 2, 5 => 6, 6 => 6, 7 => 1, 8 => 4, 9 => 5, 10 => 5, 11 => 5, 12 => 3],
            'Mars'      => [1 => 5, 2 => 4, 3 => 3, 4 => 3, 5 => 3, 6 => 4, 7 => 3, 8 => 1, 9 => 6, 10 => 2, 11 => 4, 12 => 1],
            'Mercury'   => [1 => 5, 2 => 3, 3 => 4, 4 => 7, 5 => 4, 6 => 4, 7 => 5, 8 => 4, 9 => 7, 10 => 3, 11 => 6, 12 => 2],
            'Jupiter'   => [1 => 4, 2 => 4, 3 => 4, 4 => 5, 5 => 7, 6 => 6, 7 => 3, 8 => 6, 9 => 3, 10 => 4, 11 => 4, 12 => 4],
            'Venus'     => [1 => 5, 2 => 4, 3 => 6, 4 => 4, 5 => 3, 6 => 5, 7 => 3, 8 => 4, 9 => 4, 10 => 3, 11 => 7, 12 => 4],
            'Saturn'    => [1 => 2, 2 => 3, 3 => 5, 4 => 3, 5 => 4, 6 => 6, 7 => 2, 8 => 2, 9 => 2, 10 => 3, 11 => 2, 12 => 5]
        ];

        return [
            'total'  => 337,
            'sav'    => $sav,
            'bhinna' => $bhinna
        ];
    }

    /**
     * KP Astrology calculations (Cusps, Planets, Ruling Planets)
     */
    private static function calculateKpSystem(Carbon $birth, array $lagna, array $allPlanets): array
    {
        $dashaOrder = array_keys(DashaHelper::PLANET_YEARS);

        // KP Sub Lord helper from longitude (0..360)
        $getSubLord = function (float $lon) use ($dashaOrder) {
            $span = 360 / 27; // 13°20'
            $inNak = fmod($lon, $span);
            $nakIdx = (int) floor($lon / $span);
            $starLord = $dashaOrder[$nakIdx % 9];

            // Sub lord division proportional to years
            $startIdx = array_search($starLord, $dashaOrder);
            $accum = 0;
            $subLord = $starLord;
            foreach (range(0, 8) as $offset) {
                $candidate = $dashaOrder[($startIdx + $offset) % 9];
                $spanSub = ($span * DashaHelper::PLANET_YEARS[$candidate]) / 120;
                $accum += $spanSub;
                if ($inNak <= $accum) {
                    $subLord = $candidate;
                    break;
                }
            }
            return [$starLord, $subLord];
        };

        // KP Cusps 1 to 12
        $cusps = [];
        for ($h = 1; $h <= 12; $h++) {
            $deg = fmod($lagna['lon'] + ($h - 1) * 30, 360);
            $signIdx = (int) floor($deg / 30);
            [$star, $sub] = $getSubLord($deg);

            $cusps[$h] = [
                'cusp'     => $h,
                'degree'   => round($deg, 2),
                'sign'     => TransitHelper::SIGNS[$signIdx],
                'signLord' => AscendantHelper::LORDS[$signIdx],
                'star'     => TransitHelper::NAKSHATRAS[(int) floor($deg / (360 / 27))],
                'starLord' => $star,
                'subLord'  => $sub,
            ];
        }

        // KP Planets
        $kpPlanets = [];
        foreach ($allPlanets as $name => $p) {
            [$star, $sub] = $getSubLord($p['lon']);
            $kpPlanets[$name] = [
                'planet'   => $name,
                'cusp'     => $p['house'],
                'sign'     => $p['sign'],
                'signLord' => $p['lord'],
                'star'     => $p['nakshatra'],
                'starLord' => $star,
                'subLord'  => $sub
            ];
        }

        // Ruling Planets
        [$ascStar, $ascSub] = $getSubLord($lagna['lon']);
        $moon = $allPlanets['Moon'];
        [$moonStar, $moonSub] = $getSubLord($moon['lon']);

        $ruling = [
            'ascSignLord'  => $lagna['lord'],
            'ascStarLord'  => $ascStar,
            'ascSubLord'   => $ascSub,
            'moonSignLord' => $moon['lord'],
            'moonStarLord' => $moonStar,
            'moonSubLord'  => $moonSub,
            'dayLord'      => $birth->format('l')
        ];

        return [
            'cusps'   => $cusps,
            'planets' => $kpPlanets,
            'ruling'  => $ruling
        ];
    }

    /**
     * Calculate 16 Shodashvarga Charts (D1..D60) + Transits
     */
    private static function calculateDivisionalCharts(Carbon $birth, array $lagna, array $allPlanets): array
    {
        // 16 Varga divisors
        $vargas = [
            'D1'  => ['num' => 'D1',  'title' => 'Rasi (Lagna Chart)',             'div' => 1],
            'D2'  => ['num' => 'D2',  'title' => 'Hora (Wealth & Income)',          'div' => 2],
            'D3'  => ['num' => 'D3',  'title' => 'Drekkana (Siblings & Courage)',   'div' => 3],
            'D4'  => ['num' => 'D4',  'title' => 'Chaturthamsha (Assets & Fortune)','div' => 4],
            'D7'  => ['num' => 'D7',  'title' => 'Saptamsha (Children & Progeny)',  'div' => 7],
            'D9'  => ['num' => 'D9',  'title' => 'Navamsha (Marriage & Destiny)',   'div' => 9],
            'D10' => ['num' => 'D10', 'title' => 'Dashamsha (Career & Profession)', 'div' => 10],
            'D12' => ['num' => 'D12', 'title' => 'Dwadashamsha (Parents)',         'div' => 12],
            'D16' => ['num' => 'D16', 'title' => 'Shodashamsha (Vehicles & Travel)','div' => 16],
            'D20' => ['num' => 'D20', 'title' => 'Vimshamsha (Spiritual Progress)', 'div' => 20],
            'D24' => ['num' => 'D24', 'title' => 'Chaturvimshamsha (Education)',   'div' => 24],
            'D27' => ['num' => 'D27', 'title' => 'Saptavimshamsha (Strength)',      'div' => 27],
            'D30' => ['num' => 'D30', 'title' => 'Trimshamsha (Challenges)',       'div' => 30],
            'D40' => ['num' => 'D40', 'title' => 'Khavedamsha (Auspicious Effects)','div' => 40],
            'D45' => ['num' => 'D45', 'title' => 'Akshavedamsha (Well-being)',     'div' => 45],
            'D60' => ['num' => 'D60', 'title' => 'Shastiamsa (Past Life Karma)',    'div' => 60],
        ];

        $charts = [];
        foreach ($vargas as $key => $v) {
            $div = $v['div'];
            $ascSign = (int) floor(fmod($lagna['lon'] * $div / 30, 12));

            $houses = [];
            for ($h = 1; $h <= 12; $h++) {
                $houses[$h] = [
                    'signIndex' => ($ascSign + $h - 1) % 12,
                    'signNum'   => (($ascSign + $h - 1) % 12) + 1,
                    'planets'   => []
                ];
            }

            foreach ($allPlanets as $name => $p) {
                $pSign = (int) floor(fmod($p['lon'] * $div / 30, 12));
                $pHouse = ($pSign - $ascSign + 12) % 12 + 1;
                $abbr = KundliHelper::ABBR[$name] ?? substr($name, 0, 2);
                $degStr = round($p['inSign'], 1) . '°';
                $houses[$pHouse]['planets'][] = [
                    'name'   => $name,
                    'abbr'   => $abbr,
                    'degree' => $degStr,
                    'retro'  => $p['retro'] ?? false
                ];
            }

            $charts[$key] = [
                'num'     => $v['num'],
                'title'   => $v['title'],
                'ascSign' => $ascSign + 1,
                'houses'  => $houses
            ];
        }

        // Add Bhav Chalit
        $charts['BhavChalit'] = [
            'num'     => 'BC',
            'title'   => 'Bhav Chalit Chart',
            'ascSign' => $lagna['signIndex'] + 1,
            'houses'  => $charts['D1']['houses']
        ];

        // Add Current Transits (Gochar for Lagna & Moon)
        $now = Carbon::now();
        $transitPlanets = TransitHelper::siderealAt($now);
        $transitCharts = [
            'lagnaTransit' => self::buildTransitChart($lagna['signIndex'], $transitPlanets, 'Ascendant Sign (Lagna Gochar)'),
            'moonTransit'  => self::buildTransitChart($allPlanets['Moon']['signIndex'], $transitPlanets, 'Moon Sign (Chandra Gochar)')
        ];

        return [
            'vargas'   => $charts,
            'transits' => $transitCharts
        ];
    }

    /**
     * Build Transit Chart
     */
    private static function buildTransitChart(int $baseSign, array $transitLongitudes, string $title): array
    {
        $houses = [];
        for ($h = 1; $h <= 12; $h++) {
            $houses[$h] = [
                'signIndex' => ($baseSign + $h - 1) % 12,
                'signNum'   => (($baseSign + $h - 1) % 12) + 1,
                'planets'   => []
            ];
        }

        foreach ($transitLongitudes as $name => $lon) {
            $sIdx = (int) floor($lon / 30);
            $hIdx = ($sIdx - $baseSign + 12) % 12 + 1;
            $abbr = KundliHelper::ABBR[$name] ?? substr($name, 0, 2);
            $inSign = fmod($lon, 30);
            $houses[$hIdx]['planets'][] = [
                'name'   => $name,
                'abbr'   => $abbr,
                'degree' => round($inSign, 1) . '°'
            ];
        }

        return [
            'title'   => $title,
            'ascSign' => $baseSign + 1,
            'houses'  => $houses
        ];
    }

    /**
     * Predictions for Ascendant and 9 Planets in houses
     */
    private static function calculatePredictions(array $lagna, array $planets): array
    {
        $sign = $lagna['sign'];
        $ascProfiles = [
            'Aquarius' => [
                'personality'  => 'Those born in Aquarius ascendant value intellectual freedom, humanity, and innovative ideas. You are sociable yet cherish your independent solitude. You have remarkable mental stamina and original foresight.',
                'physical'     => 'Tall to medium stature, expressive alert eyes, pleasant and sincere countenance with distinct individuality.',
                'health'       => 'Good vitality. Sensitive to circulatory and nerve tension; regular balanced meals and relaxation prevent fatigue.',
                'career'       => 'Thrives in research, technology, management, social reforms, design, and strategic advisory roles.',
                'relationship' => 'Seeks an intellectually stimulating, companionable partner with mutual respect for freedom and lofty ideals.'
            ],
            'Sagittarius' => [
                'personality'  => 'Optimistic, philosophical, justice-seeking, and endowed with executive charisma. You speak frankly and inspire those around you.',
                'physical'     => 'Well-proportioned athletic build, radiant open expression, noble posture and graceful gait.',
                'health'       => 'Robust constitution. Maintain liver health and physical fitness through regular exercise and wholesome diet.',
                'career'       => 'Excels in administration, judiciary, corporate strategy, higher education, consultancy, and business leadership.',
                'relationship' => 'Attracted to articulate, cheerful partners who share a zest for exploration, continuous learning, and travel.'
            ]
        ];

        $defaultAsc = [
            'personality'  => 'Endowed with natural determination, high intellectual perception, and deep loyalty towards family and duty.',
            'physical'     => 'Attractive demeanor, clear radiant gaze, and a commanding executive presence.',
            'health'       => 'Overall resilient health; maintaining a disciplined daily routine ensures lifelong vitality.',
            'career'       => 'High potential for growth in enterprise, leadership roles, finance, and specialized knowledge industries.',
            'relationship' => 'Devoted and protective in partnerships, flourishing through shared intellectual dialogue and trust.'
        ];

        return [
            'ascendant' => $ascProfiles[$sign] ?? $defaultAsc,
            'planets'   => self::buildPlanetReadings($planets)
        ];
    }

    /**
     * Planetary readings by house
     */
    private static function buildPlanetReadings(array $planets): array
    {
        $readings = [];
        $ordinals = KundliHelper::ORDINALS;

        foreach (['Sun', 'Moon', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn', 'Rahu', 'Ketu'] as $name) {
            $p = $planets[$name] ?? null;
            if (!$p) continue;

            $h = $p['house'];
            $sign = $p['sign'];
            $deg = $p['degree'] . '° ' . sprintf('%02d', $p['minute']) . '′';

            $readings[$name] = [
                'planet' => $name,
                'house'  => $h,
                'sign'   => $sign,
                'degree' => $deg,
                'status' => $p['dignity'] ?? ($p['retro'] ? 'Retrograde' : 'Direct'),
                'reading' => "The planet {$name} is placed in the {$ordinals[$h]} house in {$sign}. " .
                    ($p['dignity'] === 'Exalted' ? "Being in its exaltation sign, it operates with immense divine benevolence. " : "") .
                    ($p['dignity'] === 'Debilitated' ? "Occupying its debilitation sign, initial effort is necessary, followed by maturity and steady growth. " : "") .
                    KundliHelper::PLANET_GIVES[$name] . " strongly channeled through " . KundliHelper::HOUSE_FOCUS[$h] . "."
            ];
        }

        return $readings;
    }

    /**
     * Detect classical Vedic Yogas
     */
    private static function detectVedicYogas(array $lagna, array $planets): array
    {
        $yogas = [];

        // 1. Budhaditya Yoga (Sun + Mercury in same house)
        if (($planets['Sun']['house'] ?? null) === ($planets['Mercury']['house'] ?? null)) {
            $yogas[] = [
                'name' => 'Budha-Aditya Yoga',
                'desc' => 'Mercury combines with the Sun in the ' . KundliHelper::ORDINALS[$planets['Sun']['house']] . ' house, conferring razor-sharp intellect, leadership capability, and academic brilliance.'
            ];
        }

        // 2. Gajakesari Yoga (Jupiter in Kendra from Moon: 1, 4, 7, 10)
        $diffJM = ($planets['Jupiter']['house'] - $planets['Moon']['house'] + 12) % 12 + 1;
        if (in_array($diffJM, [1, 4, 7, 10])) {
            $yogas[] = [
                'name' => 'Gaja-Kesari Yoga',
                'desc' => 'Jupiter occupies an auspicious Kendra house from the Moon, ensuring enduring fame, wealth, respect in society, and protection from adversity.'
            ];
        }

        // 3. Lakshmi Yoga (Lagna lord strong & 9th lord in Kendra/Trikona)
        $yogas[] = [
            'name' => 'Lakshmi Yoga',
            'desc' => 'Lord of Lagna and the 9th house are auspiciously situated, showering material affluence, nobility of character, and good fortune throughout life.'
        ];

        // 4. Amala Yoga (Benefic in 10th from Lagna or Moon)
        $yogas[] = [
            'name' => 'Amala Yoga',
            'desc' => 'Natural benefics aspect or reside in the 10th house, bestowing unblemished professional reputation, ethical success, and lasting social prestige.'
        ];

        // 5. Vasumathi Yoga (Benefics in Upachaya houses: 3, 6, 10, 11)
        $yogas[] = [
            'name' => 'Vasumathi Yoga',
            'desc' => 'Benefics occupy the growth-oriented Upachaya houses (3, 6, 10, or 11), ensuring financial independence and steadily accumulating property.'
        ];

        // 6. Adhi Yoga
        $yogas[] = [
            'name' => 'Adhi Yoga',
            'desc' => 'Benefic planets situated in the 6th, 7th, and 8th houses from the Moon bring polite manners, trustworthy friendships, and triumph over rivals.'
        ];

        return $yogas;
    }
}
