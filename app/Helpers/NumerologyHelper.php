<?php

namespace App\Helpers;

class NumerologyHelper
{
    const VOWELS = ['A', 'E', 'I', 'O', 'U'];

    // Letter values per system. Chaldean uses 1-8 only (9 is kept sacred); Pythagorean runs A=1 ... I=9 and repeats.
    const CHARTS = [
        'chaldean' => [
            'A' => 1, 'I' => 1, 'J' => 1, 'Q' => 1, 'Y' => 1,
            'B' => 2, 'K' => 2, 'R' => 2,
            'C' => 3, 'G' => 3, 'L' => 3, 'S' => 3,
            'D' => 4, 'M' => 4, 'T' => 4,
            'E' => 5, 'H' => 5, 'N' => 5, 'X' => 5,
            'U' => 6, 'V' => 6, 'W' => 6,
            'O' => 7, 'Z' => 7,
            'F' => 8, 'P' => 8,
        ],
        'pythagorean' => [
            'A' => 1, 'J' => 1, 'S' => 1,
            'B' => 2, 'K' => 2, 'T' => 2,
            'C' => 3, 'L' => 3, 'U' => 3,
            'D' => 4, 'M' => 4, 'V' => 4,
            'E' => 5, 'N' => 5, 'W' => 5,
            'F' => 6, 'O' => 6, 'X' => 6,
            'G' => 7, 'P' => 7, 'Y' => 7,
            'H' => 8, 'Q' => 8, 'Z' => 8,
            'I' => 9, 'R' => 9,
        ],
    ];

    // Cheiro's letter values are the Chaldean ones; the two systems differ only in which numbers they call compatible
    public static function chart(string $system): array
    {
        return self::CHARTS[$system === 'cheiro' ? 'chaldean' : $system] ?? self::CHARTS['chaldean'];
    }

    const SYSTEM_LABELS = [
        'cheiro'      => 'Cheiro Numerology',
        'chaldean'    => 'Chaldean Numerology',
        'pythagorean' => 'Pythagorean Numerology',
    ];

    // What each destiny number is traditionally linked with
    const DETAILS = [
        1 => ['planet' => 'Sun', 'deity' => 'Lord Surya', 'signs' => 'Leo', 'gemstone' => 'Ruby', 'days' => 'Sunday', 'numbers' => '1, 4, 8', 'direction' => 'East', 'colours' => 'Golden, Orange, Red', 'fast' => 'Sunday Vrat', 'mantra' => 'ॐ ह्रां ह्रीं ह्रौं सः सूर्याय नमः', 'dates' => '1, 10, 19, 28'],
        2 => ['planet' => 'Moon', 'deity' => 'Devi Durga', 'signs' => 'Cancer', 'gemstone' => 'Pearl', 'days' => 'Monday', 'numbers' => '2, 7', 'direction' => 'Northwest', 'colours' => 'White, Light Blue', 'fast' => 'Monday Vrat', 'mantra' => 'ॐ चन्द्राय नमः', 'dates' => '2, 11, 20, 29'],
        3 => ['planet' => 'Jupiter', 'deity' => 'Lord Vishnu', 'signs' => 'Sagittarius, Pisces', 'gemstone' => 'Yellow Sapphire', 'days' => 'Thursday', 'numbers' => '3, 6, 9', 'direction' => 'Northeast', 'colours' => 'Yellow, Saffron', 'fast' => 'Thursday Vrat', 'mantra' => 'ॐ बृं बृहस्पतये नमः', 'dates' => '3, 12, 21, 30'],
        4 => ['planet' => 'Rahu (Uranus)', 'deity' => 'Lord Ganesha', 'signs' => 'Aquarius', 'gemstone' => 'Hessonite (Gomed)', 'days' => 'Sunday, Saturday', 'numbers' => '1, 4, 8', 'direction' => 'South', 'colours' => 'Blue, Grey', 'fast' => 'Saturday Vrat', 'mantra' => 'ॐ रां राहवे नमः', 'dates' => '4, 13, 22, 31'],
        5 => ['planet' => 'Mercury', 'deity' => 'Lord Vishnu', 'signs' => 'Gemini, Virgo', 'gemstone' => 'Emerald', 'days' => 'Wednesday', 'numbers' => '1, 5, 6', 'direction' => 'North', 'colours' => 'Green, Light Brown', 'fast' => 'Wednesday Vrat', 'mantra' => 'ॐ बुं बुधाय नमः', 'dates' => '5, 14, 23'],
        6 => ['planet' => 'Venus', 'deity' => 'Goddess Lakshmi', 'signs' => 'Taurus, Libra', 'gemstone' => 'Diamond', 'days' => 'Friday', 'numbers' => '3, 6, 9', 'direction' => 'Southeast', 'colours' => 'Light Blue, Pink, White', 'fast' => 'Friday Vrat', 'mantra' => 'ॐ शुं शुक्राय नमः', 'dates' => '6, 15, 24'],
        7 => ['planet' => 'Ketu (Neptune)', 'deity' => 'Lord Shiva', 'signs' => 'Pisces', 'gemstone' => "Cat's Eye", 'days' => 'Monday, Thursday', 'numbers' => '2, 7', 'direction' => 'West', 'colours' => 'White, Grey, Purple', 'fast' => 'Monday Vrat', 'mantra' => 'ॐ केतवे नमः', 'dates' => '7, 16, 25'],
        8 => ['planet' => 'Saturn', 'deity' => 'Lord Shani', 'signs' => 'Capricorn, Aquarius', 'gemstone' => 'Blue Sapphire', 'days' => 'Saturday', 'numbers' => '1, 4, 8', 'direction' => 'Southwest', 'colours' => 'Black, Navy Blue', 'fast' => 'Saturday Vrat', 'mantra' => 'ॐ शं शनैश्चराय नमः', 'dates' => '8, 17, 26'],
        9 => ['planet' => 'Mars', 'deity' => 'Lord Hanuman', 'signs' => 'Aries, Scorpio', 'gemstone' => 'Red Coral', 'days' => 'Tuesday', 'numbers' => '3, 6, 9', 'direction' => 'South', 'colours' => 'Red, Crimson', 'fast' => 'Tuesday Vrat', 'mantra' => 'ॐ क्रां क्रीं क्रौं सः भौमाय नमः', 'dates' => '9, 18, 27'],
    ];

