<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Birth chart (Lagna kundli) from the real sidereal positions (Lahiri) of the
 * nine grahas, with whole-sign houses, plus the Rashi, Nakshatra and Sun sign reports.
 */
class KundliHelper
{
    const ABBR = ['Sun' => 'Su', 'Moon' => 'Mo', 'Mars' => 'Ma', 'Mercury' => 'Me', 'Jupiter' => 'Ju', 'Venus' => 'Ve', 'Saturn' => 'Sa', 'Rahu' => 'Ra', 'Ketu' => 'Ke'];

    const ORDINALS = [1 => '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th'];

    // Sign (0 = Aries) in which each planet is exalted; it is debilitated in the opposite sign
    const EXALTED = ['Sun' => 0, 'Moon' => 1, 'Mars' => 9, 'Mercury' => 5, 'Jupiter' => 3, 'Venus' => 11, 'Saturn' => 6];

    // Mooltrikona sign of each planet (the Moon's and Mercury's fall in their exaltation signs)
    const MOOLTRIKONA = ['Sun' => 4, 'Mars' => 0, 'Jupiter' => 8, 'Venus' => 6, 'Saturn' => 10];

    // Natural friends and enemies of each planet; every other planet is neutral to it
    const FRIENDS = [
        'Sun' => ['Moon', 'Mars', 'Jupiter'], 'Moon' => ['Sun', 'Mercury'], 'Mars' => ['Sun', 'Moon', 'Jupiter'], 'Mercury' => ['Sun', 'Venus'],
        'Jupiter' => ['Sun', 'Moon', 'Mars'], 'Venus' => ['Mercury', 'Saturn'], 'Saturn' => ['Mercury', 'Venus'],
    ];
    const ENEMIES = [
        'Sun' => ['Venus', 'Saturn'], 'Moon' => [], 'Mars' => ['Mercury'], 'Mercury' => ['Moon'],
        'Jupiter' => ['Mercury', 'Venus'], 'Venus' => ['Sun', 'Moon'], 'Saturn' => ['Sun', 'Moon', 'Mars'],
    ];

    // Degrees from the Sun within which a planet is combust
    const COMBUST_ORB = ['Moon' => 12, 'Mars' => 17, 'Mercury' => 14, 'Jupiter' => 11, 'Venus' => 10, 'Saturn' => 15];

    // Baladi Avastha: the five stages of six degrees each, in this order in odd signs and reversed in even signs
    const AVASTHAS = ['Bala', 'Kumara', 'Yuva', 'Vriddha', 'Mrita'];

    // Approximate dates of the Sun in each sidereal sign, Aries first
    const VEDIC_SUN_DATES = [
        'Apr 14 – May 14', 'May 15 – Jun 14', 'Jun 15 – Jul 16', 'Jul 17 – Aug 16', 'Aug 17 – Sep 16', 'Sep 17 – Oct 17',
        'Oct 18 – Nov 16', 'Nov 17 – Dec 15', 'Dec 16 – Jan 14', 'Jan 15 – Feb 12', 'Feb 13 – Mar 14', 'Mar 15 – Apr 13',
    ];

    const HOUSE_FOCUS = [
        1  => 'yourself, your body and your personality',
        2  => 'wealth, family and speech',
        3  => 'courage, siblings and your own effort',
        4  => 'home, mother and comfort',
        5  => 'children, love and intellect',
        6  => 'health, debts and overcoming opposition',
        7  => 'marriage and partnerships',
        8  => 'longevity, sudden events and hidden matters',
        9  => 'luck, dharma and father',
        10 => 'career and status',
        11 => 'gains, friends and fulfilled wishes',
        12 => 'expenses, foreign lands and moksha',
    ];

    const PLANET_GIVES = [
        'Sun'     => 'Your confidence, ambition and need for recognition are',
        'Moon'    => 'Your feelings, peace of mind and sense of belonging are',
        'Mars'    => 'Your energy, courage and competitive drive are',
        'Mercury' => 'Your thinking, speech and business sense are',
        'Jupiter' => 'Your wisdom, growth and good fortune are',
        'Venus'   => 'Your love, comforts and sense of beauty are',
        'Saturn'  => 'Your discipline, patience and hardest lessons are',
        'Rahu'    => 'Your strongest worldly desires and ambitions are',
        'Ketu'    => 'Your detachment and the skills you were born with are',
    ];

