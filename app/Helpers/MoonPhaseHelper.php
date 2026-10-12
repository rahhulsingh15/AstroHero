<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Natal Moon phase from the real Sun-Moon angle at the birth moment,
 * with the matching tithi, paksha, Moon sign and nakshatra.
 */
class MoonPhaseHelper
{
    const SYNODIC_MONTH = 29.530588; // days from one New Moon to the next

    // Eight phases of 45° each, centred on 0° (New), 45°, 90° (First Quarter) ... of the Moon's angle ahead of the Sun
    const PHASES = [
        [
            'name'  => 'New Moon',
            'title' => 'The Initiator',
            'tags'  => ['Instinctive', 'Fresh', 'Spontaneous'],
            'about' => 'The Moon is close to the Sun and almost invisible in the sky. A new cycle is beginning, so this phase stands for fresh starts, instinct and pure potential.',
            'traits' => [
                'Instinctive and spontaneous' => 'You act first and understand later, trusting your gut more than any plan.',
                'A natural beginner' => 'You are at your best when starting something new and bring enthusiasm to every fresh project.',
                'Youthful in spirit' => 'You meet life with openness and a certain innocence, whatever your age.',
            ],
            'challenges' => 'You may rush in without seeing the full picture and lose interest once the newness fades. Learning to finish what you start, and to pause before acting, brings out your best.',
        ],
        [
            'name'  => 'Waxing Crescent',
            'title' => 'The Planner',
            'tags'  => ['Creative', 'Driven', 'Growth'],
            'about' => 'A thin sliver of the Moon becomes visible as it begins its journey towards fullness. This phase stands for growth, planning and taking the first steps towards your goals.',
            'traits' => [
                'Determined and assertive' => 'You are focused on growth and expansion in life.',
                'Action-oriented' => 'You have a strong drive to push forward, overcome obstacles and establish yourself.',
                'Highly motivated' => 'You are always looking for ways to succeed and improve your current situation.',
            ],
            'challenges' => 'You might feel a constant underlying tension or urgency to prove yourself, and old habits can pull you back. Learning patience and trusting the process is essential for your long-term success.',
        ],
        [
            'name'  => 'First Quarter',
            'title' => 'The Action-Taker',
            'tags'  => ['Bold', 'Decisive', 'Energetic'],
            'about' => 'Half of the Moon is lit and its light is growing fast. This phase stands for decision, action and breaking through whatever stands in the way.',
            'traits' => [
                'Decisive under pressure' => 'You make quick choices and are at your best in a crisis.',
                'Strong-willed' => 'You enjoy a challenge and do not give up when you meet resistance.',
                'A builder' => 'You like to turn ideas into something real and visible.',
            ],
            'challenges' => 'You can be impatient and may create conflict where none is needed. Choosing your battles, and listening before you push ahead, saves you a great deal of energy.',
        ],
        [
            'name'  => 'Waxing Gibbous',
            'title' => 'The Perfecter',
            'tags'  => ['Analytical', 'Devoted', 'Improving'],
            'about' => 'The Moon is almost full, with only a small part still in shadow. This phase stands for refining, improving and preparing for what is about to be completed.',
            'traits' => [
                'Always improving' => 'You keep asking how things could be done better and rarely settle for "good enough".',
                'Thoughtful and analytical' => 'You look for the meaning behind events and like to understand how things work.',
                'Devoted to a purpose' => 'You give your best when you believe in a goal or a person.',
            ],
            'challenges' => 'Your wish to perfect everything can turn into self-criticism and the feeling of never being ready. Accepting that progress matters more than perfection brings you peace.',
        ],
        [
            'name'  => 'Full Moon',
            'title' => 'The Illuminator',
            'tags'  => ['Expressive', 'Aware', 'Relationship-focused'],
            'about' => 'The Moon stands opposite the Sun and shines with its whole face. This phase stands for fulfilment, clarity and seeing things as they really are.',
            'traits' => [
                'Clear-sighted' => 'You see situations and people objectively and can hold two sides of a question at once.',
                'Relationship-oriented' => 'You understand yourself best through other people, and partnerships are central to your life.',
                'Expressive and magnetic' => 'Your feelings show openly and others are drawn to your warmth.',
            ],
            'challenges' => 'You can feel pulled between your head and your heart, or between your own needs and those of others. Finding balance, instead of swinging between extremes, is your life lesson.',
        ],
        [
            'name'  => 'Waning Gibbous',
            'title' => 'The Teacher',
            'tags'  => ['Wise', 'Communicative', 'Generous'],
            'about' => 'The Moon has just passed full and its light slowly begins to decrease. Also called the Disseminating Moon, this phase stands for sharing what has been learned.',
            'traits' => [
                'A natural teacher' => 'You have a gift for explaining ideas and passing on what you know.',
                'Guided by beliefs' => 'You need a philosophy or cause to live by and speak about it with conviction.',
                'Generous with knowledge' => 'You enjoy helping others grow and give your experience freely.',
            ],
            'challenges' => 'You may become too attached to your own point of view, or preach where you should listen. Staying open to other ideas keeps your wisdom alive.',
        ],
        [
            'name'  => 'Last Quarter',
            'title' => 'The Reformer',
            'tags'  => ['Independent', 'Principled', 'Reflective'],
            'about' => 'Half of the Moon is lit again, but now its light is fading. This phase stands for re-evaluation, letting go of what no longer works and turning in a new direction.',
            'traits' => [
                'Independent thinker' => 'You question accepted ideas and follow your own principles.',
                'Inwardly changing' => 'You grow through turning points, often long before others can see the change.',
                'Responsible and mature' => 'You take your duties seriously and act according to your conscience.',
            ],
            'challenges' => 'You may feel out of step with the people around you, or hold on to the past while already wanting something new. Letting go without guilt frees you to move ahead.',
        ],
        [
            'name'  => 'Waning Crescent',
            'title' => 'The Mystic',
            'tags'  => ['Intuitive', 'Spiritual', 'Compassionate'],
            'about' => 'Only a thin sliver of the Moon remains before it disappears into the next New Moon. Also called the Balsamic Moon, this phase stands for rest, release and inner wisdom.',
            'traits' => [
                'Deeply intuitive' => 'You sense things before they happen and often feel older than your years.',
                'Spiritual and reflective' => 'You need time alone and are drawn to faith, healing or meditation.',
                'Compassionate' => 'You understand the suffering of others and quietly help where you can.',
            ],
            'challenges' => 'You can feel different from others, withdraw too much or carry burdens that are not yours. Trusting your inner voice, while staying connected to everyday life, keeps you steady.',
        ],
    ];