    public static function reduce(int $number): int
    {
        while ($number > 9) {
            $number = array_sum(str_split((string) $number));
        }
        return $number;
    }

    /**
     * Total = every letter, Soul Urge = vowels only, Personality = consonants only,
     * Destiny = total reduced to a single digit. Returns null when the name has no A-Z letters.
     */
    public static function report(string $name, string $system): ?array
    {
        $system = isset(self::SYSTEM_LABELS[$system]) ? $system : 'chaldean';
        $chart = self::chart($system);

        $total = $vowels = $consonants = 0;
        $letters = [];

        foreach (str_split(strtoupper($name)) as $char) {
            if (!isset($chart[$char])) continue;

            $value = $chart[$char];
            $isVowel = in_array($char, self::VOWELS);

            $total += $value;
            $isVowel ? $vowels += $value : $consonants += $value;
            $letters[] = ['char' => $char, 'value' => $value, 'vowel' => $isVowel];
        }

        if (empty($letters)) return null;

        $destiny = self::reduce($total);
        $alphabets = array_keys($chart, $destiny);
        sort($alphabets);

        return [
            'system'      => $system,
            'systemLabel' => self::SYSTEM_LABELS[$system],
            'letters'     => $letters,
            'total'       => $total,
            'destiny'     => $destiny,
            'soulUrge'    => self::reduce($vowels),
            'personality' => self::reduce($consonants),
            'alphabets'   => $alphabets ? implode(', ', $alphabets) : 'None (9 is kept sacred in this system)',
            'details'     => self::DETAILS[$destiny],
        ];
    }

    // Nature of each Mulank (birth number)
    const MULANK_TRAITS = [
        1 => ['title' => 'The Leader', 'nature' => 'You are independent, confident and like to take the lead. You prefer to make your own decisions and do not enjoy working under others.', 'strengths' => 'Leadership, will power, originality, self-respect', 'challenges' => 'Ego, impatience, difficulty accepting advice', 'careers' => 'Administration, government service, business, politics, management'],
        2 => ['title' => 'The Peacemaker', 'nature' => 'You are gentle, emotional and imaginative. You understand the feelings of others quickly and work best with a partner rather than alone.', 'strengths' => 'Sensitivity, imagination, cooperation, diplomacy', 'challenges' => 'Mood swings, self-doubt, over-thinking', 'careers' => 'Arts, writing, counselling, teaching, hospitality, healthcare'],
        3 => ['title' => 'The Guide', 'nature' => 'You are wise, cheerful and disciplined. People come to you for advice, and you take your duties and principles seriously.', 'strengths' => 'Knowledge, optimism, discipline, ambition', 'challenges' => 'Pride, being too strict, taking on too much', 'careers' => 'Teaching, law, banking, advisory work, religion, administration'],
        4 => ['title' => 'The Builder', 'nature' => 'You are practical, hard-working and think differently from the crowd. You build things slowly and question what others accept without thought.', 'strengths' => 'Hard work, honesty, original thinking, patience', 'challenges' => 'Stubbornness, sudden ups and downs, feeling misunderstood', 'careers' => 'Engineering, technology, research, construction, reform and social work'],
        5 => ['title' => 'The Communicator', 'nature' => 'You are quick, sociable and adapt easily. You learn fast, enjoy change and travel, and are good with words and numbers.', 'strengths' => 'Intelligence, communication, adaptability, business sense', 'challenges' => 'Restlessness, nervousness, leaving things unfinished', 'careers' => 'Business, sales, media, writing, accounts, travel, marketing'],
        6 => ['title' => 'The Charmer', 'nature' => 'You are charming, artistic and family-loving. You like beauty, comfort and harmony, and people feel at ease around you.', 'strengths' => 'Charm, creativity, responsibility, love for family', 'challenges' => 'Love of luxury, over-spending, being too attached', 'careers' => 'Arts, fashion, design, film and music, hotels, beauty and luxury goods'],
        7 => ['title' => 'The Seeker', 'nature' => 'You are thoughtful, spiritual and private. You like to look beneath the surface and need time alone to think and recharge.', 'strengths' => 'Intuition, analysis, spirituality, originality', 'challenges' => 'Isolation, restlessness, difficulty expressing feelings', 'careers' => 'Research, astrology, medicine, philosophy, writing, travel-related work'],
        8 => ['title' => 'The Achiever', 'nature' => 'You are serious, patient and determined. Success usually comes to you after struggle, but what you build tends to last.', 'strengths' => 'Discipline, patience, sense of justice, endurance', 'challenges' => 'Delays, loneliness, being too hard on yourself', 'careers' => 'Law, industry, real estate, mining, administration, social service'],
        9 => ['title' => 'The Warrior', 'nature' => 'You are bold, energetic and generous. You fight for what you believe in and are quick to protect the people you care about.', 'strengths' => 'Courage, energy, generosity, determination', 'challenges' => 'Anger, haste, taking unnecessary risks', 'careers' => 'Defence, police, sports, surgery, engineering, property'],
    ];