    // Gemstone, day and colour that go with the lord of a sign
    const PLANET_LUCK = [
        'Sun'     => ['gem' => 'Ruby (Manik)', 'day' => 'Sunday', 'colour' => 'Orange, Gold', 'number' => 1],
        'Moon'    => ['gem' => 'Pearl (Moti)', 'day' => 'Monday', 'colour' => 'White, Silver', 'number' => 2],
        'Mars'    => ['gem' => 'Red Coral (Moonga)', 'day' => 'Tuesday', 'colour' => 'Red', 'number' => 9],
        'Mercury' => ['gem' => 'Emerald (Panna)', 'day' => 'Wednesday', 'colour' => 'Green', 'number' => 5],
        'Jupiter' => ['gem' => 'Yellow Sapphire (Pukhraj)', 'day' => 'Thursday', 'colour' => 'Yellow', 'number' => 3],
        'Venus'   => ['gem' => 'Diamond (Heera)', 'day' => 'Friday', 'colour' => 'White, Pink', 'number' => 6],
        'Saturn'  => ['gem' => 'Blue Sapphire (Neelam)', 'day' => 'Saturday', 'colour' => 'Blue, Black', 'number' => 8],
    ];

    // Western (tropical) Sun sign dates, Aries first. They shift by a day in some years.
    const SUN_DATES = [
        'Mar 21 – Apr 19', 'Apr 20 – May 20', 'May 21 – Jun 20', 'Jun 21 – Jul 22', 'Jul 23 – Aug 22', 'Aug 23 – Sep 22',
        'Sep 23 – Oct 22', 'Oct 23 – Nov 21', 'Nov 22 – Dec 21', 'Dec 22 – Jan 19', 'Jan 20 – Feb 18', 'Feb 19 – Mar 20',
    ];

