<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Vimshottari Dasha worked out from the Moon's real sidereal position (Lahiri)
 * at the birth moment, like the rest of the site.
 */
class DashaHelper
{
    // Dasha lords in Vimshottari order with their years (total 120)
    const PLANET_YEARS = [
        'Ketu'    => 7,
        'Venus'   => 20,
        'Sun'     => 6,
        'Moon'    => 10,
        'Mars'    => 7,
        'Rahu'    => 18,
        'Jupiter' => 16,
        'Saturn'  => 19,
        'Mercury' => 17,
    ];

    const HINDI = [
        'Ketu' => 'South Node', 'Venus' => 'Shukra', 'Sun' => 'Surya', 'Moon' => 'Chandra', 'Mars' => 'Mangal',
        'Rahu' => 'North Node', 'Jupiter' => 'Guru', 'Saturn' => 'Shani', 'Mercury' => 'Budh',
    ];

    const SYMBOLS = [
        'Ketu' => '☋', 'Venus' => '♀', 'Sun' => '☉', 'Moon' => '☽', 'Mars' => '♂',
        'Rahu' => '☊', 'Jupiter' => '♃', 'Saturn' => '♄', 'Mercury' => '☿',
    ];

    const YEAR_SECONDS = 365.25 * 86400;

    // General reading for each Mahadasha lord
    const PROFILES = [
        'Ketu' => [
            'ruling'     => 'Ketu is the South Node of the Moon, a shadow planet of detachment, past-life karma and liberation. It cuts away what is no longer needed so that you can turn inward.',
            'career'     => 'Work may feel unsettled, with sudden changes of role or direction. Research, healing, spiritual work, coding and anything that needs deep focus do well. Avoid big speculative risks.',
            'relations'  => 'You may feel distant even from people you love, and some ties end on their own. Honest communication keeps the relationships that truly matter.',
            'health'     => 'Watch for unexplained aches, nerve and skin problems, infections and accidents caused by carelessness. Regular routine and grounding practices help.',
            'spirit'     => 'This is one of the strongest periods for meditation, pilgrimage and inner growth. Worldly things lose their pull and deeper questions take over.',
            'challenges' => 'Confusion, isolation, sudden losses and a feeling of having no direction. Do not take major decisions out of restlessness.',
            'education'  => 'Favours research, occult subjects, mathematics, languages and technical skills. Concentration comes in bursts, so study in short focused sessions.',
            'gemstone'   => 'Cat\'s Eye (Lehsunia) in silver is the traditional stone for Ketu. Wear it only after a full chart reading by a qualified astrologer.',
            'mantra'     => 'Om Stram Strim Straum Sah Ketave Namah',
            'karma'      => 'Feed stray dogs, donate blankets and offer prayers to Lord Ganesha.',
        ],
        'Venus' => [
            'ruling'     => 'Venus (Shukra) is the planet of love, beauty, comfort and wealth. Its twenty years are the longest dasha and usually the most pleasant materially.',
            'career'     => 'Good for arts, design, fashion, media, hospitality, luxury goods and finance. Income and comforts generally rise, and partnerships bring gains.',
            'relations'  => 'Romance, marriage and family happiness are strongly highlighted. Relationships deepen, though over-indulgence can create complications.',
            'health'     => 'Take care of the kidneys, reproductive system, sugar levels and hormonal balance. Moderation in food and pleasure is the main rule.',
            'spirit'     => 'Devotion through music, art and beauty comes naturally. The lesson is to enjoy the world without becoming attached to it.',
            'challenges' => 'Laziness, overspending, vanity and distraction through pleasure. Comfort can quietly replace ambition.',
            'education'  => 'Favours fine arts, music, design, film, commerce and hospitality. Creative subjects flourish.',
            'gemstone'   => 'Diamond or White Sapphire (or Opal) in silver or platinum is the traditional stone for Venus, to be worn only after a chart reading.',
            'mantra'     => 'Om Dram Drim Draum Sah Shukraya Namah',
            'karma'      => 'Donate white clothes, rice or sweets on Fridays and respect the women in your life.',
        ],
        'Sun' => [
            'ruling'     => 'The Sun (Surya) is the king of the planets: the soul, authority, confidence and vitality. Its six years bring you into the light.',
            'career'     => 'Recognition, promotion and positions of authority become possible. Government, administration, politics, medicine and leadership roles are favoured.',
            'relations'  => 'Pride can strain close relationships, and matters connected with your father come to the fore. Warmth and humility keep bonds strong.',
            'health'     => 'Watch the heart, eyes, blood pressure, bones and body heat. Early-morning sunlight and regular sleep suit you.',
            'spirit'     => 'A time to discover who you really are and to live by your own principles. Sun worship and discipline strengthen the mind.',
            'challenges' => 'Ego clashes with seniors, stubbornness and a tendency to dominate. Authority must be earned, not demanded.',
            'education'  => 'Favours civil services, medicine, political science, management and any competitive examination.',
            'gemstone'   => 'Ruby (Manik) in gold on the ring finger is the traditional stone for the Sun, to be worn only after a chart reading.',
            'mantra'     => 'Om Hram Hrim Hraum Sah Suryaya Namah',
            'karma'      => 'Offer water to the rising Sun, donate wheat or jaggery on Sundays and respect your father.',
        ],
        'Moon' => [
            'ruling'     => 'The Moon (Chandra) rules the mind, emotions, mother and home. Its ten years make life more feeling-driven and changeable.',
            'career'     => 'Good for work connected with the public, care, food, hospitality, travel, liquids, nursing and creative fields. Income may rise and fall like the tides.',
            'relations'  => 'Bonds with mother, family and home grow stronger. You become more sensitive and caring, and also more easily hurt.',
            'health'     => 'Look after sleep, digestion, fluid balance, chest and above all mental peace. Mood swings affect the body quickly.',
            'spirit'     => 'Intuition deepens and devotion comes easily. Meditation, moonlight walks and time near water calm the mind.',
            'challenges' => 'Moodiness, over-thinking, dependence on others and frequent changes of mind or residence.',
            'education'  => 'Favours psychology, nursing, literature, arts, hotel management and marine or agricultural studies.',
            'gemstone'   => 'Pearl (Moti) in silver on the little finger is the traditional stone for the Moon, to be worn only after a chart reading.',
            'mantra'     => 'Om Shram Shrim Shraum Sah Chandraya Namah',
            'karma'      => 'Offer milk or water to Lord Shiva on Mondays, donate rice and care for your mother.',
        ],
        'Mars' => [
            'ruling'     => 'Mars (Mangal) is the commander: energy, courage, action and drive. Its seven years are fast, competitive and decisive.',
            'career'     => 'Good for engineering, defence, police, surgery, sports, real estate and any field that needs initiative. Property gains are possible.',
            'relations'  => 'Passion runs high and so does temper. Relations with brothers and sisters become important. Patience prevents needless quarrels.',
            'health'     => 'Watch for injuries, cuts, burns, fevers, blood pressure and blood-related issues. Channel energy through regular exercise.',
            'spirit'     => 'Discipline, self-control and service turn raw force into strength. Worship of Lord Hanuman steadies the mind.',
            'challenges' => 'Anger, impatience, accidents, disputes and hasty decisions, especially about property and money.',
            'education'  => 'Favours engineering, the military, sports, surgery, mechanics and technical trades.',
            'gemstone'   => 'Red Coral (Moonga) in gold or copper on the ring finger is the traditional stone for Mars, to be worn only after a chart reading.',
            'mantra'     => 'Om Kram Krim Kraum Sah Bhaumaya Namah',
            'karma'      => 'Recite the Hanuman Chalisa, donate red lentils on Tuesdays and avoid arguments.',
        ],
        'Rahu' => [
            'ruling'     => 'Rahu is the North Node of the Moon, a shadow planet that governs worldly desire, obsession and sudden expansion. It pushes you out of your comfort zone into new and unfamiliar territory.',
            'career'     => 'A period of big ambition and sudden rises: foreign opportunities, technology, media and unconventional careers do well. Avoid unethical shortcuts, because Rahu can take away as suddenly as it gives.',
            'relations'  => 'Unconventional relationships and intense karmic connections are likely, often with people from a different background. Be careful of illusion and unrealistic expectations in love.',
            'health'     => 'Rahu brings hard-to-diagnose problems linked with stress, anxiety and an irregular lifestyle. A fixed daily routine and care of mental health matter most.',
            'spirit'     => 'Rahu first drives you towards material goals and then leaves you asking what lies beyond them. Interest in astrology, the occult and psychology often awakens.',
            'challenges' => 'Over-thinking, fears, addictions and chasing mirages. Stay grounded in facts and take advice before financial speculation.',
            'education'  => 'Favours foreign study, research, technology, aviation, data and biotechnology. Students must fight distraction.',
            'gemstone'   => 'Hessonite (Gomed) in silver on the middle finger is the traditional stone for Rahu, to be worn only after a chart reading.',
            'mantra'     => 'Om Bhram Bhrim Bhraum Sah Rahave Namah',
            'karma'      => 'Donate black lentils, feed street dogs and help the underprivileged.',
        ],
        'Jupiter' => [
            'ruling'     => 'Jupiter (Guru) is the teacher of the gods: wisdom, ethics, good fortune and growth. Its sixteen years generally expand whatever they touch.',
            'career'     => 'Steady growth, promotions and respect. Teaching, law, finance, banking, advisory and management roles are favoured, and wealth tends to build.',
            'relations'  => 'A supportive time for marriage, children and family harmony. Elders and mentors play a helpful role.',
            'health'     => 'Watch weight, liver, cholesterol and sugar levels. Jupiter expands the body too, so keep food and exercise balanced.',
            'spirit'     => 'Strong interest in scriptures, pilgrimage, charity and meditation. A guru or guiding philosophy may enter your life.',
            'challenges' => 'Over-confidence, complacency, over-promising and ignoring small financial details.',
            'education'  => 'Excellent for higher degrees, law, philosophy, finance, teaching and management.',
            'gemstone'   => 'Yellow Sapphire (Pukhraj) in gold on the index finger is the traditional stone for Jupiter, to be worn only after a chart reading.',
            'mantra'     => 'Om Gram Grim Graum Sah Gurave Namah',
            'karma'      => 'Donate yellow lentils or turmeric on Thursdays, respect teachers and support education.',
        ],
        'Saturn' => [
            'ruling'     => 'Saturn (Shani) is the lord of justice, discipline and time. Its nineteen years reward patient effort and expose every weak foundation.',
            'career'     => 'Progress is slow but lasting. Heavy responsibility comes, and those who work honestly build a solid, long-term position.',
            'relations'  => 'Relationships are tested for loyalty and maturity. Superficial ties fall away while committed ones grow deeper.',
            'health'     => 'Look after joints, bones, teeth, nerves and chronic complaints. Tiredness is common, so respect your limits.',
            'spirit'     => 'Saturn teaches humility, detachment and selfless service. Serving the poor and elderly brings real peace.',
            'challenges' => 'Delays, loneliness, heavy workload and the feeling that effort goes unnoticed. Results come late but they come.',
            'education'  => 'Favours engineering, law, geology, metallurgy, architecture and subjects that need long, steady study.',
            'gemstone'   => 'Blue Sapphire (Neelam) is the traditional stone for Saturn. It acts strongly, so test it and wear it only on an astrologer\'s advice.',
            'mantra'     => 'Om Pram Prim Praum Sah Shanaischaraya Namah',
            'karma'      => 'Donate black sesame or mustard oil on Saturdays and help labourers, the poor and the elderly.',
        ],
        'Mercury' => [
            'ruling'     => 'Mercury (Budh) is the prince of the planets: intellect, speech, trade and skill. Its seventeen years sharpen the mind and widen your contacts.',
            'career'     => 'Good for business, trade, accounting, writing, IT, media, teaching and consultancy. Multiple income sources are possible.',
            'relations'  => 'Friendship and conversation are the heart of your relationships now. Light-heartedness helps, but avoid being too calculating.',
            'health'     => 'Watch the nervous system, skin, speech, lungs and digestion. Mental overwork is the usual cause of trouble.',
            'spirit'     => 'Growth comes through study, discussion and mantra. Learning sacred texts and practising discrimination suit this period.',
            'challenges' => 'Restlessness, over-analysis, nervousness and scattering energy across too many plans.',
            'education'  => 'Excellent for commerce, mathematics, computer science, languages, journalism and accountancy.',
            'gemstone'   => 'Emerald (Panna) in gold on the little finger is the traditional stone for Mercury, to be worn only after a chart reading.',
            'mantra'     => 'Om Bram Brim Braum Sah Budhaya Namah',
            'karma'      => 'Donate green moong or green vegetables on Wednesdays and feed cows with green fodder.',
        ],
    ];