    // "2 + 9 = 11 → 1 + 1 = 2" for a number, or just "7" when it is already a single digit
    private static function reduceSteps(string $digits): string
    {
        $steps = [];
        while (strlen($digits) > 1) {
            $sum = array_sum(str_split($digits));
            $steps[] = implode(' + ', str_split($digits)) . ' = ' . $sum;
            $digits = (string) $sum;
        }

        return $steps ? implode(' → ', $steps) : $digits;
    }

    /**
     * Mulank = day of birth reduced to one digit, Bhagyank = the full date reduced to one digit.
     */
    public static function mulank(int $day, int $month, int $year): array
    {
        $mulank = self::reduce($day);
        $dateDigits = $day . $month . $year;

        return [
            'mulank'        => $mulank,
            'mulankSteps'   => self::reduceSteps((string) $day),
            'bhagyank'      => self::reduce((int) array_sum(str_split($dateDigits))),
            'bhagyankSteps' => self::reduceSteps($dateDigits),
            'traits'        => self::MULANK_TRAITS[$mulank],
            'details'       => self::DETAILS[$mulank],
        ];
    }

    // Numbers whose ruling planets are friends of each number's planet, and the ones that clash with it
    const FRIENDLY = [1 => [1, 2, 3, 9], 2 => [1, 2, 5], 3 => [1, 2, 3, 9], 4 => [4, 5, 6, 8], 5 => [1, 5, 6], 6 => [5, 6, 8], 7 => [6, 7, 8, 9], 8 => [5, 6, 8], 9 => [1, 2, 3, 9]];
    const AVOID = [1 => [6, 8], 2 => [4, 7], 3 => [5, 6], 4 => [1, 2, 9], 5 => [2], 6 => [1, 2], 7 => [1, 2], 8 => [1, 2, 9], 9 => [5]];

    const RELATION_LABELS = ['friendly' => 'Friendly', 'neutral' => 'Neutral', 'avoid' => 'Unfriendly'];

    // Short nature of each number, used in the mobile and vehicle readings
    const NATURE = [
        1 => 'independent and ambitious', 2 => 'gentle and cooperative', 3 => 'creative and expressive',
        4 => 'practical and disciplined', 5 => 'curious and freedom-loving', 6 => 'caring and family-oriented',
        7 => 'thoughtful and spiritual', 8 => 'determined and hard-working', 9 => 'generous and courageous',
    ];

    // Where each Bhagyank (destiny number) leads
    const DESTINY_TRAITS = [
        1 => ['title' => 'The Leader', 'path' => 'Life keeps putting you in charge. You are meant to stand on your own feet, take decisions and show others the way. Progress is fastest when you trust your own judgement.', 'work' => 'Leadership, administration, government, your own business', 'lesson' => 'To lead without ego and to accept help when it is offered.'],
        2 => ['title' => 'The Peacemaker', 'path' => 'Your life grows through people. You are meant to cooperate, care and bring others together, and your best results come in partnership and not alone.', 'work' => 'Caring professions, creative work, public dealing, counselling', 'lesson' => 'To stay steady when feelings rise and to trust your own worth.'],
        3 => ['title' => 'The Creative Soul', 'path' => 'You are here to create and to express. Words, art and ideas come easily to you, and people enjoy your company. You grow when you turn that talent into steady work.', 'work' => 'Writing, media, teaching, the arts, advisory work', 'lesson' => 'To stay focused and finish what you start.'],
        4 => ['title' => 'The Builder', 'path' => 'Your life is built step by step, often along an unusual road. You are meant to question, reform and create something solid, and sudden turns are part of your journey.', 'work' => 'Technology, research, engineering, unconventional careers', 'lesson' => 'To be patient with slow results and flexible when plans change.'],
        5 => ['title' => 'The Explorer', 'path' => 'Your life is full of movement. You are meant to learn through travel, trade and many kinds of people, and your quick mind turns change into opportunity.', 'work' => 'Business, communication, sales, travel, trade', 'lesson' => 'To finish what you start and to keep your nerves calm.'],
        6 => ['title' => 'The Caregiver', 'path' => 'Your life centres on love, home and responsibility. You are meant to look after family, create comfort and bring harmony wherever you go.', 'work' => 'Teaching, healing, arts, design, hospitality, anything that cares for people', 'lesson' => 'To look after yourself as well as you look after others.'],
        7 => ['title' => 'The Thinker', 'path' => 'Your life is an inner search. You are meant to study, reflect and find the truth behind things, and your luck rises when you follow your intuition.', 'work' => 'Research, healing, spiritual and analytical work', 'lesson' => 'To share your feelings and not to shut yourself away.'],
        8 => ['title' => 'The Achiever', 'path' => 'Your life rewards steady effort. You are meant to carry heavy responsibility, and success comes late but stays long. Nothing is handed to you, and nothing you earn is lost.', 'work' => 'Administration, industry, law, real estate, large organisations', 'lesson' => 'To keep faith during delays and to be fair with power and money.'],
        9 => ['title' => 'The Giver', 'path' => 'You are here to give. You feel for others, stand up for what is right and are happiest when your work helps people. Your courage and generosity inspire those around you.', 'work' => 'Social work, healing, defence, teaching, public service', 'lesson' => 'To master anger and to let go of what is finished.'],
    ];

