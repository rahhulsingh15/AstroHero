<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

/**
 * Rising sign (Lagna) worked out astronomically from the birth moment and place,
 * in the sidereal zodiac (Lahiri ayanamsa) like the rest of the site.
 */
class AscendantHelper
{
    const HINDI = ['Mesh', 'Vrishabh', 'Mithun', 'Kark', 'Simha', 'Kanya', 'Tula', 'Vrishchik', 'Dhanu', 'Makar', 'Kumbh', 'Meen'];
    const SYMBOLS = ['♈', '♉', '♊', '♋', '♌', '♍', '♎', '♏', '♐', '♑', '♒', '♓'];
    const LORDS = ['Mars', 'Venus', 'Mercury', 'Moon', 'Sun', 'Mercury', 'Venus', 'Mars', 'Jupiter', 'Saturn', 'Saturn', 'Jupiter'];
    const ELEMENTS = ['Fire', 'Earth', 'Air', 'Water'];
    const QUALITIES = ['Movable (Chara)', 'Fixed (Sthira)', 'Dual (Dwiswabhava)'];

    // General reading for each rising sign: about, personality, physical, health, career, karma
    const READINGS = [
        'Aries' => [
            'about' => 'With Aries rising, Mars is the lord of your chart. You meet life head-on: quick to start, quick to decide and uncomfortable standing still. People see you as direct, energetic and brave, someone who would rather try and fail than wait and wonder.',
            'personality' => ['Bold, competitive and quick to take the lead.', 'Honest and direct, sometimes blunt.', 'Impatient with delays and slow progress.', 'Recovers fast from setbacks and starts again.'],
            'physical' => ['Athletic or wiry build with quick movements.', 'Sharp, alert eyes and a prominent forehead or brow.', 'A brisk walk and an energetic presence.', 'May carry a scar or mark on the head or face.'],
            'health' => ['The head is the sensitive area: headaches, fevers and minor injuries.', 'Tends to run hot, so inflammation and acidity are common.', 'Rushing causes cuts, burns and accidents.', 'Regular exercise is the best outlet for excess energy.'],
            'career' => 'You do best where you can act independently and see fast results. Defence, police, sports, surgery, engineering, sales, start-ups and any role that needs courage and initiative suit you. Routine desk work with no challenge drains you quickly.',
            'karma' => 'Your path is about learning to lead without pushing others aside. Patience, finishing what you begin and thinking before reacting are your main lessons. When your courage is used to protect rather than to win, it becomes your greatest gift.',
        ],
        'Taurus' => [
            'about' => 'With Taurus rising, Venus is the lord of your chart. You move through life at a steady pace and value comfort, beauty and security. People see you as calm, reliable and pleasant, someone who builds slowly and keeps what they build.',
            'personality' => ['Patient, loyal and dependable.', 'Loves good food, music and beautiful surroundings.', 'Slow to anger but stubborn once decided.', 'Dislikes sudden change and prefers routine.'],
            'physical' => ['Sturdy, well-built body with a strong neck and shoulders.', 'Attractive face with large, gentle eyes.', 'A pleasant, soothing voice.', 'Tends to gain weight easily.'],
            'health' => ['The throat, neck and thyroid are the sensitive areas.', 'Prone to tonsil trouble, colds and stiff shoulders.', 'A love of rich food can lead to weight gain.', 'Steady exercise and a simple diet keep you well.'],
            'career' => 'You do well in fields that offer stability and deal with money, beauty or the land. Banking, finance, real estate, farming, food, fashion, music, design and luxury goods suit you. You prefer a secure position with steady growth over risky ventures.',
            'karma' => 'Your path is about learning the difference between security and attachment. Letting go, accepting change and sharing what you have are your main lessons. Your steadiness becomes a blessing when it gives others something solid to lean on.',
        ],
        'Gemini' => [
            'about' => 'With Gemini rising, Mercury is the lord of your chart. You approach the world through your mind: curious, talkative and always collecting information. People see you as witty, youthful and adaptable, someone who can talk to anyone about anything.',
            'personality' => ['Quick-witted, curious and a natural communicator.', 'Enjoys variety and handles many things at once.', 'Restless and easily bored.', 'Can be indecisive or change opinions quickly.'],
            'physical' => ['Tall or slim build with long arms and fingers.', 'Bright, lively eyes and expressive hands.', 'A youthful look that lasts with age.', 'Quick, nimble movements and fast speech.'],
            'health' => ['The shoulders, arms, hands and lungs are the sensitive areas.', 'Prone to coughs, breathing trouble and nervous tension.', 'An overactive mind can disturb sleep.', 'Breathing exercises and regular rest calm the nerves.'],
            'career' => 'You do best in work that uses words, ideas and contact with people. Writing, journalism, teaching, media, marketing, sales, trading, IT and accounting suit you. You need variety and mental stimulation more than a fixed routine.',
            'karma' => 'Your path is about turning knowledge into depth. Focus, commitment and following one thing through to the end are your main lessons. When you slow down enough to truly understand, your words gain the power to guide others.',
        ],
        'Cancer' => [
            'about' => 'With Cancer rising, the Moon is the lord of your chart. You experience life through feeling, and your moods rise and fall like the tides. People see you as caring, gentle and protective, someone for whom home and family come first.',
            'personality' => ['Nurturing, sensitive and deeply attached to family.', 'Strong intuition and an excellent memory.', 'Moody and easily hurt, though slow to show it.', 'Protective and careful with money.'],
            'physical' => ['Round, soft face with expressive eyes.', 'Medium height, often fuller in the upper body.', 'A gentle, approachable look.', 'Appearance can change noticeably with mood.'],
            'health' => ['The chest and stomach are the sensitive areas.', 'Worry goes straight to the digestion.', 'Prone to acidity, water retention and colds.', 'Emotional calm and regular meals are the best medicine.'],
            'career' => 'You do well wherever you can care for or provide for others. Nursing, medicine, teaching, hospitality, food, real estate, social work, counselling and family business suit you. You work best in a setting that feels safe and familiar.',
            'karma' => 'Your path is about caring without clinging. Building inner security, releasing old hurts and letting loved ones grow are your main lessons. When your feelings are steady, your care becomes a refuge for many people.',
        ],
        'Leo' => [
            'about' => 'With Leo rising, the Sun is the lord of your chart. You carry yourself with natural dignity and are happiest when you can shine. People see you as confident, warm and generous, someone born to lead and to be noticed.',
            'personality' => ['Confident, proud and generous.', 'A natural leader who loves appreciation.', 'Loyal and protective of loved ones.', 'Can be stubborn or dominating when ego is hurt.'],
            'physical' => ['Broad shoulders and an upright, commanding posture.', 'Strong bone structure and a dignified face.', 'Thick or striking hair.', 'A confident walk that draws attention.'],
            'health' => ['The heart, spine and upper back are the sensitive areas.', 'Prone to blood pressure and back trouble.', 'Tends to overwork and ignore the need for rest.', 'Regular cardio and time in morning sunlight help.'],
            'career' => 'You do best in positions of authority and visibility. Government, administration, politics, management, entertainment, the arts and running your own business suit you. You struggle in roles where you are overlooked or tightly controlled.',
            'karma' => 'Your path is about leading from the heart rather than from pride. Humility, sharing credit and listening are your main lessons. When your light is used to lift others up, people follow you gladly.',
        ],
        'Virgo' => [
            'about' => 'With Virgo rising, Mercury is the lord of your chart. You approach life with a careful, analytical eye and a wish to be useful. People see you as modest, intelligent and practical, someone who notices what everyone else has missed.',
            'personality' => ['Analytical, organised and detail-minded.', 'Helpful, modest and hard-working.', 'A perfectionist who can be critical of self and others.', 'Tends to worry about small things.'],
            'physical' => ['Slim, neat appearance with fine features.', 'A youthful face and clear, observant eyes.', 'Soft-spoken and tidy in dress.', 'A quick, light walk.'],
            'health' => ['The intestines and digestive system are the sensitive areas.', 'Nervous tension shows up as stomach trouble.', 'Prone to food sensitivities and skin issues.', 'A clean, regular diet and less worry bring quick relief.'],
            'career' => 'You do well in work that needs precision and service. Accounting, auditing, research, medicine, pharmacy, editing, data analysis, quality control and teaching suit you. You are often the person who quietly keeps everything running.',
            'karma' => 'Your path is about accepting imperfection, in yourself first. Trust, self-kindness and seeing the whole picture are your main lessons. When you serve without judging, your skill truly heals.',
        ],
        'Libra' => [
            'about' => 'With Libra rising, Venus is the lord of your chart. You look for balance, fairness and harmony in everything, especially in relationships. People see you as charming, graceful and diplomatic, someone who makes others feel at ease.',
            'personality' => ['Charming, fair-minded and sociable.', 'A natural peacemaker with refined taste.', 'Indecisive, weighing every side of a question.', 'Avoids conflict and dislikes being alone.'],
            'physical' => ['Well-proportioned body and attractive features.', 'A pleasant smile, often with dimples.', 'Graceful movements and good dress sense.', 'A clear, glowing complexion.'],
            'health' => ['The kidneys, lower back and skin are the sensitive areas.', 'Prone to lower back pain and urinary trouble.', 'Fondness for sweets can upset the balance.', 'Plenty of water and a regular routine keep you well.'],
            'career' => 'You do best in work that involves people, fairness or beauty. Law, diplomacy, public relations, human resources, fashion, design, the arts, counselling and business partnerships suit you. You work better with a partner than alone.',
            'karma' => 'Your path is about finding balance inside rather than through other people. Making decisions, saying no and standing by your own view are your main lessons. When you are at peace with yourself, you bring real harmony to others.',
        ],
        'Scorpio' => [
            'about' => 'With Scorpio rising, Mars is the lord of your chart. You experience life intensely and look beneath the surface of everything. People see you as magnetic, private and strong-willed, someone who is hard to read and impossible to fool.',
            'personality' => ['Intense, determined and deeply private.', 'Sharp intuition that senses hidden motives.', 'Fiercely loyal, but does not forget betrayal.', 'Can be secretive, possessive or suspicious.'],
            'physical' => ['Penetrating eyes and a strong, steady gaze.', 'Well-built body with a broad face.', 'A serious, magnetic presence.', 'Thick eyebrows and sharp features.'],
            'health' => ['The reproductive and excretory organs are the sensitive areas.', 'Prone to infections, piles and hormonal imbalance.', 'Suppressed emotion affects the body.', 'Has strong powers of recovery after illness.'],
            'career' => 'You do well in work that needs depth, secrecy or courage. Research, investigation, surgery, medicine, psychology, defence, mining, insurance, occult sciences and crisis management suit you. You are at your best when the stakes are high.',
            'karma' => 'Your path is one of transformation. Letting go of control, forgiving and trusting are your main lessons. Each time you release an old hurt you are reborn stronger, and your depth becomes a source of healing for others.',
        ],
        'Sagittarius' => [
            'about' => 'With Sagittarius rising, Jupiter is the lord of your chart. You approach life as a journey of learning and look for meaning in everything. People see you as cheerful, frank and principled, someone who loves freedom and speaks the truth.',
            'personality' => ['Optimistic, honest and freedom-loving.', 'Drawn to travel, philosophy and higher learning.', 'Generous and principled.', 'Blunt in speech and restless when tied down.'],
            'physical' => ['Tall, well-built frame with strong thighs.', 'A broad forehead and an open, smiling face.', 'A long, confident stride.', 'Tends to put on weight in later years.'],
            'health' => ['The hips, thighs and liver are the sensitive areas.', 'Prone to sciatica and weight gain.', 'Overindulgence strains the liver.', 'Outdoor activity and moderation keep you fit.'],
            'career' => 'You do best in work that involves knowledge, guidance or travel. Teaching, law, religion, publishing, advisory roles, foreign trade, tourism and sports suit you. You need freedom and a sense of purpose in what you do.',
            'karma' => 'Your path is about living the wisdom you speak. Commitment, tact and attention to detail are your main lessons. When your knowledge is joined with humility, you become a true guide for others.',
        ],
        'Capricorn' => [
            'about' => 'With Capricorn rising, Saturn is the lord of your chart. You take life seriously and climb towards your goals step by step. People see you as disciplined, responsible and mature, someone who earns success through patience and hard work.',
            'personality' => ['Ambitious, disciplined and practical.', 'Patient, with success coming through steady effort.', 'Reserved and cautious, slow to trust.', 'Can be pessimistic or too focused on work.'],
            'physical' => ['Lean, bony frame with prominent knees or cheekbones.', 'A serious, mature expression.', 'Looks older when young and younger with age.', 'A measured, careful way of walking.'],
            'health' => ['The knees, bones, joints and skin are the sensitive areas.', 'Prone to joint pain, stiffness and dry skin.', 'Overwork leads to fatigue and low mood.', 'Stretching, warmth and time off protect your health.'],
            'career' => 'You do well in structured fields with a clear ladder to climb. Administration, government, management, engineering, construction, mining, agriculture and law suit you. Your rise is slow but lasting, and often strongest later in life.',
            'karma' => 'Your path is about balancing duty with joy. Trusting others, expressing feelings and resting without guilt are your main lessons. When your discipline serves people and not only goals, your achievements gain real meaning.',
        ],
        'Aquarius' => [
            'about' => 'With Aquarius rising, Saturn is the lord of your chart. You think for yourself and care about ideas that help many people. People see you as friendly but detached, original and principled, someone who does not follow the crowd.',
            'personality' => ['Independent, original and forward-thinking.', 'Humanitarian, with a wide circle of friends.', 'Emotionally detached and hard to know closely.', 'Stubborn about opinions and principles.'],
            'physical' => ['Tall build with a well-formed, thoughtful face.', 'Clear, far-away eyes.', 'A distinctive or unconventional style.', 'Strong calves and ankles.'],
            'health' => ['The calves, ankles and circulation are the sensitive areas.', 'Prone to cramps, varicose veins and nervous strain.', 'Irregular routines disturb sleep.', 'Walking and a fixed daily schedule help greatly.'],
            'career' => 'You do best in work that involves ideas, technology or service to society. Science, IT, engineering, research, aviation, astrology, social work, NGOs and large organisations suit you. You need room to think and to do things your own way.',
            'karma' => 'Your path is about joining the head with the heart. Emotional closeness, flexibility and valuing the individual as well as the group are your main lessons. When your ideas are warmed by feeling, they can truly change lives.',
        ],
        'Pisces' => [
            'about' => 'With Pisces rising, Jupiter is the lord of your chart. You approach the world through feeling, imagination and faith. People see you as gentle, kind and dreamy, someone with a soft, spiritual quality who easily senses what others feel.',
            'personality' => ['Compassionate, intuitive and imaginative.', 'Spiritual by nature and quick to forgive.', 'Sensitive to surroundings and to other people\'s moods.', 'Can be dreamy, indecisive or avoid hard realities.'],
            'physical' => ['Soft, rounded features and a gentle manner.', 'Large, dreamy and expressive eyes.', 'Medium height with a fleshy build.', 'Small or delicate feet.'],
            'health' => ['The feet and lymphatic system are the sensitive areas.', 'Low resistance, so rest is essential.', 'Absorbs the stress of others easily.', 'Meditation, time near water and regular sleep restore you.'],
            'career' => 'You do well in work that heals, inspires or serves. Medicine, nursing, counselling, spirituality, teaching, music, film, the arts, charity work and anything connected with water or foreign lands suit you. Harsh, competitive settings wear you down.',
            'karma' => 'Your path is about bringing compassion into the real world without losing yourself. Boundaries, practicality and facing things directly are your main lessons. When your faith is grounded, your kindness uplifts everyone around you.',
        ],
    ];