    // 'sun' = the sign as a Sun sign (will, identity), 'moon' = the same sign as a Rashi (mind, feelings)
    const SIGN_PROFILES = [
        'Aries' => [
            'sun'        => 'The Sun in Aries gives a direct, pioneering nature. You like to be first, decide quickly and feel most alive when there is a challenge in front of you.',
            'moon'       => 'With the Moon in Mesh rashi your feelings are quick and honest. You react at once, cool down just as fast and feel restless when life becomes too slow.',
            'strengths'  => 'Courage, initiative, honesty, quick recovery',
            'weaknesses' => 'Impatience, temper, starting more than you finish',
            'compatible' => 'Leo, Sagittarius, Gemini, Aquarius',
        ],
        'Taurus' => [
            'sun'        => 'The Sun in Taurus gives a steady, practical nature. You build slowly, value comfort and security, and rarely give up on what you have decided to do.',
            'moon'       => 'With the Moon in Vrishabh rashi, where it is exalted, the mind is calm and content. You need stability, good food and familiar surroundings to feel at peace.',
            'strengths'  => 'Patience, loyalty, reliability, good taste',
            'weaknesses' => 'Stubbornness, possessiveness, dislike of change',
            'compatible' => 'Virgo, Capricorn, Cancer, Pisces',
        ],
        'Gemini' => [
            'sun'        => 'The Sun in Gemini gives a curious, talkative nature. You learn fast, enjoy variety and express yourself best through words and ideas.',
            'moon'       => 'With the Moon in Mithun rashi the mind is always moving. You need conversation and new information, and you understand your feelings by talking them through.',
            'strengths'  => 'Wit, adaptability, communication, quick learning',
            'weaknesses' => 'Restlessness, indecision, scattered attention',
            'compatible' => 'Libra, Aquarius, Aries, Leo',
        ],
        'Cancer' => [
            'sun'        => 'The Sun in Cancer gives a caring, protective nature. Home and family are the centre of your world, and you lead by looking after people.',
            'moon'       => 'With the Moon in Kark rashi, its own sign, feelings run deep and intuition is strong. You remember everything and need emotional security above all.',
            'strengths'  => 'Care, intuition, memory, loyalty to family',
            'weaknesses' => 'Moodiness, over-sensitivity, holding on to the past',
            'compatible' => 'Scorpio, Pisces, Taurus, Virgo',
        ],
        'Leo' => [
            'sun'        => 'The Sun in Leo is in its own sign and gives a warm, confident and generous nature. You are a natural leader and do your best work when you are appreciated.',
            'moon'       => 'With the Moon in Simha rashi the heart is proud and generous. You need respect and affection, and you protect the people you love fiercely.',
            'strengths'  => 'Confidence, generosity, leadership, loyalty',
            'weaknesses' => 'Pride, stubbornness, need for attention',
            'compatible' => 'Aries, Sagittarius, Gemini, Libra',
        ],
        'Virgo' => [
            'sun'        => 'The Sun in Virgo gives a careful, analytical nature. You notice details others miss, like to be useful and improve whatever you touch.',
            'moon'       => 'With the Moon in Kanya rashi the mind is orderly and observant. You feel settled when things are clean, planned and under control, and you worry when they are not.',
            'strengths'  => 'Analysis, discipline, helpfulness, modesty',
            'weaknesses' => 'Worry, criticism, perfectionism',
            'compatible' => 'Taurus, Capricorn, Cancer, Scorpio',
        ],
        'Libra' => [
            'sun'        => 'The Sun in Libra gives a fair, charming and diplomatic nature. You look for balance in everything and work best in partnership with others.',
            'moon'       => 'With the Moon in Tula rashi the mind seeks harmony. You are happiest in good company and pleasant surroundings, and conflict disturbs you deeply.',
            'strengths'  => 'Fairness, charm, diplomacy, refined taste',
            'weaknesses' => 'Indecision, avoiding conflict, dependence on others',
            'compatible' => 'Gemini, Aquarius, Leo, Sagittarius',
        ],
        'Scorpio' => [
            'sun'        => 'The Sun in Scorpio gives an intense, determined and private nature. You see beneath the surface, commit completely and do not forget easily.',
            'moon'       => 'With the Moon in Vrishchik rashi, where it is debilitated, feelings are powerful and kept hidden. You trust slowly, love deeply and need to learn to let go.',
            'strengths'  => 'Determination, depth, loyalty, sharp intuition',
            'weaknesses' => 'Secrecy, jealousy, holding grudges',
            'compatible' => 'Cancer, Pisces, Virgo, Capricorn',
        ],
        'Sagittarius' => [
            'sun'        => 'The Sun in Sagittarius gives an optimistic, frank and freedom-loving nature. You look for meaning, love to travel and learn, and speak the truth as you see it.',
            'moon'       => 'With the Moon in Dhanu rashi the mind is hopeful and principled. You need space, purpose and something to believe in to feel at peace.',
            'strengths'  => 'Optimism, honesty, generosity, love of learning',
            'weaknesses' => 'Bluntness, restlessness, over-promising',
            'compatible' => 'Aries, Leo, Libra, Aquarius',
        ],
        'Capricorn' => [
            'sun'        => 'The Sun in Capricorn gives a disciplined, ambitious and responsible nature. You climb patiently, take duty seriously and usually succeed later but for longer.',
            'moon'       => 'With the Moon in Makar rashi the mind is serious and practical. You hide your feelings behind work and feel secure only when your responsibilities are met.',
            'strengths'  => 'Discipline, patience, responsibility, endurance',
            'weaknesses' => 'Pessimism, rigidity, working too much',
            'compatible' => 'Taurus, Virgo, Scorpio, Pisces',
        ],
        'Aquarius' => [
            'sun'        => 'The Sun in Aquarius gives an independent, original and humanitarian nature. You think for yourself and care about ideas that help many people.',
            'moon'       => 'With the Moon in Kumbh rashi the mind is thoughtful and detached. You make friends easily but share your deepest feelings with very few.',
            'strengths'  => 'Originality, fairness, friendliness, vision',
            'weaknesses' => 'Emotional distance, stubborn opinions, unpredictability',
            'compatible' => 'Gemini, Libra, Aries, Sagittarius',
        ],
        'Pisces' => [
            'sun'        => 'The Sun in Pisces gives a gentle, imaginative and compassionate nature. You sense what others feel and are drawn to art, healing and the spiritual side of life.',
            'moon'       => 'With the Moon in Meen rashi the mind is soft, dreamy and devotional. You absorb the moods around you and need quiet time to return to yourself.',
            'strengths'  => 'Compassion, imagination, intuition, forgiveness',
            'weaknesses' => 'Escapism, indecision, being too trusting',
            'compatible' => 'Cancer, Scorpio, Taurus, Capricorn',
        ],
    ];