    // What each number brings when it is the total of a mobile or vehicle number
    const VIBES = [
        1 => 'Number 1 carries the energy of the Sun: confidence, authority and a fresh start. It suits leaders and people who work independently.',
        2 => 'Number 2 carries the energy of the Moon: gentleness, cooperation and emotion. It suits family use and work that depends on relationships.',
        3 => 'Number 3 carries the energy of Jupiter: wisdom, growth and good fortune. It suits teachers, advisers and anyone in a guiding role.',
        4 => 'Number 4 carries the energy of Rahu: sudden turns and unconventional results. It can bring surprises, so it suits people in technical or unusual fields.',
        5 => 'Number 5 carries the energy of Mercury: speed, communication and business. It is widely considered one of the most favourable totals.',
        6 => 'Number 6 carries the energy of Venus: comfort, luxury and attraction. It suits creative people and anything connected with family and pleasure.',
        7 => 'Number 7 carries the energy of Ketu: reflection, privacy and intuition. It suits researchers and spiritual people more than commercial use.',
        8 => 'Number 8 carries the energy of Saturn: discipline, delay and endurance. Results come slowly but last, so it needs patience.',
        9 => 'Number 9 carries the energy of Mars: drive, courage and action. It suits energetic people, but it needs a calm mind.',
    ];

    // Score of two names (40-100 in steps of 10) => band: friendship label, name-compatibility label, reading
    const MATCH_BANDS = [
        40  => ['Fragile Tie', 'Fragile Tie', 'Below average. Your name numbers are far apart, so you see many things differently. The bond can work, but it will need patience from both sides.'],
        50  => ['Neutral Ground', 'Neutral Ground', 'A neutral match. There is neither a strong pull nor a clash between your numbers. With mutual respect this bond can grow.'],
        60  => ['Mild Bond', 'Mild Compatible', 'Slightly above average. You get along well, most of all when you share an interest or a goal.'],
        70  => ['Good Match', 'Good Match', 'A good match. Things flow easily between you and you enjoy each other\'s company.'],
        80  => ['Strong Bond', 'Strong Match', 'A strong connection. You understand and support each other, the kind of bond one can rely on.'],
        90  => ['Excellent Pair', 'Excellent Match', 'An excellent match. Your numbers sit side by side, which points to a lasting bond built on trust.'],
        100 => ['Soul Friends', 'Soul Mates', 'A perfect match. Both names reduce to the same number, so you think and feel alike. A bond like this is rare.'],
    ];

    // Mobile totals that agree with each destiny number
    const MOBILE_COMPATIBLE = [1 => [1, 2, 3, 5], 2 => [1, 2, 4, 6], 3 => [3, 6, 9], 4 => [1, 4, 8], 5 => [1, 5, 6, 9], 6 => [2, 3, 5, 6, 9], 7 => [2, 4, 7], 8 => [1, 4, 8], 9 => [3, 5, 6, 9]];

    // Vehicle numbers for each destiny number: fully compatible, and merely compatible. Every other number is not compatible.
    const VEHICLE_FRIENDLY = [1 => [1, 2, 3], 2 => [1, 2, 7], 3 => [3, 6, 9], 4 => [1, 4, 8], 5 => [1, 3, 5], 6 => [3, 6, 9], 7 => [2, 7], 8 => [4, 8], 9 => [3, 6, 9]];
    const VEHICLE_NEUTRAL = [1 => [5], 2 => [4, 6], 3 => [1, 5], 4 => [], 5 => [2, 6], 6 => [2, 5], 7 => [6], 8 => [1], 9 => []];

    // Numbers that agree with each number, in each system of the Lucky Name check
    const LUCKY_COMPATIBLE = [
        'pythagorean' => [1 => [1, 3, 5], 2 => [2, 4, 6], 3 => [1, 3, 9], 4 => [2, 4, 8], 5 => [1, 5, 7], 6 => [2, 3, 6, 9], 7 => [1, 5, 7], 8 => [2, 4, 8], 9 => [3, 6, 9]],
        'chaldean'    => [1 => [1, 4, 5], 2 => [2, 7], 3 => [3, 6, 9], 4 => [1, 4, 8], 5 => [1, 5, 7], 6 => [3, 6, 9], 7 => [2, 5, 7], 8 => [4, 8], 9 => [3, 6, 9]],
        'cheiro'      => [1 => [1, 3, 5], 2 => [2, 4], 3 => [3, 6, 9], 4 => [1, 4, 8], 5 => [1, 5, 7], 6 => [3, 6, 9], 7 => [2, 5, 7], 8 => [4, 8], 9 => [3, 6, 9]],
    ];

