<?php

namespace App\Helpers;

// Do rashiyon ki compatibility: score aur text dono rashi ke element, modality, swami grah
// aur zodiac me dono ke beech ki doori se bante hain. Database ya API ki zaroorat nahi.
class CompatibilityHelper
{
    // Zodiac order me (isi order se dono rashiyon ke beech ki doori nikalti hai)
    const SIGNS = [
        'Aries' => ['element' => 'fire', 'modality' => 'cardinal', 'ruler' => 'Mars', 'dates' => 'Mar 21 – Apr 19', 'img' => 'horoscope-01.avif',
            'nature' => 'bold, direct and always ready for something new',
            'love'   => 'falls quickly, loves the chase and shows affection through action',
            'talk'   => 'says exactly what is on the mind, sometimes before thinking it through',
            'friend' => 'the one who gets everyone moving and stands up for the group',
            'need'   => 'freedom, honesty and a partner who can keep up'],
        'Taurus' => ['element' => 'earth', 'modality' => 'fixed', 'ruler' => 'Venus', 'dates' => 'Apr 20 – May 20', 'img' => 'horoscope-02.avif',
            'nature' => 'patient, loyal and fond of comfort',
            'love'   => 'takes time to commit, then loves steadily through touch, food and small daily care',
            'talk'   => 'speaks slowly and plainly and does not change position easily',
            'friend' => 'dependable, generous and around for years',
            'need'   => 'security, loyalty and a calm home'],
        'Gemini' => ['element' => 'air', 'modality' => 'mutable', 'ruler' => 'Mercury', 'dates' => 'May 21 – Jun 20', 'img' => 'horoscope-03.avif',
            'nature' => 'curious, witty and quick to change',
            'love'   => 'is won over through conversation and needs variety to stay interested',
            'talk'   => 'talks easily about everything and thinks out loud',
            'friend' => 'fun, full of ideas and friendly with everyone',
            'need'   => 'mental stimulation, space and a partner who enjoys talking'],
        'Cancer' => ['element' => 'water', 'modality' => 'cardinal', 'ruler' => 'Moon', 'dates' => 'Jun 21 – Jul 22', 'img' => 'horoscope-04.avif',
            'nature' => 'caring, protective and led by feelings',
            'love'   => 'loves deeply, remembers everything and wants to build a family',
            'talk'   => 'hints rather than says things directly and reads moods well',
            'friend' => 'the one who looks after everyone and never forgets a birthday',
            'need'   => 'emotional safety, reassurance and loyalty'],
        'Leo' => ['element' => 'fire', 'modality' => 'fixed', 'ruler' => 'Sun', 'dates' => 'Jul 23 – Aug 22', 'img' => 'horoscope-05.avif',
            'nature' => 'warm, proud and generous',
            'love'   => 'loves grandly, gives a lot and wants to be admired in return',
            'talk'   => 'speaks with confidence and likes to be heard',
            'friend' => 'loyal, protective and the heart of every gathering',
            'need'   => 'appreciation, respect and wholehearted attention'],
        'Virgo' => ['element' => 'earth', 'modality' => 'mutable', 'ruler' => 'Mercury', 'dates' => 'Aug 23 – Sep 22', 'img' => 'horoscope-06.avif',
            'nature' => 'practical, observant and careful about details',
            'love'   => 'shows love by helping, fixing and remembering the small things',
            'talk'   => 'is precise and honest and can sound critical without meaning to',
            'friend' => 'the reliable one who gives useful advice',
            'need'   => 'order, sincerity and a partner who notices the effort'],
        'Libra' => ['element' => 'air', 'modality' => 'cardinal', 'ruler' => 'Venus', 'dates' => 'Sep 23 – Oct 22', 'img' => 'horoscope-07.avif',
            'nature' => 'charming, fair-minded and happiest in company',
            'love'   => 'is romantic, attentive and wants a true partnership of equals',
            'talk'   => 'is polite and diplomatic and avoids open conflict',
            'friend' => 'easy-going, sociable and a natural peacemaker',
            'need'   => 'harmony, companionship and shared decisions'],
        'Scorpio' => ['element' => 'water', 'modality' => 'fixed', 'ruler' => 'Mars', 'dates' => 'Oct 23 – Nov 21', 'img' => 'horoscope-08.avif',
            'nature' => 'intense, private and deeply loyal',
            'love'   => 'loves all or nothing and expects complete trust',
            'talk'   => 'says little, watches closely and means every word',
            'friend' => 'slow to trust, then loyal for life and good at keeping secrets',
            'need'   => 'honesty, depth and total commitment'],
        'Sagittarius' => ['element' => 'fire', 'modality' => 'mutable', 'ruler' => 'Jupiter', 'dates' => 'Nov 22 – Dec 21', 'img' => 'horoscope-09.avif',
            'nature' => 'optimistic, frank and always looking for the next adventure',
            'love'   => 'loves freely, hates feeling tied down and needs a partner who is also a friend',
            'talk'   => 'is blunt and funny and prefers big ideas to small talk',
            'friend' => 'cheerful, generous and ready for any plan',
            'need'   => 'freedom, honesty and room to grow'],
        'Capricorn' => ['element' => 'earth', 'modality' => 'cardinal', 'ruler' => 'Saturn', 'dates' => 'Dec 22 – Jan 19', 'img' => 'horoscope-10.avif',
            'nature' => 'disciplined, ambitious and responsible',
            'love'   => 'is cautious at first, then committed for the long term and shows love by providing',
            'talk'   => 'is brief and practical and keeps feelings private',
            'friend' => 'steady, loyal and the one to call in a crisis',
            'need'   => 'respect, stability and a partner with goals'],
        'Aquarius' => ['element' => 'air', 'modality' => 'fixed', 'ruler' => 'Saturn', 'dates' => 'Jan 20 – Feb 18', 'img' => 'horoscope-11.avif',
            'nature' => 'independent, original and thoughtful',
            'love'   => 'needs friendship first and plenty of personal space',
            'talk'   => 'loves ideas and debate and can seem detached about feelings',
            'friend' => 'open-minded, loyal and friendly with all kinds of people',
            'need'   => 'freedom, intellectual connection and acceptance'],
        'Pisces' => ['element' => 'water', 'modality' => 'mutable', 'ruler' => 'Jupiter', 'dates' => 'Feb 19 – Mar 20', 'img' => 'horoscope-12.avif',
            'nature' => 'gentle, imaginative and compassionate',
            'love'   => 'loves selflessly, dreams of a soulmate and gives without counting',
            'talk'   => 'speaks through feeling and avoids harsh words',
            'friend' => 'kind, understanding and always ready to listen',
            'need'   => 'tenderness, patience and emotional understanding'],
    ];

