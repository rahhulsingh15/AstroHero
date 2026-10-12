<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Jaimini Chara Karakas (Atmakaraka to Darakaraka) and the Ishta Devata,
 * from the real degrees of the seven planets at birth (Lahiri).
 */
class JaiminiHelper
{
    // The seven karakas in order, from the highest degree to the lowest
    const KARAKAS = [
        'Atmakaraka'    => 'The soul and the self',
        'Amatyakaraka'  => 'Career, work and advisers',
        'Bhratrikaraka' => 'Brothers, sisters and the guru',
        'Matrikaraka'   => 'Mother, home and education',
        'Putrakaraka'   => 'Children, creativity and intelligence',
        'Gnatikaraka'   => 'Rivals, obstacles and illness',
        'Darakaraka'    => 'Spouse and partnerships',
    ];

    // What the soul has come to learn when each planet is the Atmakaraka
    const ATMA = [
        'Sun'     => 'Your soul planet is the Sun. You are here to learn humility. Power, position and recognition matter a great deal to you, and life keeps placing you where your ego is tested. When you lead to serve and not to be praised, you find real peace.',
        'Moon'    => 'Your soul planet is the Moon. You are here to learn compassion without attachment. You feel deeply and want to care for everyone, and your lesson is to give that care freely, without needing people to stay or to need you.',
        'Mars'    => 'Your soul planet is Mars. You are here to learn non-violence. You have great energy and a fighting spirit, and life teaches you to master anger and to use your strength to protect, never to harm.',
        'Mercury' => 'Your soul planet is Mercury. You are here to learn truthfulness. You are clever with words and ideas, and your lesson is to use that intelligence honestly, keeping what you think, say and do the same.',
        'Jupiter' => 'Your soul planet is Jupiter. You are here to learn respect for knowledge. Teachers, elders and children play a large part in your life, and you grow by honouring the guru and by caring for those who learn from you.',
        'Venus'   => 'Your soul planet is Venus. You are here to learn purity in desire. Love, pleasure and relationships pull you strongly, and your lesson is to stay faithful and keep your character clean in all matters of the heart.',
        'Saturn'  => 'Your soul planet is Saturn. You are here to learn to share the sorrow of others. You know what hardship feels like, and your path is to carry responsibility patiently and never be the cause of another person\'s suffering.',
    ];

    // The kind of life partner each planet shows as the Darakaraka
    const DARA = [
        'Sun'     => 'Your spouse planet is the Sun. Your partner is likely to be confident, dignified and proud, someone with authority or a respected position. They like to lead, so mutual respect matters more than anything else in your marriage.',
        'Moon'    => 'Your spouse planet is the Moon. Your partner is likely to be caring, emotional and attached to home and family. They are gentle and nurturing, and their moods need understanding and patience from you.',
        'Mars'    => 'Your spouse planet is Mars. Your partner is likely to be energetic, courageous and direct. They are active and protective, quick to act and sometimes quick to anger, so calm communication keeps the bond strong.',
        'Mercury' => 'Your spouse planet is Mercury. Your partner is likely to be intelligent, youthful and talkative, with a good sense of humour. Friendship and conversation are the base of your marriage.',
        'Jupiter' => 'Your spouse planet is Jupiter. Your partner is likely to be wise, principled and generous, often well educated or spiritually inclined. They guide you and bring growth and good fortune into your life.',
        'Venus'   => 'Your spouse planet is Venus. Your partner is likely to be charming, affectionate and fond of beauty and comfort. Romance is strong in your marriage, and a pleasant home life matters to both of you.',
        'Saturn'  => 'Your spouse planet is Saturn. Your partner is likely to be serious, hard-working and dependable, sometimes older or more mature than you. Marriage may come a little late, but it is built to last.',
    ];

    // The deity each planet stands for, as on the Ishta Devata calculator page
    const DEITIES = [
        'Sun'     => ['deity' => 'Lord Shiva', 'also' => 'Lord Rama', 'mantra' => 'Om Namah Shivaya', 'day' => 'Monday', 'offering' => 'Offer water and bilva leaves on a Shivling.'],
        'Moon'    => ['deity' => 'Goddess Parvati', 'also' => 'Lord Krishna', 'mantra' => 'Om Hreem Gauryai Namah', 'day' => 'Monday', 'offering' => 'Offer white flowers and milk sweets.'],
        'Mars'    => ['deity' => 'Lord Hanuman', 'also' => 'Lord Kartikeya', 'mantra' => 'Om Hanumate Namah', 'day' => 'Tuesday', 'offering' => 'Recite the Hanuman Chalisa and offer sindoor and jaggery.'],
        'Mercury' => ['deity' => 'Lord Vishnu', 'also' => null, 'mantra' => 'Om Namo Narayanaya', 'day' => 'Wednesday', 'offering' => 'Offer tulsi leaves and recite the Vishnu Sahasranama.'],
        'Jupiter' => ['deity' => 'Lord Vishnu', 'also' => 'Lord Dattatreya', 'mantra' => 'Om Namo Bhagavate Vasudevaya', 'day' => 'Thursday', 'offering' => 'Offer yellow flowers, chana dal and tulsi leaves.'],
        'Venus'   => ['deity' => 'Goddess Lakshmi', 'also' => null, 'mantra' => 'Om Shreem Mahalakshmyai Namah', 'day' => 'Friday', 'offering' => 'Offer lotus or pink flowers and light a ghee lamp.'],
        'Saturn'  => ['deity' => 'Lord Shani', 'also' => 'Lord Hanuman', 'mantra' => 'Om Sham Shanaishcharaya Namah', 'day' => 'Saturday', 'offering' => 'Light a sesame oil lamp and donate black sesame.'],
        'Rahu'    => ['deity' => 'Goddess Durga', 'also' => null, 'mantra' => 'Om Dum Durgayai Namah', 'day' => 'Friday', 'offering' => 'Offer red flowers and recite the Durga Chalisa.'],
        'Ketu'    => ['deity' => 'Lord Ganesha', 'also' => null, 'mantra' => 'Om Gam Ganapataye Namah', 'day' => 'Wednesday', 'offering' => 'Offer durva grass and modak.'],
    ];