    // Lo Shu Grid: what each number stands for, its element, planet and direction, and how to read it
    const LOSHU = [
        1 => ['name' => 'Leadership', 'keywords' => 'Leadership, Confidence, Willpower, Originality', 'element' => 'Water', 'planet' => 'Sun', 'merit' => 'Individualism', 'direction' => 'North', 'present' => 'You are independent and sure of yourself. You take the first step, speak your mind and do well when you are in charge.', 'missing' => 'Self-confidence does not come by itself. You may wait for others to decide, so practise trusting your own judgement.', 'repeat' => 'Leadership is very strong in you. More than two 1s can make you self-centred or unwilling to listen.'],
        2 => ['name' => 'Cooperation', 'keywords' => 'Cooperation, Sensitivity, Harmony, Partnership', 'element' => 'Earth', 'planet' => 'Moon', 'merit' => 'Supportiveness', 'direction' => 'Southwest', 'present' => 'You are sensitive to the feelings of others and work well in a pair or a team. People find you supportive and easy to trust.', 'missing' => 'You may miss emotional signals or find close partnerships hard. Slow down and listen before you react.', 'repeat' => 'Your intuition is sharp. Too many 2s can make you over-sensitive or dependent on others.'],
        3 => ['name' => 'Expression', 'keywords' => 'Expression, Creativity, Joy, Communication', 'element' => 'Wood', 'planet' => 'Jupiter', 'merit' => 'Creativity', 'direction' => 'East', 'present' => 'You express yourself well and have a cheerful, creative mind. Words, ideas and humour come easily to you.', 'missing' => 'You may hesitate to say what you feel or doubt your creative side. Writing, reading and speaking up will build it.', 'repeat' => 'Imagination and speech are very strong. Too many 3s can make you talk more than you do.'],
        4 => ['name' => 'Discipline', 'keywords' => 'Discipline, Stability, Hard Work, Organisation', 'element' => 'Wood', 'planet' => 'Rahu', 'merit' => 'Stability', 'direction' => 'Southeast', 'present' => 'You are practical, organised and dependable. You like a plan and you build things on a solid base.', 'missing' => 'Routine and order do not come naturally. Planning your day and finishing one task at a time will help.', 'repeat' => 'You are a tireless worker. Too many 4s can make you rigid and slow to accept change.'],
        5 => ['name' => 'Freedom', 'keywords' => 'Freedom, Adaptability, Change, Adventure', 'element' => 'Earth', 'planet' => 'Mercury', 'merit' => 'Balance', 'direction' => 'Center', 'present' => 'You are adaptable and full of life. The centre of your grid is filled, which gives balance and keeps you moving towards your goals.', 'missing' => 'The centre of the grid is empty, so setting goals and staying motivated can be difficult. Fix clear targets and review them often.', 'repeat' => 'You love variety and movement. Too many 5s can make you restless and quick to take risks.'],
        6 => ['name' => 'Responsibility', 'keywords' => 'Responsibility, Love, Family, Service', 'element' => 'Metal', 'planet' => 'Venus', 'merit' => 'Service', 'direction' => 'Northwest', 'present' => 'Home and family matter a great deal to you. You are loving, responsible and happy when you can look after people.', 'missing' => 'Family ties and comforts may need extra attention. Make time for home and for the people who depend on you.', 'repeat' => 'You are deeply devoted to your family. Too many 6s can make you anxious about the people you love.'],
        7 => ['name' => 'Spirituality', 'keywords' => 'Spirituality, Wisdom, Research, Introspection', 'element' => 'Metal', 'planet' => 'Ketu', 'merit' => 'Wisdom', 'direction' => 'West', 'present' => 'You think deeply and trust your inner voice. You learn through experience and are drawn to knowledge and faith.', 'missing' => 'You may ignore your intuition or avoid looking inward. Quiet time, study and reflection will fill this gap.', 'repeat' => 'Your inner life is very strong. Too many 7s can bring lessons through loss and a wish to be alone.'],
        8 => ['name' => 'Power', 'keywords' => 'Power, Ambition, Authority, Success', 'element' => 'Earth', 'planet' => 'Saturn', 'merit' => 'Success', 'direction' => 'Northeast', 'present' => 'You are ambitious and good with money and detail. You have the patience to build wealth and position over time.', 'missing' => 'Managing money and details may not come easily. Keep written accounts and avoid careless spending.', 'repeat' => 'Your drive for success is very strong. Too many 8s can make you over-cautious or too focused on status.'],
        9 => ['name' => 'Compassion', 'keywords' => 'Compassion, Idealism, Generosity, Vision', 'element' => 'Fire', 'planet' => 'Mars', 'merit' => 'Compassion', 'direction' => 'South', 'present' => 'You are kind-hearted and idealistic. You feel for others and want your work to mean something to the world.', 'missing' => 'You may underestimate your own goals or overlook the needs of others. Aim higher and help where you can.', 'repeat' => 'Your ideals are very high. Too many 9s can make you critical when people fall short of them.'],
    ];

    const LOSHU_GRID = [[4, 9, 2], [3, 5, 7], [8, 1, 6]];