    // What each planet adds when it rules the sub-period (Antardasha)
    const ANTAR_NOTES = [
        'Ketu'    => 'A reflective, detached phase with sudden changes. Good for spiritual practice, not for big new commitments.',
        'Venus'   => 'Comforts, romance, travel and financial gains come forward. A creative but sometimes distracting phase.',
        'Sun'     => 'Focus shifts to authority, recognition and career position. Ego clashes with seniors are possible.',
        'Moon'    => 'An emotional, intuitive phase with changes at home. Mental peace fluctuates, so rest and meditation help.',
        'Mars'    => 'High energy, courage and property matters. Avoid impulsive decisions, rash driving and arguments.',
        'Rahu'    => 'Ambition, foreign links and unexpected turns. Opportunities are real but check facts before acting.',
        'Jupiter' => 'Guidance, learning, growth and family blessings. One of the more supportive sub-periods.',
        'Saturn'  => 'Hard work, responsibility and delays that build something lasting. Patience is essential.',
        'Mercury' => 'Business, study, communication and networking. A good time for planning, writing and deals.',
    ];

    /**
     * Full Vimshottari report for a birth moment.
     */
    public static function report(Carbon $birth): array
    {
        $moon = TransitHelper::siderealAt($birth)['Moon'];

        $span = 360 / 27; // one nakshatra = 13°20'
        $nakIndex = (int) floor($moon / $span);
        $elapsed = fmod($moon, $span) / $span; // part of the nakshatra the Moon has already crossed

        $lords = array_keys(self::PLANET_YEARS);
        $lordIndex = $nakIndex % 9;
        $firstLord = $lords[$lordIndex];

        // The first Mahadasha began before birth; only the balance is left at birth
        $birthTs = $birth->getTimestamp();
        $cursor = $birthTs - $elapsed * self::PLANET_YEARS[$firstLord] * self::YEAR_SECONDS;
        $balanceYears = (1 - $elapsed) * self::PLANET_YEARS[$firstLord];

        // The dasha running now (or at birth, for a future date)
        $nowTs = max(Carbon::now()->getTimestamp(), $birthTs);

        $mahadashas = [];
        $current = null;
        for ($i = 0; $i < 9 || !$current; $i++) {
            $planet = $lords[($lordIndex + $i) % 9];
            $end = $cursor + self::PLANET_YEARS[$planet] * self::YEAR_SECONDS;

            $row = [
                'planet'  => $planet,
                'years'   => self::PLANET_YEARS[$planet],
                'startTs' => $cursor,
                'start'   => self::date(max($cursor, $birthTs), $birth),
                'end'     => self::date($end, $birth),
                'current' => $nowTs >= $cursor && $nowTs < $end,
            ];
            if ($row['current']) $current = $row;

            $mahadashas[] = $row;
            $cursor = $end;
        }

        $antardashas = self::antardashas($current['planet'], $current['startTs'], $birth, $nowTs);
        $currentAntar = collect($antardashas)->firstWhere('current', true);

        $left = Carbon::createFromTimestamp($nowTs, $birth->timezone)->diff($current['end']);
        $inSign = fmod($moon, 30);

        return [
            'moonLongitude'  => $moon,
            'moonSign'       => TransitHelper::SIGNS[(int) floor($moon / 30)],
            'moonDegree'     => (int) floor($inSign),
            'moonMinute'     => (int) floor(($inSign - floor($inSign)) * 60),
            'nakshatra'      => TransitHelper::NAKSHATRAS[$nakIndex],
            'pada'           => (int) floor($elapsed * 4) + 1,
            'nakshatraLord'  => $firstLord,
            'balance'        => self::split($balanceYears),
            // near a nakshatra border, where a small error in the birth time changes the starting dasha
            'nearCusp'       => $elapsed < 0.02 || $elapsed > 0.98,
            'planet'         => $current['planet'],
            'hindi'          => self::HINDI[$current['planet']],
            'symbol'         => self::SYMBOLS[$current['planet']],
            'totalYears'     => $current['years'],
            'start'          => $current['start'],
            'end'            => $current['end'],
            'yearsLeft'      => $left->y,
            'monthsLeft'     => $left->m,
            'daysLeft'       => $left->d,
            'profile'        => self::PROFILES[$current['planet']],
            'antardashas'    => $antardashas,
            'currentAntar'   => $currentAntar,
            'mahadashas'     => $mahadashas,
        ];
    }