    /**
     * The seven planets ranked by degree inside their sign.
     * [['karaka' => 'Atmakaraka', 'meaning' => ..., 'planet' => 'Venus'] + point, ...]
     */
    public static function karakas(Carbon $birth): array
    {
        $lons = TransitHelper::siderealAt($birth);

        $rows = [];
        foreach (array_keys(self::ATMA) as $planet) {
            $rows[] = ['planet' => $planet] + KundliHelper::point($lons[$planet]);
        }
        usort($rows, fn ($a, $b) => $b['inSign'] <=> $a['inSign']);

        $titles = array_keys(self::KARAKAS);
        foreach ($rows as $i => &$row) {
            $row['karaka'] = $titles[$i];
            $row['meaning'] = self::KARAKAS[$titles[$i]];
            $row['status'] = KundliHelper::dignity($row['planet'], $row['signIndex']);
        }
        unset($row);

        return $rows;
    }

    /**
     * Atmakaraka and Darakaraka report for a birth moment.
     */
    public static function report(Carbon $birth): array
    {
        $rows = self::karakas($birth);
        $atma = $rows[0];
        $dara = $rows[6];

        return [
            'rows'     => $rows,
            'atma'     => $atma,
            'dara'     => $dara,
            'atmaText' => self::ATMA[$atma['planet']],
            'daraText' => self::DARA[$dara['planet']],
            // two planets within a quarter of a degree: a small change in birth time can swap them
            'atmaClose' => $atma['inSign'] - $rows[1]['inSign'] < 0.25,
            'daraClose' => $rows[5]['inSign'] - $dara['inSign'] < 0.25,
        ];
    }

    /**
     * Ishta Devata: the 12th sign from the Karakamsa (the Atmakaraka's Navamsa sign).
     * A planet placed there in the Navamsa shows the deity; if it is empty, the lord of that sign does.
     */
    public static function ishtaDevata(Carbon $birth): array
    {
        $atma = self::karakas($birth)[0];
        $twelfth = ($atma['navamsa'] + 11) % 12;
        $lons = TransitHelper::siderealAt($birth);

        // The presiding deity of the birth star (the Moon's nakshatra), with its name in the North and the South
        $moon = KundliHelper::point($lons['Moon']);
        [$north, $south, $about] = NakshatraHelper::DEVATA[$moon['nakIndex']];
        $span = 360 / 27;
        $inNakshatra = fmod($moon['lon'], $span) / $span;

        // Planets in that Navamsa sign, the strongest (highest degree) first
        $occupants = [];
        foreach ($lons as $planet => $lon) {
            $p = KundliHelper::point($lon);
            if ($p['navamsa'] === $twelfth) $occupants[$planet] = $p['inSign'];
        }
        arsort($occupants);
        $occupants = array_keys($occupants);

        $planet = $occupants[0] ?? AscendantHelper::LORDS[$twelfth];

        // How far the Atmakaraka is from the edge of its 3°20' navamsa, in degrees
        $inNavamsa = fmod($atma['lon'], 30 / 9);

        return [
            'moon'        => $moon,
            'north'       => $north,
            'south'       => $south,
            'about'       => $about,
            // near a nakshatra border, where a small error in the birth time changes the star and its deity
            'starCusp'    => $inNakshatra < 0.04 || $inNakshatra > 0.96,
            'atma'        => $atma,
            'karakamsa'   => TransitHelper::SIGNS[$atma['navamsa']],
            'twelfth'     => TransitHelper::SIGNS[$twelfth],
            'occupants'   => $occupants,
            'planet'      => $planet,
            'byLord'      => empty($occupants),
            'deity'       => self::DEITIES[$planet],
            'others'      => array_map(fn ($p) => ['planet' => $p] + self::DEITIES[$p], array_slice($occupants, 1)),
            'nearCusp'    => $inNavamsa < 0.1 || $inNavamsa > 30 / 9 - 0.1,
        ];
    }
}