    // Lines of the grid that give a special result when all three numbers are present
    const LOSHU_PLANES = [
        ['Mental Plane', [4, 9, 2], 'A strong memory and a mind that thinks and plans well.'],
        ['Emotional Plane', [3, 5, 7], 'Emotional balance and spiritual depth.'],
        ['Practical Plane', [8, 1, 6], 'Skill with material matters and day-to-day work.'],
        ['Thought Plane', [4, 3, 8], 'The ability to turn ideas into organised plans.'],
        ['Will Plane', [9, 5, 1], 'Determination to finish what you start.'],
        ['Action Plane', [2, 7, 6], 'The energy to act and get things done.'],
        ['Golden Yog', [4, 5, 6], 'A fortunate line linked with recognition and success.'],
        ['Silver Yog', [2, 5, 8], 'A fortunate line linked with property and steady wealth.'],
    ];

    const FLAMES = [
        'F' => ['title' => 'Friends', 'emoji' => '👫', 'text' => 'Your names point to an easy, trusting friendship. You are comfortable with each other, can speak openly and enjoy each other\'s company without any pressure.'],
        'L' => ['title' => 'Lovers', 'emoji' => '💕', 'text' => 'Your names point to romantic attraction. There is a natural spark between you two, and the bond can grow into a loving relationship.'],
        'A' => ['title' => 'Affection', 'emoji' => '🤗', 'text' => 'Your names point to warmth and care. You have a soft corner for each other and look out for one another, whether or not it turns into romance.'],
        'M' => ['title' => 'Marriage', 'emoji' => '💒', 'text' => 'Your names point to a bond that could last a lifetime. You have the understanding and commitment that a long partnership needs.'],
        'E' => ['title' => 'Enemies', 'emoji' => '⚡', 'text' => 'Your names point to frequent clashes. You see things differently and may argue often, so patience and respect will be needed to get along.'],
        'S' => ['title' => 'Siblings', 'emoji' => '👨‍👩‍👧‍👦', 'text' => 'Your names point to a protective, family-like bond. You care for each other the way a brother and sister do, with teasing and loyalty in equal measure.'],
    ];

    // How a number sits with another: 'friendly', 'neutral' or 'avoid'
    public static function relation(int $own, int $other): string
    {
        if (in_array($other, self::FRIENDLY[$own] ?? [])) return 'friendly';

        return in_array($other, self::AVOID[$own] ?? []) ? 'avoid' : 'neutral';
    }

    private static function lettersOf(string $name): array
    {
        $letters = preg_replace('/[^a-z]/', '', strtolower($name));

        return $letters === '' ? [] : str_split($letters);
    }

    /**
     * FLAMES: strike out the common letters, count what is left and count along F-L-A-M-E-S.
     * Returns null when a name has no letters or nothing is left to count.
     */
    public static function flames(string $name1, string $name2): ?array
    {
        $first = self::lettersOf($name1);
        $second = self::lettersOf($name2);
        if (!$first || !$second) return null;

        $struck = [];
        $left = [];
        foreach ($first as $char) {
            $pos = array_search($char, $second, true);
            if ($pos === false) {
                $left[] = $char;
            } else {
                unset($second[$pos]);
                $struck[] = $char;
            }
        }

        $count = count($left) + count($second);
        if ($count === 0) return null;

        $letters = array_keys(self::FLAMES);
        $rounds = [];
        $i = 0;
        while (count($letters) > 1) {
            $i = ($i + $count - 1) % count($letters);
            $out = array_splice($letters, $i, 1)[0];
            $rounds[] = ['out' => $out, 'left' => implode(' ', $letters)];
        }

        return [
            'struck' => strtoupper(implode(', ', $struck)),
            'left1'  => strtoupper(implode(' ', $left)),
            'left2'  => strtoupper(implode(' ', $second)),
            'count'  => $count,
            'rounds' => $rounds,
            'letter' => $letters[0],
            'result' => self::FLAMES[$letters[0]],
        ];
    }

    /**
     * Match of two names from their Chaldean name numbers: 100 when the numbers are equal,
     * 10 less for every step they are apart, and never below 40.
     * $label picks the band name: 0 for friendship, 1 for name compatibility.
     */
    private static function nameMatch(string $name1, string $name2, int $label): ?array
    {
        $a = self::report($name1, 'chaldean');
        $b = self::report($name2, 'chaldean');
        if (!$a || !$b) return null;

        $gap = abs($a['destiny'] - $b['destiny']);
        $percent = max(100 - 10 * $gap, 40);
        $band = self::MATCH_BANDS[$percent];

        return [
            'percent' => $percent,
            'band'    => ['title' => $band[$label], 'text' => $band[2]],
            'gap'     => $gap,
            'first'   => $a,
            'second'  => $b,
            'common'  => strtoupper(implode(', ', array_intersect(array_unique(self::lettersOf($name1)), array_unique(self::lettersOf($name2))))),
        ];
    }

    public static function friendship(string $name1, string $name2): ?array
    {
        return self::nameMatch($name1, $name2, 0);
    }

    public static function nameCompatibility(string $name1, string $name2): ?array
    {
        return self::nameMatch($name1, $name2, 1);
    }