    // Nine sub-periods of a Mahadasha, starting with its own lord
    private static function antardashas(string $mahaLord, float $startTs, Carbon $birth, int $nowTs): array
    {
        $lords = array_keys(self::PLANET_YEARS);
        $startIndex = array_search($mahaLord, $lords);
        $cursor = $startTs;
        $rows = [];

        for ($i = 0; $i < 9; $i++) {
            $lord = $lords[($startIndex + $i) % 9];
            // Antardasha length = Mahadasha years x Antardasha years / 120
            $end = $cursor + self::PLANET_YEARS[$mahaLord] * self::PLANET_YEARS[$lord] / 120 * self::YEAR_SECONDS;

            $rows[] = [
                'lord'    => $lord,
                'name'    => $mahaLord . ' - ' . $lord,
                'start'   => self::date($cursor, $birth),
                'end'     => self::date($end, $birth),
                'current' => $nowTs >= $cursor && $nowTs < $end,
                'past'    => $end <= $nowTs,
                // ended before the person was born (only possible in the first Mahadasha)
                'beforeBirth' => $end <= $birth->getTimestamp(),
                'note'    => self::ANTAR_NOTES[$lord],
            ];
            $cursor = $end;
        }

        return $rows;
    }

    private static function date(float $ts, Carbon $birth): Carbon
    {
        return Carbon::createFromTimestamp((int) round($ts), $birth->timezone);
    }

    // 6.42 years -> ['years' => 6, 'months' => 5, 'days' => 1]
    private static function split(float $years): array
    {
        $y = (int) floor($years);
        $months = ($years - $y) * 12;
        $m = (int) floor($months);

        return ['years' => $y, 'months' => $m, 'days' => (int) floor(($months - $m) * 30)];
    }
}