    const PLANETS = [
        'Sun' => 'pride and vitality', 'Moon' => 'feeling and care', 'Mars' => 'energy and desire',
        'Mercury' => 'thought and speech', 'Jupiter' => 'growth and optimism', 'Venus' => 'love and comfort',
        'Saturn' => 'discipline and duty',
    ];

    // Dono elements (alphabetical order me jode hue) => base score aur har hisse ka text
    const ELEMENTS = [
        'fire-fire' => ['base' => 84,
            'love'   => 'Two fire signs light each other up at once. There is passion, laughter and plenty of shared energy, but also two strong wills that both want to lead.',
            'sexual' => 'Physical attraction is immediate and enthusiastic. Neither partner is shy about what they want, and boredom is rarely a problem.',
            'friend' => 'As friends they push each other to do more and go further, and there is always a plan in motion.',
            'talk'   => 'Conversations are fast and frank. Arguments flare up quickly and usually burn out just as fast, as long as neither holds on to pride.',
            'tip'    => 'Take turns leading, and let small arguments end without needing a winner.'],
        'earth-fire' => ['base' => 56,
            'love'   => 'Fire wants speed and excitement while earth wants steadiness and proof. The attraction is real, but the two move at very different paces.',
            'sexual' => 'Fire brings spontaneity and earth brings sensuality and stamina. It works well when fire slows down and earth allows a little surprise.',
            'friend' => 'The friendship works best around a shared goal, where fire supplies the drive and earth makes sure the work gets finished.',
            'talk'   => 'Fire speaks on impulse and earth answers only after thinking. Patience on one side and a little flexibility on the other prevent most quarrels.',
            'tip'    => 'Let the fire partner bring new ideas and the earth partner set the pace for big decisions.'],
        'air-fire' => ['base' => 80,
            'love'   => 'Air feeds fire. Ideas, plans and enthusiasm flow easily between the two, and the relationship rarely feels heavy.',
            'sexual' => 'Attraction starts in the mind and moves quickly to the body. Playfulness and variety keep the spark alive.',
            'friend' => 'These two are natural friends who enjoy travel, talk and trying new things together.',
            'talk'   => 'Communication is the strong point here: air offers ideas and fire responds with action. The risk is promising more than either follows through on.',
            'tip'    => 'Keep doing new things together, and make sure plans turn into action.'],
        'fire-water' => ['base' => 52,
            'love'   => 'Fire and water feel each other strongly. Fire can find water too sensitive, and water can find fire too harsh, yet each has what the other lacks.',
            'sexual' => 'Fire brings heat and water brings emotional depth. When there is trust the connection is intense; without it, moods get in the way.',
            'friend' => 'Friendship takes effort, because fire moves on quickly while water remembers. It deepens when fire learns to listen and water learns to let go.',
            'talk'   => 'Fire is blunt and water is easily hurt. Softer words from one and more direct words from the other make all the difference.',
            'tip'    => 'The fire partner should soften the words; the water partner should say plainly what hurts instead of withdrawing.'],
        'earth-earth' => ['base' => 84,
            'love'   => 'Two earth signs build slowly and for the long term. Loyalty, routine and shared goals make this a dependable match.',
            'sexual' => 'Physical affection is steady, sensual and unhurried. Comfort and trust matter more than novelty.',
            'friend' => 'They are reliable friends who help each other in practical ways and keep their promises.',
            'talk'   => 'Both prefer facts to drama, so talks are calm and useful. Feelings, however, may go unspoken for too long.',
            'tip'    => 'Break the routine now and then, and say the affectionate things out loud.'],
        'air-earth' => ['base' => 50,
            'love'   => 'Air lives in ideas and earth lives in what is real. One finds the other too serious, the other finds the first too changeable, so this match needs patience.',
            'sexual' => 'Earth wants touch and presence while air wants talk and variety. Meeting halfway takes conscious effort.',
            'friend' => 'They can be useful friends: air brings fresh ideas and earth brings the plan to make them work.',
            'talk'   => 'Air likes to explore every option and earth wants a decision. Agreeing on when to discuss and when to decide helps.',
            'tip'    => 'Give the air partner room to talk things through and the earth partner time to decide.'],
        'earth-water' => ['base' => 80,
            'love'   => 'Water nourishes earth and earth gives water a shape. Both want security and commitment, which makes this one of the most natural matches.',
            'sexual' => 'Intimacy is tender, loyal and deeply felt. Trust builds over time and makes the bond stronger each year.',
            'friend' => 'They are caring friends who show up for each other, with earth offering practical help and water offering understanding.',
            'talk'   => 'Earth is plain-spoken and water is sensitive, but both listen well. Problems come only when feelings are left unspoken.',
            'tip'    => 'Keep sharing feelings as well as plans, and avoid slipping into silence when upset.'],
        'air-air' => ['base' => 84,
            'love'   => 'Two air signs connect first as friends. Conversation never runs out and both value freedom, though deeper feelings can get talked around instead of felt.',
            'sexual' => 'Attraction is light, playful and driven by curiosity. Emotional closeness has to be built deliberately.',
            'friend' => 'This is an easy, lively friendship full of ideas, humour and shared interests.',
            'talk'   => 'They can talk for hours and rarely misunderstand each other. The challenge is turning talk into decisions.',
            'tip'    => 'Make time for feelings as well as ideas, and finish what you plan together.'],
        'air-water' => ['base' => 54,
            'love'   => 'Air thinks and water feels. Air may seem distant to water, and water may seem too emotional to air, so understanding takes work.',
            'sexual' => 'Water looks for emotional closeness and air for mental connection. The bond grows when each learns the other\'s language.',
            'friend' => 'As friends they broaden each other: air helps water step back from a mood, and water helps air notice what others feel.',
            'talk'   => 'Air explains and water senses. Speaking from the heart on one side and with clarity on the other closes the gap.',
            'tip'    => 'The air partner should ask about feelings; the water partner should explain them instead of expecting to be read.'],
        'water-water' => ['base' => 84,
            'love'   => 'Two water signs understand each other without many words. The bond is deep, protective and emotional, though moods can pull both down together.',
            'sexual' => 'Intimacy is intense and soulful, built on complete emotional trust.',
            'friend' => 'They are devoted friends who sense when something is wrong and offer comfort at once.',
            'talk'   => 'Much is communicated through feeling and silence. Saying things plainly now and then prevents hurt from building up.',
            'tip'    => 'Keep some light, practical activity in your life together so that emotions do not take over.'],
    ];