    /**
     * Full Moon phase report for a birth moment.
     */
    public static function report(Carbon $birth): array
    {
        $planets = TransitHelper::siderealAt($birth);

        // How far the Moon is ahead of the Sun: 0° New Moon, 180° Full Moon
        $angle = fmod($planets['Moon'] - $planets['Sun'] + 360, 360);
        $index = (int) floor(fmod($angle + 22.5, 360) / 45);
        $phase = self::PHASES[$index];

        $tithiNo = (int) floor($angle / 12) + 1; // 1..30
        if ($tithiNo === 15) {
            $tithi = 'Purnima';
        } elseif ($tithiNo === 30) {
            $tithi = 'Amavasya';
        } else {
            $tithi = TransitHelper::TITHIS[($tithiNo - 1) % 15];
        }

        $nakSpan = 360 / 27;

        return $phase + [
            'number'       => $index + 1,
            'start'        => fmod($index * 45 - 22.5 + 360, 360),
            'end'          => $index * 45 + 22.5,
            'angle'        => (int) round($angle) % 360,
            'illumination' => (int) round((1 - cos(deg2rad($angle))) / 2 * 100),
            'age'          => round($angle / 360 * self::SYNODIC_MONTH, 1),
            'waxing'       => $angle < 180,
            'tithi'        => $tithi,
            'paksha'       => $tithiNo <= 15 ? 'Shukla Paksha' : 'Krishna Paksha',
            'moonSign'     => TransitHelper::SIGNS[(int) floor($planets['Moon'] / 30)],
            'sunSign'      => TransitHelper::SIGNS[(int) floor($planets['Sun'] / 30)],
            'nakshatra'    => TransitHelper::NAKSHATRAS[(int) floor($planets['Moon'] / $nakSpan)],
            'svgPath'      => self::litPath($angle),
        ];
    }

    /**
     * SVG path of the sunlit part of the Moon inside a circle of radius 100 at (120,120),
     * as seen from the northern hemisphere (waxing = lit on the right).
     */
    private static function litPath(float $angle): string
    {
        $waxing = $angle < 180;
        $a = $waxing ? $angle : 360 - $angle;

        // Terminator is half an ellipse whose width shrinks to zero at the quarters
        $rx = round(abs(cos(deg2rad($a))) * 100, 2);
        $limb = $waxing ? 1 : 0;
        $terminator = ($a < 90) === $waxing ? 0 : 1;

        return "M120 20 A100 100 0 0 {$limb} 120 220 A{$rx} 100 0 0 {$terminator} 120 20 Z";
    }
}