    const GANAS = ['Deva', 'Manushya', 'Rakshasa'];
    const NADIS = ['Adi (Vata)', 'Madhya (Pitta)', 'Antya (Kapha)'];

    // Per nakshatra: [deity, symbol, gana index, animal (yoni), the four pada syllables, nature]
    const NAKSHATRA_DATA = [
        ['Ashwini Kumaras', 'Horse\'s head', 0, 'Horse', 'Chu, Che, Cho, La', 'Quick, energetic and eager to help. Ashwini natives start things fast, heal others naturally and dislike being held back.'],
        ['Yama', 'Yoni (the womb)', 1, 'Elephant', 'Li, Lu, Le, Lo', 'Strong-willed, truthful and able to carry heavy responsibility. Bharani natives live intensely and see things through to the end.'],
        ['Agni', 'Razor or flame', 2, 'Sheep', 'A, I, U, E', 'Sharp, determined and straightforward. Krittika natives cut through confusion, speak directly and have a warm, protective core.'],
        ['Brahma', 'Chariot', 1, 'Serpent', 'O, Va, Vi, Vu', 'Attractive, creative and fond of comfort. Rohini natives are steady, artistic and draw people to them without effort.'],
        ['Soma (Moon)', 'Deer\'s head', 0, 'Serpent', 'Ve, Vo, Ka, Ki', 'Curious, gentle and always searching. Mrigashirsha natives love to explore, learn and travel, and are sensitive by nature.'],
        ['Rudra', 'Teardrop', 1, 'Dog', 'Ku, Gha, Ng, Chha', 'Intense, intelligent and transformed by struggle. Ardra natives think deeply and grow strongest after their storms.'],
        ['Aditi', 'Quiver of arrows', 0, 'Cat', 'Ke, Ko, Ha, Hi', 'Kind, content and able to begin again. Punarvasu natives are simple at heart, optimistic and return stronger after every setback.'],
        ['Brihaspati', 'Cow\'s udder', 0, 'Sheep', 'Hu, He, Ho, Da', 'Nourishing, calm and dutiful. Pushya is counted the most auspicious nakshatra, and its natives care for and support others.'],
        ['Nagas (serpents)', 'Coiled serpent', 2, 'Cat', 'Di, Du, De, Do', 'Perceptive, shrewd and hard to deceive. Ashlesha natives have a penetrating mind, strong intuition and a private nature.'],
        ['Pitris (ancestors)', 'Royal throne', 2, 'Rat', 'Ma, Mi, Mu, Me', 'Dignified, proud and respectful of tradition. Magha natives carry natural authority and honour their family line.'],
        ['Bhaga', 'Front legs of a bed', 1, 'Rat', 'Mo, Ta, Ti, Tu', 'Cheerful, affectionate and fond of pleasure. Purva Phalguni natives are creative, sociable and enjoy the good things of life.'],
        ['Aryaman', 'Back legs of a bed', 1, 'Cow', 'Te, To, Pa, Pi', 'Helpful, dependable and generous. Uttara Phalguni natives keep their word and build lasting friendships and partnerships.'],
        ['Savitar (Sun)', 'Open hand', 0, 'Buffalo', 'Pu, Sha, Na, Tha', 'Skilful, clever and hard-working. Hasta natives are good with their hands, resourceful and quick-witted.'],
        ['Vishwakarma', 'Bright jewel', 2, 'Tiger', 'Pe, Po, Ra, Ri', 'Artistic, elegant and drawn to design. Chitra natives have an eye for beauty and like to create things that stand out.'],
        ['Vayu', 'Young shoot in the wind', 0, 'Buffalo', 'Ru, Re, Ro, Ta', 'Independent, flexible and fair. Swati natives value freedom, learn on their own and do well in business.'],
        ['Indra and Agni', 'Triumphal arch', 2, 'Tiger', 'Ti, Tu, Te, To', 'Ambitious, focused and determined to reach the goal. Vishakha natives are patient in pursuit and powerful speakers.'],
        ['Mitra', 'Lotus', 0, 'Deer', 'Na, Ni, Nu, Ne', 'Friendly, devoted and good at bringing people together. Anuradha natives succeed away from their birthplace and value loyalty.'],
        ['Indra', 'Circular amulet', 2, 'Deer', 'No, Ya, Yi, Yu', 'Protective, capable and senior in spirit. Jyeshtha natives take charge, guard their own and carry responsibility early.'],
        ['Nirriti', 'Bunch of roots', 2, 'Dog', 'Ye, Yo, Bha, Bhi', 'Deep, investigative and drawn to the root of things. Mula natives question everything and rebuild life from its foundation.'],
        ['Apas (water)', 'Elephant tusk', 1, 'Monkey', 'Bhu, Dha, Pha, Dha', 'Confident, persuasive and unwilling to accept defeat. Purva Ashadha natives are proud, convincing and renew themselves easily.'],
        ['Vishvadevas', 'Elephant tusk', 1, 'Mongoose', 'Bhe, Bho, Ja, Ji', 'Principled, patient and built for lasting victory. Uttara Ashadha natives are responsible, respected and steady in effort.'],
        ['Vishnu', 'Ear', 0, 'Monkey', 'Khi, Khu, Khe, Kho', 'Attentive, learned and a good listener. Shravana natives gather knowledge, respect tradition and are well regarded.'],
        ['Eight Vasus', 'Drum', 2, 'Lion', 'Ga, Gi, Gu, Ge', 'Generous, bold and musical. Dhanishta natives have rhythm, earn well and like to share what they have.'],
        ['Varuna', 'Empty circle', 2, 'Horse', 'Go, Sa, Si, Su', 'Independent, secretive and a natural healer. Shatabhisha natives think in their own way and prefer truth to comfort.'],
        ['Aja Ekapada', 'Front legs of a cot', 1, 'Lion', 'Se, So, Da, Di', 'Intense, idealistic and two-sided. Purva Bhadrapada natives are passionate about their beliefs and can transform their lives completely.'],
        ['Ahir Budhnya', 'Back legs of a cot', 1, 'Cow', 'Du, Tha, Jha, Na', 'Calm, wise and self-controlled. Uttara Bhadrapada natives are kind, deep-thinking and dependable in a crisis.'],
        ['Pushan', 'Fish', 0, 'Elephant', 'De, Do, Cha, Chi', 'Gentle, caring and protective of others. Revati natives are compassionate, creative and guide people safely on their way.'],
    ];