    // Zodiac me dono rashiyon ke beech ki doori (0 = same sign ... 6 = opposite) => score par asar aur ek line
    const DISTANCE = [
        0 => ['love' => -4, 'sexual' => -2, 'friend' => 6, 'talk' => 4,
            'text' => 'Being the same sign, they see their own strengths and faults in each other, which brings instant understanding and the occasional clash.'],
        1 => ['love' => -4, 'sexual' => -6, 'friend' => 0, 'talk' => -2,
            'text' => 'The signs sit next to each other in the zodiac, so their outlooks differ and each has something to learn from the other.'],
        2 => ['love' => 4, 'sexual' => 2, 'friend' => 8, 'talk' => 6,
            'text' => 'The signs are two places apart, a friendly angle that makes cooperation come easily.'],
        3 => ['love' => -2, 'sexual' => 8, 'friend' => -6, 'talk' => -8,
            'text' => 'The signs are three places apart, an angle of tension that creates strong attraction and equally strong disagreement.'],
        4 => ['love' => 8, 'sexual' => 6, 'friend' => 8, 'talk' => 6,
            'text' => 'The signs are four places apart and share the same element, the most harmonious angle in astrology.'],
        5 => ['love' => -4, 'sexual' => -4, 'friend' => -4, 'talk' => -6,
            'text' => 'The signs are five places apart and have little in common by nature, so the relationship grows through adjustment.'],
        6 => ['love' => 10, 'sexual' => 12, 'friend' => 2, 'talk' => 2,
            'text' => 'The signs are opposite each other in the zodiac. Opposites attract, and each partner completes what the other is missing.'],
    ];