    private static function rev(float $x): float
    {
        $x = fmod($x, 360);
        return $x < 0 ? $x + 360 : $x;
    }

    /**
     * Tropical ascendant in degrees: the point of the ecliptic rising on the
     * eastern horizon at this moment (UT) for this latitude and longitude.
     */
    public static function tropicalAscendant(Carbon $moment, float $lat, float $lng): float
    {
        $jd = $moment->getTimestamp() / 86400 + 2440587.5;
        $d = $jd - 2451545.0;
        $t = $d / 36525;

        // Greenwich mean sidereal time, then local sidereal time (= RAMC)
        $gmst = 280.46061837 + 360.98564736629 * $d + 0.000387933 * $t * $t;
        $ramc = deg2rad(self::rev($gmst + $lng));

        $obliquity = deg2rad(23.439291 - 0.0130042 * $t);
        $latitude = deg2rad($lat);

        $asc = atan2(cos($ramc), -(sin($ramc) * cos($obliquity) + tan($latitude) * sin($obliquity)));

        return self::rev(rad2deg($asc));
    }

    /**
     * Full Lagna report for a birth moment and place.
     */
    public static function report(Carbon $birth, float $lat, float $lng): array
    {
        $sidereal = self::rev(self::tropicalAscendant($birth, $lat, $lng) - TransitHelper::ayanamsa($birth));

        $index = (int) floor($sidereal / 30);
        $inSign = fmod($sidereal, 30);
        $sign = TransitHelper::SIGNS[$index];

        $nakSpan = 360 / 27;
        $nakIndex = (int) floor($sidereal / $nakSpan);

        $planets = TransitHelper::siderealAt($birth);

        return [
            'sign'       => $sign,
            'hindi'      => self::HINDI[$index],
            'symbol'     => self::SYMBOLS[$index],
            'degree'     => (int) floor($inSign),
            'minute'     => (int) floor(($inSign - floor($inSign)) * 60),
            'lord'       => self::LORDS[$index],
            'element'    => self::ELEMENTS[$index % 4],
            'quality'    => self::QUALITIES[$index % 3],
            'nakshatra'  => TransitHelper::NAKSHATRAS[$nakIndex],
            'pada'       => (int) floor(fmod($sidereal, $nakSpan) / ($nakSpan / 4)) + 1,
            'moonSign'   => TransitHelper::SIGNS[(int) floor($planets['Moon'] / 30)],
            'sunSign'    => TransitHelper::SIGNS[(int) floor($planets['Sun'] / 30)],
            // close to a sign boundary, where a few minutes' error in the birth time changes the sign
            'nearCusp'   => $inSign < 1.5 || $inSign > 28.5,
            'reading'    => self::READINGS[$sign],
        ];
    }