    private static function rev(float $x): float
    {
        $x = fmod($x, 360);
        return $x < 0 ? $x + 360 : $x;
    }

    /**
     * Everything read from one sidereal longitude: sign, degree, nakshatra, pada and navamsa sign.
     */
    public static function point(float $lon): array
    {
        $span = 360 / 27;
        $sign = (int) floor($lon / 30);
        $inSign = fmod($lon, 30);
        $nak = (int) floor($lon / $span);

        return [
            'lon'       => $lon,
            'signIndex' => $sign,
            'sign'      => TransitHelper::SIGNS[$sign],
            'hindi'     => AscendantHelper::HINDI[$sign],
            'symbol'    => AscendantHelper::SYMBOLS[$sign],
            'lord'      => AscendantHelper::LORDS[$sign],
            'element'   => AscendantHelper::ELEMENTS[$sign % 4],
            'quality'   => AscendantHelper::QUALITIES[$sign % 3],
            'inSign'    => $inSign,
            'degree'    => (int) floor($inSign),
            'minute'    => (int) floor(($inSign - floor($inSign)) * 60),
            'nakIndex'  => $nak,
            'nakshatra' => TransitHelper::NAKSHATRAS[$nak],
            'pada'      => (int) floor(fmod($lon, $span) / ($span / 4)) + 1,
            'nakLord'   => array_keys(DashaHelper::PLANET_YEARS)[$nak % 9],
            // each sign has nine navamsas of 3°20', counted on from Aries without a break
            'navamsa'   => (int) floor($lon / (30 / 9)) % 12,
        ];
    }

    /**
     * Status of a planet in a sign: Exalted, Debilitated, Mooltrikona, Own sign,
     * or Friendly / Enemy / Neutral by its relation with the lord of the sign. Null for Rahu and Ketu.
     */
    public static function dignity(string $planet, int $sign): ?string
    {
        if (!isset(self::EXALTED[$planet])) return null;

        if (self::EXALTED[$planet] === $sign) return 'Exalted';
        if ((self::EXALTED[$planet] + 6) % 12 === $sign) return 'Debilitated';
        if ((self::MOOLTRIKONA[$planet] ?? null) === $sign) return 'Mooltrikona';

        $lord = AscendantHelper::LORDS[$sign];
        if ($lord === $planet) return 'Own sign';
        if (in_array($lord, self::FRIENDS[$planet])) return 'Friendly';

        return in_array($lord, self::ENEMIES[$planet]) ? 'Enemy' : 'Neutral';
    }