    const MODALITIES = [
        'cardinal-cardinal' => 'Both are cardinal signs who like to take the lead, so they must decide who is in charge of what.',
        'fixed-fixed'       => 'Both are fixed signs, loyal but stubborn, and neither gives in easily.',
        'mutable-mutable'   => 'Both are mutable signs, flexible and easy-going, though someone has to make the final call.',
        'cardinal-fixed'    => 'One starts things and the other sustains them, which works when the cardinal sign respects the fixed sign\'s need for consistency.',
        'cardinal-mutable'  => 'One leads and the other adapts, which keeps things moving smoothly.',
        'fixed-mutable'     => 'One is steady and the other is flexible; the balance works when the steady partner allows some change.',
    ];

    public static function slugs(): string
    {
        return strtolower(implode('|', array_keys(self::SIGNS)));
    }

    // Sentence me likhne ke liye: "the Sun", "the Moon", baaki grah waise hi
    public static function planetName(string $planet): string
    {
        return in_array($planet, ['Sun', 'Moon']) ? 'the ' . $planet : $planet;
    }

    // Is rashi ke saath sabse achhi jodi wali rashiyan (same ya saath dene wala element)
    public static function bestMatches(string $sign): array
    {
        $friendly = ['fire' => ['fire', 'air'], 'air' => ['air', 'fire'], 'earth' => ['earth', 'water'], 'water' => ['water', 'earth']];
        $element = self::SIGNS[$sign]['element'];

        return array_keys(array_filter(self::SIGNS, fn($meta, $name) => $name !== $sign && in_array($meta['element'], $friendly[$element]), ARRAY_FILTER_USE_BOTH));
    }