    /**
     * Places matching a name, with coordinates and timezone (Open-Meteo geocoding).
     * [['label' => 'Lucknow, Uttar Pradesh, India', 'lat' => 26.84, 'lng' => 80.92, 'tz' => 'Asia/Kolkata'], ...]
     */
    public static function searchPlaces(string $query, int $limit = 6): array
    {
        $query = trim($query);
        if (mb_strlen($query) < 2) return [];

        // "New Delhi, Delhi, India" -> search by the city part
        $city = trim(explode(',', $query)[0]);

        try {
            $res = Http::withoutVerifying()->timeout(8)->get('https://geocoding-api.open-meteo.com/v1/search', [
                'name' => $city, 'count' => $limit, 'language' => 'en', 'format' => 'json',
            ]);
        } catch (\Exception $e) {
            return [];
        }

        $places = [];
        foreach ($res->json('results') ?? [] as $r) {
            if (empty($r['timezone'])) continue;

            $places[] = [
                'label' => implode(', ', array_unique(array_filter([$r['name'], $r['admin1'] ?? null, $r['country'] ?? null]))),
                'lat'   => round($r['latitude'], 4),
                'lng'   => round($r['longitude'], 4),
                'tz'    => $r['timezone'],
            ];
        }

        return $places;
    }
}