    // Stage of life (Baladi Avastha) of a planet from its degree in the sign
    private static function avastha(float $inSign, int $sign): string
    {
        $stage = min(4, (int) floor($inSign / 6));

        return self::AVASTHAS[$sign % 2 === 0 ? $stage : 4 - $stage];
    }

    /**
     * Lagna and the nine grahas at a birth moment and place.
     * ['lagna' => point, 'planets' => [name => point + house, retro, dignity]]
     */
    public static function chart(Carbon $birth, float $lat, float $lng): array
    {
        $now = TransitHelper::siderealAt($birth);
        $later = TransitHelper::siderealAt($birth->copy()->addHour());
        $lagna = self::point(self::rev(AscendantHelper::tropicalAscendant($birth, $lat, $lng) - TransitHelper::ayanamsa($birth)));

        $planets = [];
        foreach (TransitHelper::PLANETS as $name) {
            $p = self::point($now[$name]);
            $p['house'] = ($p['signIndex'] - $lagna['signIndex'] + 12) % 12 + 1;
            $p['retro'] = in_array($name, ['Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn'])
                && self::rev($later[$name] - $now[$name] + 180) - 180 < 0;
            $p['dignity'] = self::dignity($name, $p['signIndex']);
            $p['avastha'] = self::avastha($p['inSign'], $p['signIndex']);
            // too close to the Sun to be seen; a retrograde Mercury or Venus has a narrower limit
            $orb = (self::COMBUST_ORB[$name] ?? 0) - ($p['retro'] && in_array($name, ['Mercury', 'Venus']) ? 2 : 0);
            $p['combust'] = $orb > 0 && abs(self::rev($now[$name] - $now['Sun'] + 180) - 180) <= $orb;
            $planets[$name] = $p;
        }

        return ['lagna' => $lagna, 'planets' => $planets];
    }

    // Twelve houses of a chart: [house => ['signIndex' => 5, 'planets' => ['Su', 'Me']]]
    public static function houses(int $lagnaSign, array $planetSigns): array
    {
        $houses = [];
        for ($h = 1; $h <= 12; $h++) {
            $houses[$h] = ['signIndex' => ($lagnaSign + $h - 1) % 12, 'planets' => []];
        }
        foreach ($planetSigns as $name => $sign) {
            $houses[($sign - $lagnaSign + 12) % 12 + 1]['planets'][] = self::ABBR[$name];
        }

        return $houses;
    }

    /**
     * Full birth chart report: Lagna (D1) and Navamsa (D9) charts, planet table and readings.
     */
    public static function birthChart(Carbon $birth, float $lat, float $lng): array
    {
        $chart = self::chart($birth, $lat, $lng);
        $lagna = $chart['lagna'];
        $planets = $chart['planets'];

        $readings = [];
        foreach ($planets as $name => $p) {
            $text = self::PLANET_GIVES[$name] . ' centred on ' . self::HOUSE_FOCUS[$p['house']] . '.';

            if ($p['dignity'] === 'Exalted') {
                $text .= ' ' . $name . ' is exalted in ' . $p['sign'] . ', so it gives its best results.';
            } elseif ($p['dignity'] === 'Debilitated') {
                $text .= ' ' . $name . ' is debilitated in ' . $p['sign'] . ', so its results come with extra effort.';
            } elseif (in_array($p['dignity'], ['Own sign', 'Mooltrikona'])) {
                $text .= ' ' . $name . ' is in its own sign, ' . $p['sign'] . ', where it is strong and comfortable.';
            } elseif ($p['dignity'] === 'Enemy') {
                $text .= ' ' . $name . ' is in ' . $p['sign'] . ', the sign of its enemy ' . $p['lord'] . ', so it works under some strain.';
            }
            if ($p['combust']) {
                $text .= ' It is combust, very close to the Sun, which weakens its independent results.';
            }
            if ($p['retro']) {
                $text .= ' It was retrograde at your birth, which turns its energy inward and makes its results arrive later.';
            }

            $readings[$name] = $text;
        }

        return [
            'lagna'     => $lagna,
            'planets'   => $planets,
            'readings'  => $readings,
            'charts'    => [
                'Lagna Chart (D1)'   => self::houses($lagna['signIndex'], array_map(fn ($p) => $p['signIndex'], $planets)),
                'Navamsa Chart (D9)' => self::houses($lagna['navamsa'], array_map(fn ($p) => $p['navamsa'], $planets)),
            ],
            'dasha'     => DashaHelper::report($birth),
            'lagnaText' => AscendantHelper::READINGS[$lagna['sign']]['about'],
            // close to a sign boundary, where a few minutes' error in the birth time changes every house
            'nearCusp'  => $lagna['inSign'] < 1.5 || $lagna['inSign'] > 28.5,
        ];
    }