    // Do rashiyon ki poori report. Aries + Taurus aur Taurus + Aries ka score same aata hai.
    public static function report(string $a, string $b): array
    {
        $A = self::SIGNS[$a];
        $B = self::SIGNS[$b];
        $same = $a === $b;

        $names = array_keys(self::SIGNS);
        $distance = abs(array_search($a, $names) - array_search($b, $names));
        $distance = min($distance, 12 - $distance);

        $elements = [$A['element'], $B['element']];
        sort($elements);
        $element = self::ELEMENTS[implode('-', $elements)];

        $modalities = [$A['modality'], $B['modality']];
        sort($modalities);
        $modalityKey = implode('-', $modalities);
        $modalityText = self::MODALITIES[$modalityKey];

        $pair = [$a, $b];
        sort($pair);
        $pairKey = implode('+', $pair);

        $scores = [];
        foreach (['love', 'sexual', 'friend', 'talk'] as $area) {
            $score = $element['base'] + self::DISTANCE[$distance][$area];
            if ($area === 'friend' && $modalityKey === 'fixed-fixed') $score -= 4;
            if ($area === 'talk') {
                if (in_array('air', $elements)) $score += 4;
                if ($modalityKey === 'fixed-fixed') $score -= 6;
                if ($modalityKey === 'mutable-mutable') $score += 3;
            }
            $score += crc32($pairKey . $area) % 7 - 3; // har jodi ka score thoda alag dikhe
            $scores[$area] = max(35, min(97, $score));
        }

        $rulerA = self::planetName($A['ruler']);
        $rulerB = self::planetName($B['ruler']);
        $rulers = $A['ruler'] === $B['ruler']
            ? ($same ? "Both partners are ruled by $rulerA" : "$a and $b are both ruled by $rulerA") . ', the planet of ' . self::PLANETS[$A['ruler']] . ', so they share the same basic drive.'
            : "$a is ruled by $rulerA, the planet of " . self::PLANETS[$A['ruler']] . ", and $b by $rulerB, the planet of " . self::PLANETS[$B['ruler']] . '.';

        $verdict = match (true) {
            $scores['love'] >= 80 => 'Overall this is a strong match that needs little effort to work.',
            $scores['love'] >= 65 => 'Overall this is a good match with a few differences to manage.',
            $scores['love'] >= 50 => 'Overall this is a workable match that asks for patience from both.',
            default               => 'Overall this is a challenging match that succeeds only with real commitment on both sides.',
        };

        $inLove = $same
            ? "In love, $a {$A['love']}, and here both partners do the same."
            : "In love, $a {$A['love']}, while $b {$B['love']}.";
        $asFriends = $same
            ? "As a friend, $a is {$A['friend']}, and two of them together double that quality."
            : "As a friend, $a is {$A['friend']}, while $b is {$B['friend']}.";
        $inTalk = $same
            ? "$a {$A['talk']}, so both speak the same language."
            : "$a {$A['talk']}. $b {$B['talk']}.";

        return [
            'a' => $a, 'b' => $b, 'metaA' => $A, 'metaB' => $B,
            'sections' => [
                ['title' => 'Love Compatibility', 'percent' => $scores['love'],
                    'text' => [$rulers . ' ' . $element['love'], self::DISTANCE[$distance]['text'] . ' ' . $verdict]],
                ['title' => 'Sexual Compatibility', 'percent' => $scores['sexual'],
                    'text' => [$inLove, $element['sexual']]],
                ['title' => 'Friendship Compatibility', 'percent' => $scores['friend'],
                    'text' => [$asFriends, $element['friend'] . ' ' . $modalityText]],
                ['title' => 'Communication Compatibility', 'percent' => $scores['talk'],
                    'text' => [$inTalk, $element['talk']]],
            ],
            'tips' => $same
                ? ["$a needs {$A['need']}. Since both want the same things, give what you expect to receive.", $element['tip']]
                : ["$a needs {$A['need']}.", "$b needs {$B['need']}.", $element['tip']],
        ];
    }
}