    /**
     * Destiny number (Bhagyank) report, with the Mulank and the name number beside it.
     */
    public static function destiny(string $name, int $day, int $month, int $year): array
    {
        $base = self::mulank($day, $month, $year);
        $namank = self::report($name, 'chaldean')['destiny'];

        return $base + [
            'namank'       => $namank,
            'nameRelation' => self::RELATION_LABELS[self::relation($base['bhagyank'], $namank)],
            'destiny'      => self::DESTINY_TRAITS[$base['bhagyank']],
            'luck'         => self::DETAILS[$base['bhagyank']],
            'friendly'     => implode(', ', self::FRIENDLY[$base['bhagyank']]),
            'avoid'        => implode(', ', self::AVOID[$base['bhagyank']]),
        ];
    }

    /**
     * Lo Shu Grid: the digits of the date of birth (zero is not placed), plus the Mulank and the Bhagyank.
     */
    public static function loShu(int $day, int $month, int $year): array
    {
        $base = self::mulank($day, $month, $year);
        $birthDigits = array_values(array_filter(str_split($day . $month . $year)));
        $counts = array_count_values(array_merge($birthDigits, [$base['mulank'], $base['bhagyank']])) + array_fill(1, 9, 0);

        $planes = [];
        foreach (self::LOSHU_PLANES as [$name, $line, $text]) {
            if (!array_filter($line, fn ($n) => $counts[$n] === 0)) {
                $planes[] = ['name' => $name, 'numbers' => implode(' - ', $line), 'text' => $text];
            }
        }

        $numbers = [];
        for ($n = 1; $n <= 9; $n++) {
            $numbers[$n] = self::LOSHU[$n] + [
                'count' => $counts[$n],
                'text'  => $counts[$n] === 0 ? self::LOSHU[$n]['missing'] : self::LOSHU[$n]['present'] . ($counts[$n] > 2 ? ' ' . self::LOSHU[$n]['repeat'] : ''),
            ];
        }

        return [
            'digits'   => implode(', ', $birthDigits),
            'numbers'  => $numbers,
            'present'  => array_filter($numbers, fn ($n) => $n['count'] > 0),
            'missing'  => array_filter($numbers, fn ($n) => $n['count'] === 0),
            'planes'   => $planes,
            'mulank'   => $base['mulank'],
            'bhagyank' => $base['bhagyank'],
        ];
    }

    /**
     * Mobile number numerology: the total of all digits against the destiny number (Bhagyank).
     */
    public static function mobile(string $mobile, int $day, int $month, int $year): array
    {
        $base = self::mulank($day, $month, $year);
        $digits = str_split($mobile);
        $number = self::reduce(array_sum($digits));
        $destiny = $base['bhagyank'];
        $compatible = in_array($number, self::MOBILE_COMPATIBLE[$destiny]);

        $counts = array_count_values($digits);
        arsort($counts);
        $top = max($counts);

        return [
            'total'        => array_sum($digits),
            'steps'        => self::reduceSteps($mobile),
            'number'       => $number,
            'planet'       => self::DETAILS[$number]['planet'],
            'vibe'         => self::VIBES[$number],
            'mulank'       => $base['mulank'],
            'destiny'      => $destiny,
            'destinySteps' => $base['bhagyankSteps'],
            'compatible'   => $compatible,
            'message'      => $compatible
                ? 'This mobile number is in harmony with your ' . self::NATURE[$destiny] . ' nature. Its total, ' . $number . ', agrees with your destiny number ' . $destiny . ', so it is said to support your communication, work and relationships.'
                : 'This mobile number does not sit easily with your ' . self::NATURE[$destiny] . ' nature. Its total, ' . $number . ', is not among the numbers that agree with your destiny number ' . $destiny . ', so it is said to bring small, repeated obstacles.',
            'lucky'        => implode(', ', self::MOBILE_COMPATIBLE[$destiny]),
            'unlucky'      => implode(', ', array_diff(range(1, 9), self::MOBILE_COMPATIBLE[$destiny])),
            // digits seen most often, when one repeats at all
            'mostUsed'     => $top > 1 ? implode(', ', array_keys($counts, $top)) : null,
            'mostCount'    => $top,
            'missing'      => implode(', ', array_diff(range(1, 9), array_map('intval', $digits))),
            'lastFour'     => substr($mobile, -4),
            'lastNumber'   => self::reduce(array_sum(str_split(substr($mobile, -4)))),
        ];
    }