    /**
     * Janma Rashi: the sign of the Moon at birth.
     */
    public static function rashi(Carbon $birth): array
    {
        $moon = self::point(TransitHelper::siderealAt($birth)['Moon']);

        return $moon + [
            'profile'   => self::SIGN_PROFILES[$moon['sign']],
            'luck'      => self::PLANET_LUCK[$moon['lord']],
            'syllables' => self::rashiSyllables($moon['signIndex']),
            // the Moon crosses one degree in about two hours
            'nearCusp'  => $moon['inSign'] < 1 || $moon['inSign'] > 29,
        ];
    }

    // Name syllables of every nakshatra pada that falls in a sign (nine padas per sign)
    private static function rashiSyllables(int $sign): string
    {
        $out = [];
        for ($pada = $sign * 9; $pada < $sign * 9 + 9; $pada++) {
            $out[] = explode(', ', self::NAKSHATRA_DATA[intdiv($pada, 4)][4])[$pada % 4];
        }

        return implode(', ', array_unique($out));
    }

    /**
     * Janma Nakshatra: the star of the Moon at birth, with its pada.
     */
    public static function nakshatra(Carbon $birth): array
    {
        $moon = self::point(TransitHelper::siderealAt($birth)['Moon']);
        [$deity, $symbol, $gana, $animal, $syllables, $nature] = self::NAKSHATRA_DATA[$moon['nakIndex']];

        $span = 360 / 27;
        $elapsed = fmod($moon['lon'], $span) / $span;

        return $moon + [
            'deity'        => $deity,
            'nakSymbol'    => $symbol,
            'gana'         => self::GANAS[$gana],
            'animal'       => $animal,
            'nadi'         => self::NADIS[[0, 1, 2, 2, 1, 0][$moon['nakIndex'] % 6]],
            'syllables'    => $syllables,
            'padaSyllable' => explode(', ', $syllables)[$moon['pada'] - 1],
            'nature'       => $nature,
            'career'       => NakshatraHelper::READINGS[$moon['nakIndex']][0],
            'marriage'     => NakshatraHelper::READINGS[$moon['nakIndex']][1],
            'health'       => NakshatraHelper::READINGS[$moon['nakIndex']][2],
            'padas'        => NakshatraHelper::padas($moon['nakIndex']),
            'number'       => $moon['nakIndex'] + 1,
            'dashaYears'   => DashaHelper::PLANET_YEARS[$moon['nakLord']],
            // near a nakshatra border, where a small error in the birth time changes the star
            'nearCusp'     => $elapsed < 0.04 || $elapsed > 0.96,
        ];
    }

    /**
     * Sun sign in the Western (tropical) zodiac, with the Vedic (sidereal) Sun sign alongside.
     */
    public static function sunSign(Carbon $birth): array
    {
        $sidereal = TransitHelper::siderealAt($birth)['Sun'];
        $western = self::point(self::rev($sidereal + TransitHelper::ayanamsa($birth)));
        $vedic = self::point($sidereal);

        return [
            'western'  => $western,
            'vedic'    => $vedic,
            'dates'    => self::SUN_DATES[$western['signIndex']],
            'vedicDates'   => self::VEDIC_SUN_DATES[$vedic['signIndex']],
            'vedicProfile' => self::SIGN_PROFILES[$vedic['sign']],
            'profile'  => self::SIGN_PROFILES[$western['sign']],
            'luck'     => self::PLANET_LUCK[$western['lord']],
            // the Sun moves about one degree a day, so this is the day the sign changes
            'nearCusp' => $western['inSign'] < 0.5 || $western['inSign'] > 29.5,
        ];
    }
}