    /**
     * Vehicle number numerology: the last four digits of the registration number against the destiny number.
     * Returns null when the number has no digit above zero.
     */
    public static function vehicle(string $vehicle, int $day, int $month, int $year): ?array
    {
        $plate = strtoupper(preg_replace('/[^a-z0-9]/i', '', $vehicle));

        // The registration number itself: the last run of digits (1234 in DL3CAB1234), not the RTO code
        preg_match('/(\d+)\D*$/', $plate, $match);
        $digits = substr($match[1] ?? '', -4);
        if ((int) $digits === 0) return null;

        $base = self::mulank($day, $month, $year);
        $destiny = $base['bhagyank'];
        $number = self::reduce(array_sum(str_split($digits)));

        if (in_array($number, self::VEHICLE_FRIENDLY[$destiny])) {
            $level = 'full';
            $status = 'Fully Compatible';
            $message = 'An excellent choice. Vehicle number ' . $number . ' is a friend of your destiny number ' . $destiny . ', so this vehicle is said to bring smooth journeys, good fortune and steady progress.';
        } elseif (in_array($number, self::VEHICLE_NEUTRAL[$destiny])) {
            $level = 'ok';
            $status = 'Compatible';
            $message = 'A good choice. Vehicle number ' . $number . ' gets along with your destiny number ' . $destiny . '. It is not your luckiest number, but it is said to give stability and steady, trouble-free use.';
        } else {
            $level = 'no';
            $status = 'Not Compatible';
            $message = 'This is not the best number for you. Vehicle number ' . $number . ' does not agree with your destiny number ' . $destiny . ', so it is said to bring more repairs and small troubles on the road. Drive with care and keep the vehicle well maintained.';
        }

        return [
            'plate'        => $plate,
            'digits'       => $digits,
            'steps'        => self::reduceSteps($digits),
            'number'       => $number,
            'planet'       => self::DETAILS[$number]['planet'],
            'vibe'         => self::VIBES[$number],
            'mulank'       => $base['mulank'],
            'destiny'      => $destiny,
            'destinySteps' => $base['bhagyankSteps'],
            'level'        => $level,
            'status'       => $status,
            'message'      => $message,
            'friendly'     => implode(', ', self::VEHICLE_FRIENDLY[$destiny]),
            'neutral'      => implode(', ', self::VEHICLE_NEUTRAL[$destiny]),
            'colours'      => self::DETAILS[$destiny]['colours'],
            'days'         => self::DETAILS[$destiny]['days'],
        ];
    }

    /**
     * How well a name fits the date of birth, out of 100: the name number against the life path and
     * radical numbers (40), the heart's desire (30), the personality number (20) and the two birth numbers (10).
     */
    private static function luckyScore(array $n, string $system): int
    {
        $map = self::LUCKY_COMPATIBLE[$system];
        $suits = fn (int $a, int $b) => in_array($b, $map[$a] ?? []);
        $near = fn (int $a, int $b) => abs($a - $b) === 1;

        // [first check, second check, points for both, for one, for a near miss]
        $parts = [
            [[$n['lifePath'], $n['destiny']], [$n['radical'], $n['destiny']], 40, 30, 15],
            [[$n['lifePath'], $n['heart']], [$n['destiny'], $n['heart']], 30, 20, 12],
            [[$n['heart'], $n['personality']], [$n['destiny'], $n['personality']], 20, 15, 8],
        ];

        $score = 0;
        foreach ($parts as [$one, $two, $both, $single, $close]) {
            $a = $suits(...$one);
            $b = $suits(...$two);
            $score += $a && $b ? $both : ($a || $b ? $single : ($near(...$one) || $near(...$two) ? $close : 0));
        }
        $score += $suits($n['lifePath'], $n['radical']) ? 10 : ($near($n['lifePath'], $n['radical']) ? 5 : 0);

        return min($score, 100);
    }

    /**
     * Lucky name check: the numbers of the name against the numbers of the date of birth.
     * Returns null when the name has no A-Z letters.
     */
    public static function luckyName(string $name, string $system, int $day, int $month, int $year): ?array
    {
        $system = isset(self::LUCKY_COMPATIBLE[$system]) ? $system : 'chaldean';
        $report = self::report($name, $system);
        if (!$report) return null;

        $base = self::mulank($day, $month, $year);
        $numbers = [
            'lifePath'    => $base['bhagyank'],
            'radical'     => $base['mulank'],
            'personality' => $report['personality'],
            'destiny'     => $report['destiny'],
            'heart'       => $report['soulUrge'],
        ];
        $percent = self::luckyScore($numbers, $system);

        if ($percent >= 85) {
            $title = 'Highly Compatible';
        } elseif ($percent >= 70) {
            $title = 'Compatible';
        } elseif ($percent >= 50) {
            $title = 'Moderately Compatible';
        } elseif ($percent >= 30) {
            $title = 'Weak Compatibility';
        } else {
            $title = 'Not Compatible';
        }

        if ($percent >= 90) {
            $message = 'Your name is in full agreement with your life path, your heart and your personality in the ' . $report['systemLabel'] . ' system. It is a lucky name for you and needs no change.';
        } elseif ($percent >= 75) {
            $message = 'Your name supports your date of birth on most points in the ' . $report['systemLabel'] . ' system. A small change in spelling could make it perfect, but it is already favourable.';
        } elseif ($percent >= 60) {
            $message = 'Your name number agrees fairly well with your date of birth, but it pulls a little against your inner wishes or your outer personality. A better spelling could bring them together.';
        } elseif ($percent >= 40) {
            $message = 'Your name agrees with your date of birth on some points only. The main numbers are not working together, so results in important areas of life can be mixed.';
        } else {
            $message = 'Your name does not agree with your date of birth in the ' . $report['systemLabel'] . ' system. A name correction is traditionally advised for better balance.';
        }

        $map = self::LUCKY_COMPATIBLE[$system];
        $suited = array_unique(array_merge($map[$numbers['lifePath']], $map[$numbers['radical']]));
        sort($suited);

        return $report + [
            'numbers' => $numbers,
            'percent' => $percent,
            'good'    => $percent >= 70,
            'title'   => $title,
            'message' => $message,
            'suited'  => implode(', ', $suited),
        ];
    }
}
