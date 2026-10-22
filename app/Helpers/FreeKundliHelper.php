<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Free Kundli report: every number on the report and PDF pages comes from here.
 *
 * Panchang, Avakhada, planets (incl. Uranus/Neptune/Pluto), Lagna/Navamsa/16 divisional charts,
 * Bhav Chalit and KP (Placidus cusps), Ashtakvarga, Shadbala, Bhavabala, Vimshottari and Yogini
 * dashas, transits, doshas, remedies and chart-based predictions.
 */
class FreeKundliHelper
{
    const PLANETS7 = ['Sun', 'Moon', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn'];
    const PLANETS9 = ['Sun', 'Moon', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn', 'Rahu', 'Ketu'];
    const ABBR = [
        'Sun' => 'Su', 'Moon' => 'Mo', 'Mars' => 'Ma', 'Mercury' => 'Me', 'Jupiter' => 'Ju', 'Venus' => 'Ve',
        'Saturn' => 'Sa', 'Rahu' => 'Ra', 'Ketu' => 'Ke', 'Uranus' => 'Ur', 'Neptune' => 'Ne', 'Pluto' => 'Pl',
    ];
    // Weekday (0 = Sunday) => lord
    const DAY_LORDS = ['Sun', 'Moon', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn'];
    const DAY_NAMES = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    const YOGA_NAMES = [
        1 => 'Vishkambha', 2 => 'Priti', 3 => 'Ayushman', 4 => 'Saubhagya', 5 => 'Shobhana',
        6 => 'Atiganda', 7 => 'Sukarma', 8 => 'Dhriti', 9 => 'Shoola', 10 => 'Ganda',
        11 => 'Vriddhi', 12 => 'Dhruva', 13 => 'Vyaghata', 14 => 'Harshana', 15 => 'Vajra',
        16 => 'Siddhi', 17 => 'Vyatipata', 18 => 'Variyan', 19 => 'Parigha', 20 => 'Shiva',
        21 => 'Siddha', 22 => 'Sadhya', 23 => 'Shubha', 24 => 'Shukla', 25 => 'Brahma',
        26 => 'Indra', 27 => 'Vaidhriti',
    ];
    const MOVING_KARANAS = ['Bava', 'Balava', 'Kaulava', 'Taitila', 'Gara', 'Vanija', 'Vishti'];

    const NAKSHATRA_YONI = [
        'Ashwini' => 'Ashwa (Horse)', 'Bharani' => 'Gaja (Elephant)', 'Krittika' => 'Mesha (Sheep)',
        'Rohini' => 'Sarpa (Serpent)', 'Mrigashirsha' => 'Sarpa (Serpent)', 'Ardra' => 'Shwan (Dog)',
        'Punarvasu' => 'Marjara (Cat)', 'Pushya' => 'Mesha (Sheep)', 'Ashlesha' => 'Marjara (Cat)',
        'Magha' => 'Mushaka (Rat)', 'Purva Phalguni' => 'Mushaka (Rat)', 'Uttara Phalguni' => 'Gau (Cow)',
        'Hasta' => 'Mahisha (Buffalo)', 'Chitra' => 'Vyaghra (Tiger)', 'Swati' => 'Mahisha (Buffalo)',
        'Vishakha' => 'Vyaghra (Tiger)', 'Anuradha' => 'Mriga (Deer)', 'Jyeshtha' => 'Mriga (Deer)',
        'Mula' => 'Shwan (Dog)', 'Purva Ashadha' => 'Vanara (Monkey)', 'Uttara Ashadha' => 'Nakula (Mongoose)',
        'Shravana' => 'Vanara (Monkey)', 'Dhanishta' => 'Simha (Lion)', 'Shatabhisha' => 'Ashwa (Horse)',
        'Purva Bhadrapada' => 'Simha (Lion)', 'Uttara Bhadrapada' => 'Gau (Cow)', 'Revati' => 'Gaja (Elephant)',
    ];
    const NAKSHATRA_GANA = [
        'Ashwini' => 'Dev', 'Bharani' => 'Manushya', 'Krittika' => 'Rakshasa', 'Rohini' => 'Manushya',
        'Mrigashirsha' => 'Dev', 'Ardra' => 'Manushya', 'Punarvasu' => 'Dev', 'Pushya' => 'Dev',
        'Ashlesha' => 'Rakshasa', 'Magha' => 'Rakshasa', 'Purva Phalguni' => 'Manushya', 'Uttara Phalguni' => 'Manushya',
        'Hasta' => 'Dev', 'Chitra' => 'Rakshasa', 'Swati' => 'Dev', 'Vishakha' => 'Rakshasa', 'Anuradha' => 'Dev',
        'Jyeshtha' => 'Rakshasa', 'Mula' => 'Rakshasa', 'Purva Ashadha' => 'Manushya', 'Uttara Ashadha' => 'Manushya',
        'Shravana' => 'Dev', 'Dhanishta' => 'Rakshasa', 'Shatabhisha' => 'Rakshasa', 'Purva Bhadrapada' => 'Manushya',
        'Uttara Bhadrapada' => 'Manushya', 'Revati' => 'Dev',
    ];
    const NAKSHATRA_NADI = [
        'Ashwini' => 'Adi', 'Bharani' => 'Madhya', 'Krittika' => 'Antya', 'Rohini' => 'Antya', 'Mrigashirsha' => 'Madhya',
        'Ardra' => 'Adi', 'Punarvasu' => 'Adi', 'Pushya' => 'Madhya', 'Ashlesha' => 'Antya', 'Magha' => 'Antya',
        'Purva Phalguni' => 'Madhya', 'Uttara Phalguni' => 'Adi', 'Hasta' => 'Adi', 'Chitra' => 'Madhya', 'Swati' => 'Antya',
        'Vishakha' => 'Antya', 'Anuradha' => 'Madhya', 'Jyeshtha' => 'Adi', 'Mula' => 'Adi', 'Purva Ashadha' => 'Madhya',
        'Uttara Ashadha' => 'Antya', 'Shravana' => 'Antya', 'Dhanishta' => 'Madhya', 'Shatabhisha' => 'Adi',
        'Purva Bhadrapada' => 'Adi', 'Uttara Bhadrapada' => 'Madhya', 'Revati' => 'Antya',
    ];
    const NAKSHATRA_SYLLABLES = [
        'Ashwini' => ['Chu', 'Che', 'Cho', 'La'], 'Bharani' => ['Li', 'Lu', 'Le', 'Lo'], 'Krittika' => ['A', 'I', 'U', 'E'],
        'Rohini' => ['O', 'Va', 'Vi', 'Vu'], 'Mrigashirsha' => ['Ve', 'Vo', 'Ka', 'Ki'], 'Ardra' => ['Ku', 'Gha', 'Ng', 'Chha'],
        'Punarvasu' => ['Ke', 'Ko', 'Ha', 'Hi'], 'Pushya' => ['Hu', 'He', 'Ho', 'Da'], 'Ashlesha' => ['Di', 'Du', 'De', 'Do'],
        'Magha' => ['Ma', 'Mi', 'Mu', 'Me'], 'Purva Phalguni' => ['Mo', 'Ta', 'Ti', 'Tu'], 'Uttara Phalguni' => ['Te', 'To', 'Pa', 'Pi'],
        'Hasta' => ['Pu', 'Sha', 'Na', 'Tha'], 'Chitra' => ['Pe', 'Po', 'Ra', 'Ri'], 'Swati' => ['Ru', 'Re', 'Ro', 'Ta'],
        'Vishakha' => ['Ti', 'Tu', 'Te', 'To'], 'Anuradha' => ['Na', 'Ni', 'Nu', 'Ne'], 'Jyeshtha' => ['No', 'Ya', 'Yi', 'Yu'],
        'Mula' => ['Ye', 'Yo', 'Bha', 'Bhi'], 'Purva Ashadha' => ['Bhu', 'Dha', 'Pha', 'Dha'], 'Uttara Ashadha' => ['Bhe', 'Bho', 'Ja', 'Ji'],
        'Shravana' => ['Khi', 'Khu', 'Khe', 'Kho'], 'Dhanishta' => ['Ga', 'Gi', 'Gu', 'Ge'], 'Shatabhisha' => ['Go', 'Sa', 'Si', 'Su'],
        'Purva Bhadrapada' => ['Se', 'So', 'Da', 'Di'], 'Uttara Bhadrapada' => ['Du', 'Tha', 'Jha', 'Na'], 'Revati' => ['De', 'Do', 'Cha', 'Chi'],
    ];

    // Required Shadbala (virupas) for a planet to count as strong
    const REQUIRED_BALA = ['Sun' => 390, 'Moon' => 360, 'Mars' => 300, 'Mercury' => 420, 'Jupiter' => 390, 'Venus' => 330, 'Saturn' => 300];
    const NAISARGIKA = ['Sun' => 60, 'Moon' => 51.43, 'Mars' => 17.14, 'Mercury' => 25.71, 'Jupiter' => 34.29, 'Venus' => 42.86, 'Saturn' => 8.57];
    // Exact exaltation degree (sidereal longitude)
    const EXALT_DEG = ['Sun' => 10, 'Moon' => 33, 'Mars' => 298, 'Mercury' => 165, 'Jupiter' => 95, 'Venus' => 357, 'Saturn' => 200];

    /**
     * Ashtakvarga: for each receiving chart, the houses (counted from each contributor) that give a bindu.
     * Parashara's tables; totals Sun 48, Moon 49, Mars 39, Mercury 54, Jupiter 56, Venus 52, Saturn 39, Lagna 49.
     */
    const BAV = [
        'Sun' => [
            'Sun' => [1, 2, 4, 7, 8, 9, 10, 11], 'Moon' => [3, 6, 10, 11], 'Mars' => [1, 2, 4, 7, 8, 9, 10, 11],
            'Mercury' => [3, 5, 6, 9, 10, 11, 12], 'Jupiter' => [5, 6, 9, 11], 'Venus' => [6, 7, 12],
            'Saturn' => [1, 2, 4, 7, 8, 9, 10, 11], 'Lagna' => [3, 4, 6, 10, 11, 12],
        ],
        'Moon' => [
            'Sun' => [3, 6, 7, 8, 10, 11], 'Moon' => [1, 3, 6, 7, 10, 11], 'Mars' => [2, 3, 5, 6, 9, 10, 11],
            'Mercury' => [1, 3, 4, 5, 7, 8, 10, 11], 'Jupiter' => [1, 4, 7, 8, 10, 11, 12], 'Venus' => [3, 4, 5, 7, 9, 10, 11],
            'Saturn' => [3, 5, 6, 11], 'Lagna' => [3, 6, 10, 11],
        ],
        'Mars' => [
            'Sun' => [3, 5, 6, 10, 11], 'Moon' => [3, 6, 11], 'Mars' => [1, 2, 4, 7, 8, 10, 11],
            'Mercury' => [3, 5, 6, 11], 'Jupiter' => [6, 10, 11, 12], 'Venus' => [6, 8, 11, 12],
            'Saturn' => [1, 4, 7, 8, 9, 10, 11], 'Lagna' => [1, 3, 6, 10, 11],
        ],
        'Mercury' => [
            'Sun' => [5, 6, 9, 11, 12], 'Moon' => [2, 4, 6, 8, 10, 11], 'Mars' => [1, 2, 4, 7, 8, 9, 10, 11],
            'Mercury' => [1, 3, 5, 6, 9, 10, 11, 12], 'Jupiter' => [6, 8, 11, 12], 'Venus' => [1, 2, 3, 4, 5, 8, 9, 11],
            'Saturn' => [1, 2, 4, 7, 8, 9, 10, 11], 'Lagna' => [1, 2, 4, 6, 8, 10, 11],
        ],
        'Jupiter' => [
            'Sun' => [1, 2, 3, 4, 7, 8, 9, 10, 11], 'Moon' => [2, 5, 7, 9, 11], 'Mars' => [1, 2, 4, 7, 8, 10, 11],
            'Mercury' => [1, 2, 4, 5, 6, 9, 10, 11], 'Jupiter' => [1, 2, 3, 4, 7, 8, 10, 11], 'Venus' => [2, 5, 6, 9, 10, 11],
            'Saturn' => [3, 5, 6, 12], 'Lagna' => [1, 2, 4, 5, 6, 7, 9, 10, 11],
        ],
        'Venus' => [
            'Sun' => [8, 11, 12], 'Moon' => [1, 2, 3, 4, 5, 8, 9, 11, 12], 'Mars' => [3, 5, 6, 9, 11, 12],
            'Mercury' => [3, 5, 6, 9, 11], 'Jupiter' => [5, 8, 9, 10, 11], 'Venus' => [1, 2, 3, 4, 5, 8, 9, 10, 11],
            'Saturn' => [3, 4, 5, 8, 9, 10, 11], 'Lagna' => [1, 2, 3, 4, 5, 8, 9, 11],
        ],
        'Saturn' => [
            'Sun' => [1, 2, 4, 7, 8, 10, 11], 'Moon' => [3, 6, 11], 'Mars' => [3, 5, 6, 10, 11, 12],
            'Mercury' => [6, 8, 9, 10, 11, 12], 'Jupiter' => [5, 6, 11, 12], 'Venus' => [6, 11, 12],
            'Saturn' => [3, 5, 6, 11], 'Lagna' => [1, 3, 4, 6, 10, 11],
        ],
        'Ascendant' => [
            'Sun' => [3, 4, 6, 10, 11, 12], 'Moon' => [3, 6, 10, 11, 12], 'Mars' => [1, 3, 6, 10, 11],
            'Mercury' => [1, 2, 4, 6, 8, 10, 11], 'Jupiter' => [1, 2, 4, 5, 6, 7, 9, 10, 11], 'Venus' => [1, 2, 3, 4, 5, 8, 9],
            'Saturn' => [1, 3, 4, 6, 10, 11], 'Lagna' => [3, 6, 10, 11],
        ],
    ];

    const VARGAS = [
        'D1' => 'Rasi Chart', 'D2' => 'Hora (Wealth)', 'D3' => 'Drekkana - Relationship with Siblings',
        'D4' => 'Chaturthamsha - Assets & Property', 'D7' => 'Saptamsha - Children & Progeny', 'D9' => 'Navamsha - Marriage Prospects',
        'D10' => 'Dashamsha - Career & Profession', 'D12' => 'Dwadashamsha - Parents & Ancestors', 'D16' => 'Shodashamsha - Vehicles & Travel',
        'D20' => 'Vimshamsha - Spiritual Progress', 'D24' => 'Chaturvimshamsha - Education & Intellect', 'D27' => 'Saptavimshamsha - Strength & Weakness',
        'D30' => 'Trimshamsha - Misfortunes & Challenges', 'D40' => 'Khavedamsha - Auspicious Effects', 'D45' => 'Akshavedamsha - Sense of Well Being',
        'D60' => 'Shashtiamsha - Summary of All Charts',
    ];

    const YOGINIS = [
        ['code' => 'MAN', 'name' => 'Mangala', 'lord' => 'Moon', 'years' => 1],
        ['code' => 'PIN', 'name' => 'Pingala', 'lord' => 'Sun', 'years' => 2],
        ['code' => 'DHA', 'name' => 'Dhanya', 'lord' => 'Jupiter', 'years' => 3],
        ['code' => 'BHR', 'name' => 'Bhramari', 'lord' => 'Mars', 'years' => 4],
        ['code' => 'BHA', 'name' => 'Bhadrika', 'lord' => 'Mercury', 'years' => 5],
        ['code' => 'ULK', 'name' => 'Ulka', 'lord' => 'Saturn', 'years' => 6],
        ['code' => 'SID', 'name' => 'Siddha', 'lord' => 'Venus', 'years' => 7],
        ['code' => 'SAN', 'name' => 'Sankata', 'lord' => 'Rahu', 'years' => 8],
    ];

    // Gemstone of each planet, used for life / lucky / fortune stones
    const GEMS = [
        'Sun'     => ['gem' => 'Ruby (Manikya)', 'wear' => 'Gold, on ring finger', 'day' => 'Sunday', 'mantra' => 'Om hram hrim hraum sah suryaya namah'],
        'Moon'    => ['gem' => 'Pearl (Moti)', 'wear' => 'Silver, on little finger', 'day' => 'Monday', 'mantra' => 'Om shram shrim shraum sah chandramase namah'],
        'Mars'    => ['gem' => 'Red Coral (Moonga)', 'wear' => 'Gold or copper, on ring finger', 'day' => 'Tuesday', 'mantra' => 'Om kram krim kraum sah bhaumaya namah'],
        'Mercury' => ['gem' => 'Emerald (Panna)', 'wear' => 'Gold, on little finger', 'day' => 'Wednesday', 'mantra' => 'Om bram brim braum sah budhaya namah'],
        'Jupiter' => ['gem' => 'Yellow Sapphire (Pukhraj)', 'wear' => 'Gold, on index finger', 'day' => 'Thursday', 'mantra' => 'Om gram grim graum sah guruve namah'],
        'Venus'   => ['gem' => 'Diamond (Heera)', 'wear' => 'Silver or platinum, on middle finger', 'day' => 'Friday', 'mantra' => 'Om dram drim draum sah shukraya namah'],
        'Saturn'  => ['gem' => 'Blue Sapphire (Neelam)', 'wear' => 'Silver or panchdhatu, on middle finger', 'day' => 'Saturday', 'mantra' => 'Om pram prim praum sah shanaye namah'],
    ];

    // Rudraksha by the lord of the Moon's nakshatra
    const RUDRAKSHA_BY_LORD = [
        'Sun' => [1, 12], 'Moon' => [2, 16], 'Mars' => [3, 11], 'Mercury' => [4, 10], 'Jupiter' => [5, 11],
        'Venus' => [6, 13], 'Saturn' => [7, 14], 'Rahu' => [8, 17], 'Ketu' => [9, 11],
    ];

    const RUDRAKSHA = [
        1 => ['planet' => 'Sun', 'deity' => 'Lord Shiva', 'thread' => 'red or yellow silk', 'day' => 'Monday', 'mantra' => 'Om Hreem Namah',
            'details' => 'The 1-Mukhi rudraksha is the form of Lord Shiva himself and is counted the rarest and most powerful bead. It is ruled by the Sun and helps a person whose Sun is weak or afflicted to regain confidence, clarity and authority.',
            'benefits' => ['Builds self-confidence, leadership and willpower.', 'Improves concentration and calms a restless mind.', 'Supports heart and eye health in traditional belief.', 'Helps in gaining respect from seniors and government.', 'Draws the wearer towards meditation and higher awareness.']],
        2 => ['planet' => 'Moon', 'deity' => 'Ardhanarishvara', 'thread' => 'white silk', 'day' => 'Monday', 'mantra' => 'Om Namah',
            'details' => 'The 2-Mukhi rudraksha represents Ardhanarishvara, the united form of Shiva and Parvati. Ruled by the Moon, it brings harmony to relationships and emotional balance to a mind that is easily disturbed.',
            'benefits' => ['Brings unity and understanding between partners.', 'Calms anxiety, mood swings and emotional stress.', 'Supports peace and harmony in the family.', 'Helps those whose Moon is weak or afflicted.', 'Improves intuition and sensitivity in a balanced way.']],
        3 => ['planet' => 'Mars', 'deity' => 'Agni Dev', 'thread' => 'red silk', 'day' => 'Monday', 'mantra' => 'Om Kleem Namah',
            'details' => 'The 3-Mukhi rudraksha is the form of Agni, the fire god, and represents the three forms of fire. It burns away the weight of past mistakes, removes lethargy and fills the wearer with energy and self-belief.',
            'benefits' => ['Removes guilt, fear and the feeling of inferiority.', 'Brings energy, enthusiasm and willpower.', 'Supports digestion and recovery from long illness.', 'Reduces the harsh effects of a weak or afflicted Mars.', 'Helps students and workers stay active and focused.']],
        4 => ['planet' => 'Mercury', 'deity' => 'Lord Brahma', 'thread' => 'green or white silk', 'day' => 'Monday', 'mantra' => 'Om Hreem Namah',
            'details' => 'The 4-Mukhi rudraksha represents Lord Brahma, the creator, and is ruled by Mercury. It sharpens the intellect, improves memory and speech, and is especially helpful for students, writers and people in business.',
            'benefits' => ['Improves memory, learning and concentration.', 'Makes speech clear, confident and convincing.', 'Supports creativity and new ideas.', 'Helps in business, trade and communication work.', 'Reduces nervousness and mental fatigue.']],
        5 => ['planet' => 'Jupiter', 'deity' => 'Kalagni Rudra', 'thread' => 'yellow silk', 'day' => 'Thursday', 'mantra' => 'Om Hreem Namah',
            'details' => 'The 5-Mukhi rudraksha is the form of Kalagni Rudra and is the most common and widely worn bead. Ruled by Jupiter, it brings peace, good health and spiritual growth, and is safe for almost everyone to wear.',
            'benefits' => ['Brings peace of mind and lowers stress.', 'Supports blood pressure and heart health in traditional belief.', 'Strengthens a weak Jupiter and invites good fortune.', 'Helps in meditation, prayer and chanting.', 'Encourages wisdom, honesty and right decisions.']],
        6 => ['planet' => 'Venus', 'deity' => 'Lord Kartikeya', 'thread' => 'white or pink silk', 'day' => 'Friday', 'mantra' => 'Om Hreem Hum Namah',
            'details' => 'The 6-Mukhi rudraksha represents Lord Kartikeya, the commander of the gods, and is ruled by Venus. It brings charm, willpower and balance in love and comforts, and helps control the desires of the senses.',
            'benefits' => ['Improves charm, attraction and self-expression.', 'Brings harmony and stability in love and marriage.', 'Supports artistic and creative talents.', 'Gives willpower to control anger and over-indulgence.', 'Strengthens a weak or afflicted Venus.']],
        7 => ['planet' => 'Saturn', 'deity' => 'Goddess Mahalakshmi', 'thread' => 'black or blue silk', 'day' => 'Saturday', 'mantra' => 'Om Hum Namah',
            'details' => 'The 7-Mukhi rudraksha is blessed by Goddess Mahalakshmi and ruled by Saturn. It is worn for steady wealth, relief from financial trouble and protection during difficult Saturn periods such as Sade Sati.',
            'benefits' => ['Invites steady wealth and removes money troubles.', 'Reduces the hardship of Saturn periods and Sade Sati.', 'Brings patience, discipline and endurance.', 'Supports joint and bone health in traditional belief.', 'Helps business and new ventures grow slowly but surely.']],
        8 => ['planet' => 'Rahu', 'deity' => 'Lord Ganesha', 'thread' => 'red or black silk', 'day' => 'Wednesday', 'mantra' => 'Om Hum Namah',
            'details' => 'The 8-Mukhi rudraksha represents Lord Ganesha, the remover of obstacles, and is ruled by Rahu. It clears confusion and blockages, protects from deception and brings success in new beginnings.',
            'benefits' => ['Removes obstacles in work and personal life.', 'Reduces the confusing effects of Rahu.', 'Protects against deception and hidden enemies.', 'Sharpens focus and decision making.', 'Brings success when starting something new.']],
        9 => ['planet' => 'Ketu', 'deity' => 'Goddess Durga', 'thread' => 'red silk', 'day' => 'Tuesday', 'mantra' => 'Om Hreem Hum Namah',
            'details' => 'The 9-Mukhi rudraksha is the form of Goddess Durga with her nine powers and is ruled by Ketu. It gives courage, fearlessness and inner strength, and protects the wearer from negative energies.',
            'benefits' => ['Gives courage and removes deep fears.', 'Reduces the unsettling effects of Ketu.', 'Builds energy, stamina and determination.', 'Protects from negative energies and ill will.', 'Supports spiritual practice and devotion.']],
        10 => ['planet' => 'All planets', 'deity' => 'Lord Vishnu', 'thread' => 'yellow silk', 'day' => 'Monday', 'mantra' => 'Om Hreem Namah Namah',
            'details' => 'The 10-Mukhi rudraksha represents Lord Vishnu, the preserver, and is believed to calm the effects of all nine planets. It acts like a protective shield and brings stability when many things go wrong together.',
            'benefits' => ['Protects against the ill effects of all planets.', 'Brings stability and a sense of security.', 'Reduces fear, nightmares and negative influences.', 'Helps resolve legal and official disputes.', 'Supports a calm, balanced household.']],
        11 => ['planet' => 'All planets', 'deity' => 'Lord Hanuman', 'thread' => 'red silk', 'day' => 'Tuesday', 'mantra' => 'Om Hreem Hum Namah',
            'details' => 'The 11-Mukhi rudraksha represents the eleven Rudras and Lord Hanuman. It gives fearlessness, sound judgement and the strength to face challenges, and is often worn for success in adventurous or demanding work.',
            'benefits' => ['Gives courage, confidence and fearlessness.', 'Improves judgement and quick decision making.', 'Supports success in competitive and risky work.', 'Protects while travelling.', 'Helps in yoga and meditation practice.']],
        12 => ['planet' => 'Sun', 'deity' => 'Lord Surya', 'thread' => 'red silk', 'day' => 'Sunday', 'mantra' => 'Om Kraum Sraum Raum Namah',
            'details' => 'The 12-Mukhi rudraksha represents Lord Surya, the Sun god, and carries the brilliance of the twelve Adityas. It gives leadership, radiance and administrative ability, and helps those whose Sun is weak.',
            'benefits' => ['Builds leadership and administrative skill.', 'Brings name, fame and confidence.', 'Removes self-doubt and worry.', 'Supports eye and heart health in traditional belief.', 'Helps in government and public work.']],
        13 => ['planet' => 'Venus', 'deity' => 'Lord Indra and Kamadeva', 'thread' => 'white or pink silk', 'day' => 'Friday', 'mantra' => 'Om Hreem Namah',
            'details' => 'The 13-Mukhi rudraksha is blessed by Lord Indra and Kamadeva and ruled by Venus. It brings charm, comforts and fulfilment of worldly wishes, and improves magnetism in personal and public life.',
            'benefits' => ['Improves charm, attraction and popularity.', 'Brings comforts and luxuries.', 'Supports harmony in love and marriage.', 'Helps in creative and artistic work.', 'Fulfils worldly desires in a balanced way.']],
        14 => ['planet' => 'Saturn', 'deity' => 'Lord Hanuman and Lord Shiva', 'thread' => 'black or red silk', 'day' => 'Monday', 'mantra' => 'Om Namah',
            'details' => 'The 14-Mukhi rudraksha, called Deva Mani, is very powerful and ruled by Saturn. It awakens intuition, protects from the harsh effects of Saturn and Mars, and gives clear, fearless judgement.',
            'benefits' => ['Awakens intuition and inner guidance.', 'Reduces the hardship of Saturn and Sade Sati.', 'Protects from accidents and misfortune.', 'Gives clear judgement in difficult decisions.', 'Brings safety and stability in business.']],
        16 => ['planet' => 'Moon', 'deity' => 'Mahamrityunjaya (Lord Shiva)', 'thread' => 'white silk', 'day' => 'Monday', 'mantra' => 'Om Hraum Joom Sah',
            'details' => 'The 16-Mukhi rudraksha is linked with the Mahamrityunjaya form of Lord Shiva, the conqueror of death. It is worn for protection from fear, disease and sudden danger, and for lasting peace of mind.',
            'benefits' => ['Protects from fear of sudden danger and disease.', 'Brings peace and emotional strength.', 'Supports recovery from long illness.', 'Helps the household stay safe and united.', 'Deepens devotion and meditation.']],
        17 => ['planet' => 'Rahu', 'deity' => 'Lord Vishwakarma and Goddess Katyayani', 'thread' => 'red silk', 'day' => 'Monday', 'mantra' => 'Om Hreem Hum Namah',
            'details' => 'The 17-Mukhi rudraksha is blessed by Vishwakarma, the divine architect, and Goddess Katyayani. It is worn for sudden gains, property and the fulfilment of long-held material goals.',
            'benefits' => ['Brings sudden and unexpected gains.', 'Helps in buying property and vehicles.', 'Supports the completion of long-pending goals.', 'Improves focus and planning.', 'Reduces the confusing effects of Rahu.']],
    ];

    const RUDRAKSHA_PRECAUTIONS = [
        'Clean the rudraksha with Gangajal before wearing it for the first time.',
        'Wear it after a bath and remember the deity with faith.',
        'Do not let anyone else wear your rudraksha.',
        'Remove it before sleeping and keep it at your place of worship.',
        'Take it off before attending a funeral or entering a cremation ground.',
        'Avoid wearing it while consuming alcohol or non-vegetarian food.',
        'Keep it away from soap, perfume and chemicals; wipe it with a soft cloth.',
        'Wear only an intact, genuine bead and never show it off.',
    ];

    const PHYSICAL = [
        'Born in the Aries ascendant, you are likely to have a lean, active and muscular body of medium height, a broad forehead and sharp eyes. You move quickly and carry a bold, energetic presence.',
        'Born in the Taurus ascendant, you are likely to have a sturdy, well-built body with a strong neck and shoulders, attractive eyes and a pleasant face. Your manner is calm and graceful.',
        'Born in the Gemini ascendant, you are likely to be tall and slim with long arms, bright expressive eyes and a youthful look that stays with you. You move and speak quickly.',
        'Born in the Cancer ascendant, you are likely to have a medium build, a round face, soft features and a fair complexion. Your expressions change with your moods.',
        'Born in the Leo ascendant, you are likely to have broad shoulders, a commanding posture and a dignified, confident look. People notice you as soon as you enter a room.',
        'Born in the Virgo ascendant, you are likely to have a slim, well-proportioned body, neat features and a youthful face that hides your age. You are tidy in appearance and careful in speech.',
        'Born in the Libra ascendant, you are likely to have a balanced, attractive body, a charming smile and refined features. You dress well and naturally make a pleasant first impression.',
        'Born in the Scorpio ascendant, you are likely to have a compact, strong body, a penetrating gaze and an intense presence. You reveal little through your expressions.',
        'Born in the Sagittarius ascendant, you are likely to have a tall, well-proportioned body, an oval face with an open, pleasant expression and a high forehead. You carry a natural dignity.',
        'Born in the Capricorn ascendant, you are likely to have a lean, bony frame, a serious face and prominent features. You may look mature when young and youthful when older.',
        'Born in the Aquarius ascendant, you are likely to be tall with a strong, well-formed body and a friendly, distinctive face. You have an alert look and a style of your own.',
        'Born in the Pisces ascendant, you are likely to have a medium or short build, soft features, large expressive eyes and a gentle face. Your calm manner puts others at ease.',
    ];

    const HEALTH = [
        'Aries rules the head, so headaches, fevers, sinus trouble and small injuries from haste are the main points to watch. Regular sleep, cooling food and patience in physical activity keep you strong.',
        'Taurus rules the throat and neck. Throat infections, thyroid imbalance and weight gain from rich food are possible. Moderate eating and a daily walk keep your vitality steady.',
        'Gemini rules the lungs, shoulders and nerves. Restlessness, anxiety, coughs and breathing trouble are the weak points. Breathing exercises and a calm routine protect your health.',
        'Cancer rules the chest and stomach. Acidity, water retention and stress that shows up in the body need attention. Simple home-cooked food and peace of mind matter greatly for you.',
        'Leo rules the heart and spine. Back pain, blood pressure and heart health need attention, especially in later years. Regular exercise and not overworking keep you robust.',
        'Virgo rules the intestines and digestion. Stomach upsets, food intolerance and nervous worry are your weak points. A clean diet, regular meals and relaxation keep you healthy.',
        'Libra rules the kidneys and lower back. Kidney and urinary trouble, back ache and skin problems are possible. Drinking enough water and a balanced lifestyle help a lot.',
        'Scorpio rules the reproductive and excretory organs. Infections, piles and hormonal issues can arise, and stress tends to stay hidden. Regular check-ups and emotional release keep you well.',
        'Sagittarius rules the hips, thighs and liver. Liver trouble, weight around the hips and sciatica are the areas to watch. Outdoor activity and moderation in food keep you vital.',
        'Capricorn rules the knees, bones and joints. Joint pain, stiffness, dental and skin problems may come with age. Calcium-rich food, stretching and warmth in cold weather help you.',
        'Aquarius rules the calves, ankles and circulation. Cramps, varicose veins and nervous tension need attention. Regular movement and enough rest keep you energetic.',
        'Pisces rules the feet and the lymphatic system. Foot trouble, low immunity and sensitivity to medicines are possible. Good sleep, clean water and avoiding intoxicants protect your health.',
    ];

    const SIGN_TRAITS = [
        'bold and enterprising', 'stable and comfort-loving', 'versatile and communicative', 'caring and protective',
        'dignified and generous', 'practical and analytical', 'balanced and refined', 'intense and determined',
        'optimistic and principled', 'disciplined and ambitious', 'independent and progressive', 'gentle and intuitive',
    ];

    // Indexed by element: Fire, Earth, Air, Water
    const PROPERTY_BY_ELEMENT = [
        'You like a spacious, bright home and are likely to buy property through your own initiative rather than wait for it.',
        'Land, buildings and fixed assets come to you steadily, and you value a solid, well-furnished home.',
        'You like an open, social home and may change residence more than once or own property in more than one place.',
        'Home is your emotional base; property may come through family or inheritance, and a house near water or greenery suits you.',
    ];
    const CAREER_BY_ELEMENT = [
        'Fields that reward leadership and initiative suit you: management, government, defence, sports, politics and your own enterprise.',
        'Practical, result-oriented fields suit you: finance, banking, engineering, real estate, administration and agriculture.',
        'Fields of ideas and communication suit you: IT, media, law, teaching, consulting, trade and travel.',
        'Fields of care and insight suit you: medicine, healing, research, psychology, hospitality, shipping and the creative arts.',
    ];
    const ELEMENT_ACTS = [
        'In a fire sign it acts boldly, so its results come through initiative, leadership and courage.',
        'In an earth sign it acts practically, so its results come through patience, steady work and material security.',
        'In an air sign it acts through the mind, so its results come through ideas, communication and social contacts.',
        'In a water sign it acts through feelings, so its results come through intuition, care and emotional bonds.',
    ];

    const KARAKA = [
        'Sun' => 'The Sun stands for the soul, father, authority, government and self-confidence.',
        'Moon' => 'The Moon stands for the mind, mother, emotions, comfort and public life.',
        'Mars' => 'Mars stands for energy, courage, siblings, land and the drive to compete.',
        'Mercury' => 'Mercury stands for intellect, speech, business, learning and adaptability.',
        'Jupiter' => 'Jupiter stands for wisdom, wealth, children, teachers and good fortune.',
        'Venus' => 'Venus stands for love, marriage, beauty, art, luxury and comforts.',
        'Saturn' => 'Saturn stands for discipline, hard work, longevity, service and karmic lessons.',
        'Rahu' => 'Rahu stands for worldly desire, ambition, foreign links, technology and the unconventional.',
        'Ketu' => 'Ketu stands for detachment, spirituality, past-life skills, research and sudden change.',
    ];

    // What a planet in each house gives: [for a well-placed or benefic planet, for a malefic one]
    const HOUSE_RESULTS = [
        1 => ['brings good health, a pleasing personality, self-confidence and recognition for your own efforts.', 'makes you bold and independent but can bring impatience, ego clashes and minor health issues that need care.'],
        2 => ['supports savings, sweet speech, family happiness and good food.', 'can make speech sharp and savings uneven; care with words and family disputes keeps money steady.'],
        3 => ['gives skill in communication, short journeys, helpful siblings and success through your own initiative.', 'gives great courage and drive; you overcome rivals and succeed through bold effort.'],
        4 => ['brings peace at home, comforts, vehicles, property and the blessings of your mother.', 'can disturb domestic peace or bring changes of residence; patience at home and care of your mother\'s health are needed.'],
        5 => ['favours education, intelligence, creativity, romance and joy through children.', 'can bring worries about children or studies and impulsive decisions in love or speculation.'],
        6 => ['helps you serve others well and manage daily work, though health and small disputes need attention.', 'is strong for defeating enemies, clearing debts, winning competitions and recovering from illness.'],
        7 => ['brings a supportive spouse, harmony in partnerships and success in public dealings.', 'can create friction or delay in marriage and partnerships; mutual respect and patience are essential.'],
        8 => ['gives interest in research and hidden knowledge, and gains through inheritance or a partner\'s resources.', 'can bring sudden changes, obstacles and health concerns; caution with risk and regular check-ups are advised.'],
        9 => ['brings good fortune, respect for elders and teachers, long journeys, higher learning and religious merit.', 'can create differences with your father or teachers and test your beliefs, though effort brings fortune later.'],
        10 => ['favours career growth, promotions, respect from authorities and a good public reputation.', 'gives strong ambition and authority at work, with success through hard work and responsibility.'],
        11 => ['brings steady income, fulfilled wishes, influential friends and gains from many sources.', 'is excellent for gains and ambitions; income rises through effort and networking.'],
        12 => ['inclines you to charity, spiritual practice, foreign travel and comfortable spending.', 'can raise expenses and bring sleep trouble or isolation; foreign connections and spiritual practice bring relief.'],
    ];

    const HOUSE_FOCUS = [
        1 => 'self, body and personality', 2 => 'wealth, family and speech', 3 => 'courage, siblings and effort',
        4 => 'home, mother and comforts', 5 => 'children, learning and romance', 6 => 'health, debts and rivals',
        7 => 'marriage and partnerships', 8 => 'longevity and hidden matters', 9 => 'luck, father and dharma',
        10 => 'career and status', 11 => 'income and fulfilled wishes', 12 => 'expenses, foreign lands and moksha',
    ];

    private static function rev(float $x): float
    {
        $x = fmod($x, 360);
        return $x < 0 ? $x + 360 : $x;
    }

    // Shortest angular distance (0..180)
    private static function arc(float $a, float $b): float
    {
        return abs(self::rev($a - $b + 180) - 180);
    }

    private static function lordOf(int $sign): string
    {
        return AscendantHelper::LORDS[(($sign % 12) + 12) % 12];
    }

    /**
     * The whole report.
     */
    public static function generateReport(Carbon $birth, float $lat, float $lng, string $name, string $gender, string $place, bool $timeUnknown = false): array
    {
        $chart = KundliHelper::chart($birth, $lat, $lng);
        $lagna = $chart['lagna'];
        $planets = $chart['planets'];
        $L = $lagna['signIndex'];

        foreach ($planets as $n => &$p) {
            $p['name'] = $n;
            $p['abbr'] = self::ABBR[$n];
            if (in_array($n, ['Rahu', 'Ketu'])) {
                $p['retro'] = true; // the nodes always move backwards
            }
        }
        unset($p);

        $outer = self::outerPlanets($birth, $L);
        $all = $planets + $outer;

        $sun = $planets['Sun'];
        $moon = $planets['Moon'];

        // Sunrise / sunset of the birth date, in the birth place's own time
        $tz = $birth->getTimezone();
        $sunInfo = date_sun_info($birth->copy()->setTime(12, 0)->timestamp, $lat, $lng);
        $riseTs = is_int($sunInfo['sunrise'] ?? null) ? $sunInfo['sunrise'] : $birth->copy()->setTime(6, 0)->timestamp;
        $setTs = is_int($sunInfo['sunset'] ?? null) ? $sunInfo['sunset'] : $birth->copy()->setTime(18, 0)->timestamp;
        $fmt = fn (int $ts) => Carbon::createFromTimestamp($ts, $tz)->format('h:i A');

        // Vedic day runs from sunrise to sunrise
        $weekday = (int) $birth->format('w');
        if ($birth->timestamp < $riseTs) {
            $weekday = ($weekday + 6) % 7;
        }

        $panchang = self::panchang($sun, $moon, $lagna) + [
            'sunrise' => $fmt($riseTs),
            'sunset'  => $fmt($setTs),
            'weekday' => self::DAY_NAMES[$weekday],
            'dayLord' => self::DAY_LORDS[$weekday],
        ];

        $cusps = self::placidusCusps($birth, $lat, $lng);

        $report = [
            'name'        => $name,
            'gender'      => $gender,
            'birth'       => $birth,
            'place'       => $place,
            'lat'         => $lat,
            'lng'         => $lng,
            'timezone'    => 'GMT ' . $birth->format('P'),
            'timeUnknown' => $timeUnknown,
            'panchang'    => $panchang,
            'avakhada'    => self::avakhada($moon),
            'lagna'       => $lagna,
            'planets'     => $planets,
            'allPlanets'  => $all,
            'charts'      => self::charts($lagna, $all, $cusps),
            'vimshottari' => self::vimshottari($birth, $moon['lon']),
            'yogini'      => self::yogini($birth, $moon['lon']),
            'ashtakvarga' => self::ashtakvarga($L, $planets),
            'kp'          => self::kp($lagna, $all, $cusps, self::DAY_LORDS[$weekday]),
            'doshas'      => [
                'mangal'   => MangalDoshaHelper::report($birth, $lat, $lng),
                'kaalSarp' => DoshaHelper::kaalSarp($birth, $lat, $lng),
                'sadeSati' => DoshaHelper::sadeSati($birth),
            ],
        ];

        $shadbala = self::shadbala($birth, $lagna, $planets, $riseTs, $setTs, $weekday);
        $report['shadbala'] = $shadbala;
        $report['bhavabala'] = self::bhavabala($lagna, $planets, $shadbala, $cusps);
        $report['remedies'] = self::remedies($lagna, $moon, $planets);
        $report['predictions'] = self::predictions($lagna, $planets);
        $report['lucky'] = self::lucky($L);
        $report['yogas'] = self::yogas($lagna, $planets);

        return $report;
    }

    // ------------------------------------------------------------------
    // Panchang & Avakhada
    // ------------------------------------------------------------------

    private static function panchang(array $sun, array $moon, array $lagna): array
    {
        $elong = self::rev($moon['lon'] - $sun['lon']);
        $tithiNo = (int) floor($elong / 12) + 1;
        $paksha = $tithiNo <= 15 ? 'Shukla' : 'Krishna';
        $tithiName = match (true) {
            $tithiNo === 15 => 'Purnima',
            $tithiNo === 30 => 'Amavasya',
            default => TransitHelper::TITHIS[($tithiNo - 1) % 15],
        };

        // 60 half-tithis: Kintughna first, then 8 rounds of the 7 moving karanas, then the 3 fixed ones
        $k = (int) floor($elong / 6);
        $karana = match (true) {
            $k === 0 => 'Kintughna',
            $k >= 57 => [57 => 'Shakuni', 58 => 'Chatushpada', 59 => 'Naga'][$k],
            default => self::MOVING_KARANAS[($k - 1) % 7],
        };

        $yoga = self::YOGA_NAMES[(int) floor(self::rev($sun['lon'] + $moon['lon']) / (360 / 27)) + 1];

        return [
            'tithi'         => $paksha . ' ' . $tithiName,
            'karana'        => $karana,
            'yoga'          => $yoga,
            'nakshatra'     => $moon['nakshatra'],
            'nakshatraPada' => $moon['pada'],
            'nakshatraLord' => $moon['nakLord'],
            'ascendant'     => $lagna['sign'],
            'ascendantLord' => $lagna['lord'],
        ];
    }

    private static function avakhada(array $moon): array
    {
        $sign = $moon['signIndex'];
        $nak = $moon['nakshatra'];
        $inSign = $moon['inSign'];

        $varna = ['Kshatriya', 'Vaishya', 'Shudra', 'Brahmin'][$sign % 4];

        $vashya = match ($sign) {
            0, 1 => 'Chatushpada',
            2, 5, 6, 10 => 'Manav',
            3, 11 => 'Jalchar',
            4 => 'Vanchar',
            7 => 'Keet',
            8 => $inSign < 15 ? 'Manav' : 'Chatushpada',
            9 => $inSign < 15 ? 'Chatushpada' : 'Jalchar',
        };

        // Yunja: Revati to Mrigashirsha = Purva, Ardra to Jyeshtha = Madhya, Mula to Uttara Bhadrapada = Antya
        $n = $moon['nakIndex'];
        $yunja = ($n === 26 || $n <= 4) ? 'Purva' : ($n <= 17 ? 'Madhya' : 'Antya');

        $house = $moon['house'];
        $paya = in_array($house, [1, 6, 11]) ? 'Gold' : (in_array($house, [2, 5, 9]) ? 'Silver' : (in_array($house, [3, 7, 10]) ? 'Copper' : 'Iron'));

        return [
            'varna'        => $varna,
            'vashya'       => $vashya,
            'yoni'         => self::NAKSHATRA_YONI[$nak],
            'gan'          => self::NAKSHATRA_GANA[$nak],
            'nadi'         => self::NAKSHATRA_NADI[$nak],
            'sign'         => $moon['sign'],
            'signLord'     => $moon['lord'],
            'nakshatra'    => $nak,
            'charan'       => $moon['pada'],
            'tatva'        => $moon['element'],
            'nameAlphabet' => self::NAKSHATRA_SYLLABLES[$nak][$moon['pada'] - 1],
            'paya'         => $paya,
            'yunja'        => $yunja,
        ];
    }

    // ------------------------------------------------------------------
    // Outer planets from JPL orbital elements (valid 1800-2050, accurate to a few arc-minutes)
    // ------------------------------------------------------------------

    const JPL = [
        // a, e, I, L, long. perihelion, long. node  (value at J2000, change per century)
        'Earth'   => [[1.00000261, 0.00000562], [0.01671123, -0.00004392], [-0.00001531, -0.01294668], [100.46457166, 35999.37244981], [102.93768193, 0.32327364], [0.0, 0.0]],
        'Uranus'  => [[19.18916464, -0.00196176], [0.04725744, -0.00004397], [0.77263783, -0.00242939], [313.23810451, 428.48202785], [170.95427630, 0.40805281], [74.01692503, 0.04240589]],
        'Neptune' => [[30.06992276, 0.00026291], [0.00859048, 0.00005105], [1.77004347, 0.00035372], [-55.12002969, 218.45945325], [44.96476227, -0.32241464], [131.78422574, -0.00508664]],
        'Pluto'   => [[39.48211675, -0.00031596], [0.24882730, 0.00005170], [17.14001206, 0.00004818], [238.92903833, 145.20780515], [224.06891629, -0.04062942], [110.30393684, -0.01183482]],
    ];

    private static function helio(string $body, float $T): array
    {
        $el = array_map(fn ($x) => $x[0] + $x[1] * $T, self::JPL[$body]);
        [$a, $e, $I, $Lm, $peri, $node] = $el;
        $w = deg2rad($peri - $node);
        $M = deg2rad(self::rev($Lm - $peri));
        $E = $M;
        for ($k = 0; $k < 15; $k++) {
            $E -= ($E - $e * sin($E) - $M) / (1 - $e * cos($E));
        }
        $xp = $a * (cos($E) - $e);
        $yp = $a * sqrt(1 - $e * $e) * sin($E);
        $O = deg2rad($node);
        $i = deg2rad($I);

        return [
            (cos($w) * cos($O) - sin($w) * sin($O) * cos($i)) * $xp + (-sin($w) * cos($O) - cos($w) * sin($O) * cos($i)) * $yp,
            (cos($w) * sin($O) + sin($w) * cos($O) * cos($i)) * $xp + (-sin($w) * sin($O) + cos($w) * cos($O) * cos($i)) * $yp,
        ];
    }

    private static function outerLongitude(string $body, Carbon $dt): float
    {
        $T = ($dt->getTimestamp() / 86400 + 2440587.5 - 2451545.0) / 36525;
        [$xe, $ye] = self::helio('Earth', $T);
        [$xp, $yp] = self::helio($body, $T);
        $tropical = rad2deg(atan2($yp - $ye, $xp - $xe)) + 1.396971 * $T; // J2000 -> equinox of date

        return self::rev($tropical - TransitHelper::ayanamsa($dt));
    }

    private static function outerPlanets(Carbon $dt, int $lagnaSign): array
    {
        $out = [];
        foreach (['Uranus', 'Neptune', 'Pluto'] as $name) {
            $lon = self::outerLongitude($name, $dt);
            $next = self::outerLongitude($name, $dt->copy()->addDay());
            $p = KundliHelper::point($lon);
            $p['name'] = $name;
            $p['abbr'] = self::ABBR[$name];
            $p['house'] = ($p['signIndex'] - $lagnaSign + 12) % 12 + 1;
            $p['retro'] = self::rev($next - $lon + 180) - 180 < 0;
            $p['combust'] = false;
            $p['dignity'] = null;
            $out[$name] = $p;
        }

        return $out;
    }

    // ------------------------------------------------------------------
    // Houses: Placidus cusps (used for KP and Bhav Chalit)
    // ------------------------------------------------------------------

    private static function placidusCusps(Carbon $birth, float $lat, float $lng): array
    {
        $jd = $birth->getTimestamp() / 86400 + 2440587.5;
        $d = $jd - 2451545.0;
        $t = $d / 36525;
        $ramc = self::rev(280.46061837 + 360.98564736629 * $d + 0.000387933 * $t * $t + $lng);
        $eps = deg2rad(23.439291 - 0.0130042 * $t);
        $phi = deg2rad($lat);
        $ayan = TransitHelper::ayanamsa($birth);

        $asc = AscendantHelper::tropicalAscendant($birth, $lat, $lng);
        $mc = self::rev(rad2deg(atan2(sin(deg2rad($ramc)), cos(deg2rad($ramc)) * cos($eps))));

        $lonFromRa = fn ($ra) => self::rev(rad2deg(atan2(sin(deg2rad($ra)), cos(deg2rad($ra)) * cos($eps))));

        // House 11/12: RA = RAMC + f * SDA;  house 2/3: RA = RAMC + 180 - f * SNA
        $cusp = function (float $f, bool $above) use ($ramc, $eps, $phi, $lonFromRa) {
            $ra = $ramc + ($above ? 90 * $f : 180 - 90 * $f);
            for ($k = 0; $k < 30; $k++) {
                $lon = $lonFromRa($ra);
                $dec = asin(sin($eps) * sin(deg2rad($lon)));
                $x = -tan($phi) * tan($dec);
                if (abs($x) > 1) return null;
                $sda = rad2deg(acos($x));
                $ra = $above ? $ramc + $f * $sda : $ramc + 180 - $f * (180 - $sda);
            }
            return $lonFromRa($ra);
        };

        $c11 = $cusp(1 / 3, true);
        $c12 = $cusp(2 / 3, true);
        $c2 = $cusp(2 / 3, false);
        $c3 = $cusp(1 / 3, false);

        if (abs($lat) > 66 || in_array(null, [$c11, $c12, $c2, $c3], true)) {
            // Polar latitudes: fall back to equal houses
            $tropical = [];
            for ($h = 1; $h <= 12; $h++) {
                $tropical[$h] = self::rev($asc + ($h - 1) * 30);
            }
        } else {
            $tropical = [
                1 => $asc, 2 => $c2, 3 => $c3, 4 => self::rev($mc + 180), 5 => self::rev($c11 + 180), 6 => self::rev($c12 + 180),
                7 => self::rev($asc + 180), 8 => self::rev($c2 + 180), 9 => self::rev($c3 + 180), 10 => $mc, 11 => $c11, 12 => $c12,
            ];
        }

        return array_map(fn ($c) => self::rev($c - $ayan), $tropical);
    }

    private static function houseOf(float $lon, array $cusps): int
    {
        for ($h = 1; $h <= 12; $h++) {
            $start = $cusps[$h];
            $end = $cusps[$h % 12 + 1];
            $span = self::rev($end - $start);
            if (self::rev($lon - $start) < $span) {
                return $h;
            }
        }
        return 1;
    }

    // ------------------------------------------------------------------
    // Divisional charts (Parashara)
    // ------------------------------------------------------------------

    public static function vargaSign(int $div, float $lon): int
    {
        $s = (int) floor($lon / 30) % 12;
        $d = fmod($lon, 30);
        $odd = $s % 2 === 0; // Aries, Gemini ... are odd signs
        $mod = $s % 3;        // 0 movable, 1 fixed, 2 dual
        $part = fn (float $size) => min((int) floor($d / $size), (int) round(30 / $size) - 1);

        $sign = match ($div) {
            1 => $s,
            2 => $odd ? ($d < 15 ? 4 : 3) : ($d < 15 ? 3 : 4),
            3 => $s + 4 * $part(10),
            4 => $s + 3 * $part(7.5),
            7 => ($odd ? $s : $s + 6) + $part(30 / 7),
            9 => (int) floor($lon / (30 / 9)),
            10 => ($odd ? $s : $s + 8) + $part(3),
            12 => $s + $part(2.5),
            16 => [0, 4, 8][$mod] + $part(30 / 16),
            20 => [0, 8, 4][$mod] + $part(1.5),
            24 => ($odd ? 4 : 3) + $part(1.25),
            27 => (int) floor($lon / (30 / 27)),
            30 => $odd
                ? ($d < 5 ? 0 : ($d < 10 ? 10 : ($d < 18 ? 8 : ($d < 25 ? 2 : 6))))
                : ($d < 5 ? 1 : ($d < 12 ? 5 : ($d < 20 ? 11 : ($d < 25 ? 9 : 7)))),
            40 => ($odd ? 0 : 6) + $part(0.75),
            45 => [0, 4, 8][$mod] + $part(30 / 45),
            60 => $s + $part(0.5),
        };

        return $sign % 12;
    }

    // North Indian chart (300 x 300): outline of each house, its number spot and its label centre
    public const NORTH_SHAPE = [
        1 => [[150, 8], [221, 79], [150, 150], [79, 79]], 2 => [[8, 8], [150, 8], [79, 79]], 3 => [[8, 8], [79, 79], [8, 150]],
        4 => [[8, 150], [79, 79], [150, 150], [79, 221]], 5 => [[8, 150], [79, 221], [8, 292]], 6 => [[8, 292], [79, 221], [150, 292]],
        7 => [[150, 150], [221, 221], [150, 292], [79, 221]], 8 => [[150, 292], [221, 221], [292, 292]], 9 => [[292, 150], [221, 221], [292, 292]],
        10 => [[221, 79], [292, 150], [221, 221], [150, 150]], 11 => [[292, 8], [221, 79], [292, 150]], 12 => [[150, 8], [292, 8], [221, 79]],
    ];
    public const NORTH_NUM = [1 => [150, 136], 2 => [79, 68], 3 => [72, 79], 4 => [136, 150], 5 => [72, 221], 6 => [79, 232],
        7 => [150, 166], 8 => [221, 232], 9 => [228, 221], 10 => [164, 150], 11 => [228, 79], 12 => [221, 68]];
    public const NORTH_CENTER = [1 => [150, 70], 2 => [79, 26], 3 => [36, 79], 4 => [78, 150], 5 => [36, 221], 6 => [79, 274],
        7 => [150, 230], 8 => [221, 274], 9 => [264, 221], 10 => [222, 150], 11 => [264, 79], 12 => [221, 26]];

    /**
     * Places the label lines of one North chart house so they stay inside it and clear of its number.
     * Returns one [x, y, fontSize] per line; the font shrinks only when a line is too wide.
     */
    public static function northLayout(int $h, array $lines, float $base = 10.0): array
    {
        $shape = self::NORTH_SHAPE[$h];
        [$nx, $ny] = self::NORTH_NUM[$h];
        $cy = self::NORTH_CENTER[$h][1];
        $sideNum = abs($ny - $cy) < 10; // number sits beside the labels, not above or below them
        $n = count($lines);

        // Rough Inter semibold width of a line at 1px
        $width = function (string $t) {
            $w = 0;
            foreach (mb_str_split($t) as $c) {
                $w += match (true) {
                    $c === ' ', $c === '.' => 0.3, $c === '-' => 0.4, $c === '°' => 0.42,
                    ctype_upper($c) => 0.68, default => 0.6,
                };
            }
            return $w;
        };
        // Left and right edge of the house at height $y
        $span = function (float $y) use ($shape) {
            $xs = [];
            foreach ($shape as $i => [$x1, $y1]) {
                [$x2, $y2] = $shape[($i + 1) % count($shape)];
                if ($y1 != $y2 && $y >= min($y1, $y2) && $y <= max($y1, $y2)) $xs[] = $x1 + ($y - $y1) * ($x2 - $x1) / ($y2 - $y1);
            }
            return $xs ? [min($xs), max($xs)] : [0, 0];
        };

        $fs = $base;
        for ($pass = 0; $pass < 4; $pass++) {
            $half = $fs * 0.5;
            $lh = $fs * 1.3;
            $ys = array_column($shape, 1);
            $top = min($ys) + $half + 3;
            $bottom = max($ys) - $half - 3;
            if (!$sideNum) {
                if ($ny > $cy) $bottom = min($bottom, $ny - 6 - $half);
                else $top = max($top, $ny + 6 + $half);
            }
            $y0 = $cy - ($n - 1) * $lh / 2;
            $y0 = max($top, min($y0, $bottom - ($n - 1) * $lh));

            $out = [];
            $next = $fs;
            foreach ($lines as $i => $t) {
                $y = $y0 + $i * $lh;
                [$l1, $r1] = $span($y - $half);
                [$l2, $r2] = $span($y + $half);
                $l = max($l1, $l2) + 3;
                $r = min($r1, $r2) - 3;
                if ($sideNum && abs($y - $ny) < $half + 6) {
                    if ($nx < ($l + $r) / 2) $l = max($l, $nx + 8);
                    else $r = min($r, $nx - 8);
                }
                $need = $width($t);
                if ($need > 0) $next = min($next, max(0, $r - $l) / $need);
                $out[] = [round(($l + $r) / 2, 1), round($y, 1), $fs];
            }
            $next = max(6.0, min($base, $next));
            if (abs($next - $fs) < 0.05) break;
            $fs = $next;
        }

        return $out;
    }

    /**
     * Chart = ['ascSign' => 0..11, 'houses' => [1..12 => ['sign' => 0..11, 'planets' => [...]]]]
     * $entries: [['abbr', 'name', 'sign', 'deg' (in-sign or null), 'retro']]
     */
    private static function buildChart(int $ascSign, array $entries, ?array $houseBySign = null): array
    {
        $houses = [];
        for ($h = 1; $h <= 12; $h++) {
            $houses[$h] = ['sign' => ($ascSign + $h - 1) % 12, 'planets' => []];
        }
        foreach ($entries as $e) {
            $h = $e['house'] ?? (($e['sign'] - $ascSign + 12) % 12 + 1);
            $houses[$h]['planets'][] = $e;
        }

        return ['ascSign' => $ascSign, 'houses' => $houses];
    }

    private static function charts(array $lagna, array $all, array $cusps): array
    {
        $entry = fn (string $abbr, string $name, int $sign, ?float $deg, bool $retro) => compact('abbr', 'name', 'sign', 'deg', 'retro');

        // Lagna (D1) with degrees
        $d1 = [$entry('Asc', 'Ascendant', $lagna['signIndex'], $lagna['inSign'], false)];
        foreach ($all as $n => $p) {
            $d1[] = $entry($p['abbr'], $n, $p['signIndex'], $p['inSign'], (bool) $p['retro']);
        }

        $vargas = [];
        foreach (self::VARGAS as $key => $title) {
            $div = (int) substr($key, 1);
            $asc = self::vargaSign($div, $lagna['lon']);
            $list = [$entry('Asc', 'Ascendant', $asc, null, false)];
            foreach ($all as $n => $p) {
                $list[] = $entry($p['abbr'], $n, self::vargaSign($div, $p['lon']), null, (bool) $p['retro']);
            }
            $vargas[$key] = ['key' => $key, 'title' => $title] + self::buildChart($asc, $list);
        }

        // Bhav Chalit: planets placed by Placidus house; the chart shows house numbers
        $chalitList = [];
        foreach ($d1 as $e) {
            $lon = $e['abbr'] === 'Asc' ? $lagna['lon'] : $all[$e['name']]['lon'];
            $e['house'] = self::houseOf($lon, $cusps);
            $chalitList[] = $e;
        }

        // Live transits over the Lagna and the Moon sign
        $now = Carbon::now();
        $sid = TransitHelper::siderealAt($now);
        $later = TransitHelper::siderealAt($now->copy()->addHour());
        $transit = [];
        foreach ($sid as $n => $lon) {
            $retro = in_array($n, ['Rahu', 'Ketu']) || (!in_array($n, ['Sun', 'Moon']) && self::rev($later[$n] - $lon + 180) - 180 < 0);
            $transit[] = $entry(self::ABBR[$n], $n, (int) floor($lon / 30), fmod($lon, 30), $retro);
        }

        return [
            'lagna'        => self::buildChart($lagna['signIndex'], $d1),
            'navamsa'      => $vargas['D9'],
            'chalit'       => self::buildChart($lagna['signIndex'], $chalitList) + ['houseNumbers' => true],
            'transitLagna' => self::buildChart($lagna['signIndex'], $transit),
            'transitMoon'  => self::buildChart($all['Moon']['signIndex'], $transit),
            'transitDate'  => $now,
            'vargas'       => $vargas,
        ];
    }

    // ------------------------------------------------------------------
    // Dashas
    // ------------------------------------------------------------------

    /**
     * Nine Mahadashas. The first one starts before birth (its elapsed part), so every sub-level
     * can be divided exactly; the page shows anything before birth as "Birth".
     */
    private static function vimshottari(Carbon $birth, float $moonLon): array
    {
        $span = 360 / 27;
        $nak = (int) floor($moonLon / $span);
        $elapsed = fmod($moonLon, $span) / $span;
        $order = array_keys(DashaHelper::PLANET_YEARS);
        $first = $nak % 9;

        $cursor = $birth->timestamp - $elapsed * DashaHelper::PLANET_YEARS[$order[$first]] * DashaHelper::YEAR_SECONDS;
        $now = time();
        $list = [];
        for ($i = 0; $i < 9; $i++) {
            $planet = $order[($first + $i) % 9];
            $end = $cursor + DashaHelper::PLANET_YEARS[$planet] * DashaHelper::YEAR_SECONDS;
            $list[] = [
                'planet' => $planet,
                'years'  => DashaHelper::PLANET_YEARS[$planet],
                'start'  => (int) round($cursor),
                'end'    => (int) round($end),
                'active' => $now >= $cursor && $now < $end,
            ];
            $cursor = $end;
        }

        return $list;
    }

    private static function yogini(Carbon $birth, float $moonLon): array
    {
        $span = 360 / 27;
        $nak = (int) floor($moonLon / $span);
        $elapsed = fmod($moonLon, $span) / $span;
        // (nakshatra number + 3) mod 8 gives the first Yogini, 1 = Mangala ... 0 = Sankata
        $first = ($nak + 3) % 8;

        $cursor = $birth->timestamp - $elapsed * self::YOGINIS[$first]['years'] * DashaHelper::YEAR_SECONDS;
        $now = time();
        $list = [];
        for ($i = 0; $i < 25; $i++) {
            $y = self::YOGINIS[($first + $i) % 8];
            $end = $cursor + $y['years'] * DashaHelper::YEAR_SECONDS;
            $list[] = $y + ['start' => (int) round($cursor), 'end' => (int) round($end), 'active' => $now >= $cursor && $now < $end];
            $cursor = $end;
        }

        return $list;
    }

    // ------------------------------------------------------------------
    // Ashtakvarga
    // ------------------------------------------------------------------

    private static function ashtakvarga(int $lagnaSign, array $planets): array
    {
        $signs = ['Lagna' => $lagnaSign];
        foreach (self::PLANETS7 as $n) {
            $signs[$n] = $planets[$n]['signIndex'];
        }

        $bhinna = [];
        $bySign = [];
        foreach (self::BAV as $receiver => $table) {
            $bindus = array_fill(0, 12, 0);
            foreach ($table as $giver => $houses) {
                foreach ($houses as $h) {
                    $bindus[($signs[$giver] + $h - 1) % 12]++;
                }
            }
            $bySign[$receiver] = $bindus;
            // keyed by house from the Lagna
            for ($h = 1; $h <= 12; $h++) {
                $bhinna[$receiver][$h] = $bindus[($lagnaSign + $h - 1) % 12];
            }
        }

        $sav = [];
        for ($h = 1; $h <= 12; $h++) {
            $sav[$h] = array_sum(array_map(fn ($n) => $bhinna[$n][$h], self::PLANETS7));
        }

        // Ascendant first, like the report page
        $ordered = ['Ascendant' => $bhinna['Ascendant']];
        foreach (self::PLANETS7 as $n) {
            $ordered[$n] = $bhinna[$n];
        }

        return ['total' => array_sum($sav), 'sav' => $sav, 'bhinna' => $ordered];
    }

    // ------------------------------------------------------------------
    // KP
    // ------------------------------------------------------------------

    private static function starSub(float $lon): array
    {
        $order = array_keys(DashaHelper::PLANET_YEARS);
        $span = 360 / 27;
        $nak = (int) floor($lon / $span);
        $star = $order[$nak % 9];
        $inNak = fmod($lon, $span);
        $start = array_search($star, $order);
        $acc = 0;
        $sub = $star;
        for ($i = 0; $i < 9; $i++) {
            $c = $order[($start + $i) % 9];
            $acc += $span * DashaHelper::PLANET_YEARS[$c] / 120;
            if ($inNak < $acc) {
                $sub = $c;
                break;
            }
        }

        return [TransitHelper::NAKSHATRAS[$nak], $star, $sub];
    }

    private static function kp(array $lagna, array $all, array $cusps, string $dayLord): array
    {
        $cuspRows = [];
        foreach ($cusps as $h => $lon) {
            [$star, $starLord, $sub] = self::starSub($lon);
            $sign = (int) floor($lon / 30);
            $cuspRows[$h] = [
                'cusp' => $h, 'lon' => $lon, 'degree' => self::dms(fmod($lon, 30)),
                'sign' => TransitHelper::SIGNS[$sign], 'signLord' => self::lordOf($sign),
                'star' => $star, 'starLord' => $starLord, 'subLord' => $sub,
            ];
        }

        $planetRows = [];
        foreach ($all as $n => $p) {
            [$star, $starLord, $sub] = self::starSub($p['lon']);
            $planetRows[$n] = [
                'planet' => $n, 'cusp' => self::houseOf($p['lon'], $cusps), 'sign' => $p['sign'], 'signLord' => $p['lord'],
                'star' => $star, 'starLord' => $starLord, 'subLord' => $sub,
            ];
        }

        [, $ascStar, $ascSub] = self::starSub($lagna['lon']);
        [, $moonStar, $moonSub] = self::starSub($all['Moon']['lon']);

        return [
            'cusps'   => $cuspRows,
            'planets' => $planetRows,
            'ruling'  => [
                'ascSignLord'  => $lagna['lord'],
                'ascStarLord'  => $ascStar,
                'ascSubLord'   => $ascSub,
                'moonSignLord' => $all['Moon']['lord'],
                'moonStarLord' => $moonStar,
                'moonSubLord'  => $moonSub,
                'dayLord'      => $dayLord,
            ],
        ];
    }

    public static function dms(float $deg): string
    {
        $d = (int) floor($deg);
        $mFloat = ($deg - $d) * 60;
        $m = (int) floor($mFloat);
        $s = (int) floor(($mFloat - $m) * 60);

        return sprintf("%02d°%02d'%02d\"", $d, $m, $s);
    }

    // ------------------------------------------------------------------
    // Shadbala & Bhavabala
    // ------------------------------------------------------------------

    // Compound relationship of planet $p towards the lord of $sign: 2 great friend .. -2 great enemy
    private static function compound(string $p, string $lord, array $signs): int
    {
        $natural = in_array($lord, KundliHelper::FRIENDS[$p]) ? 1 : (in_array($lord, KundliHelper::ENEMIES[$p]) ? -1 : 0);
        $dist = ($signs[$lord] - $signs[$p] + 12) % 12 + 1;
        $temporal = in_array($dist, [2, 3, 4, 10, 11, 12]) ? 1 : -1;

        return $natural + $temporal;
    }

    private static function aspectValue(string $giver, int $dist): float
    {
        // $dist = house counted from the giver to the receiver (1..12)
        $full = ['Mars' => [4, 8], 'Jupiter' => [5, 9], 'Saturn' => [3, 10]];
        if ($dist === 7 || in_array($dist, $full[$giver] ?? [])) return 60;
        return match ($dist) { 3, 10 => 15, 5, 9 => 30, 4, 8 => 45, default => 0 };
    }

    private static function shadbala(Carbon $birth, array $lagna, array $planets, int $riseTs, int $setTs, int $weekday): array
    {
        $signs = [];
        foreach (self::PLANETS7 as $n) {
            $signs[$n] = $planets[$n]['signIndex'];
        }
        $elong = self::rev($planets['Moon']['lon'] - $planets['Sun']['lon']);
        $waxing = $elong < 180;
        $moonPhase = self::arc($planets['Moon']['lon'], $planets['Sun']['lon']); // 0..180
        $benefics = ['Jupiter', 'Venus', 'Mercury'];
        if ($waxing) $benefics[] = 'Moon';

        $ayan = TransitHelper::ayanamsa($birth);
        $epsilon = 23.44;
        $next = TransitHelper::siderealAt($birth->copy()->addDay());

        $ts = $birth->timestamp;
        $isDay = $ts >= $riseTs && $ts < $setTs;
        $noon = ($riseTs + $setTs) / 2;
        // hours from local midnight (0 at midnight, 12 at noon)
        $fromMidnight = 12 - abs($ts - $noon) / 3600;
        $fromMidnight = max(0, min(12, $fromMidnight));

        // Tribhaga lord: day thirds Mercury/Sun/Saturn, night thirds Moon/Venus/Mars
        if ($isDay) {
            $third = min(2, (int) floor(($ts - $riseTs) / (($setTs - $riseTs) / 3)));
            $tribhaga = ['Mercury', 'Sun', 'Saturn'][$third];
        } else {
            $nightStart = $ts >= $setTs ? $setTs : $setTs - 86400;
            $nightLen = 86400 - ($setTs - $riseTs);
            $third = max(0, min(2, (int) floor(($ts - $nightStart) / ($nightLen / 3))));
            $tribhaga = ['Moon', 'Venus', 'Mars'][$third];
        }

        // Hora lord: hours since sunrise, counted in the Chaldean order from the day lord
        $chaldean = ['Sun', 'Venus', 'Mercury', 'Moon', 'Saturn', 'Jupiter', 'Mars'];
        $sinceRise = ($ts - $riseTs + 86400) % 86400;
        $horaLord = $chaldean[(array_search(self::DAY_LORDS[$weekday], $chaldean) + (int) floor($sinceRise / 3600)) % 7];

        $mean = ['Mars' => 0.524, 'Mercury' => 0.986, 'Jupiter' => 0.083, 'Venus' => 0.986, 'Saturn' => 0.034];
        $digStrong = ['Sun' => 10, 'Mars' => 10, 'Jupiter' => 1, 'Mercury' => 1, 'Moon' => 4, 'Venus' => 4, 'Saturn' => 7];

        $rows = [];
        foreach (self::PLANETS7 as $n) {
            $p = $planets[$n];
            $lon = $p['lon'];

            // Sthana bala
            $uchcha = self::arc($lon, self::EXALT_DEG[$n] + 180) / 3;
            $sapta = 0;
            foreach ([1, 2, 3, 7, 9, 12, 30] as $div) {
                $vs = self::vargaSign($div, $lon);
                $lord = self::lordOf($vs);
                if ($div === 1 && (KundliHelper::MOOLTRIKONA[$n] ?? -1) === $vs) {
                    $sapta += 45;
                } elseif ($lord === $n) {
                    $sapta += 30;
                } else {
                    $sapta += [2 => 22.5, 1 => 15, 0 => 7.5, -1 => 3.75, -2 => 1.875][self::compound($n, $lord, $signs)];
                }
            }
            $evenRasi = $p['signIndex'] % 2 === 1;
            $evenNav = self::vargaSign(9, $lon) % 2 === 1;
            $female = in_array($n, ['Moon', 'Venus']);
            $oja = ($female === $evenRasi ? 15 : 0) + ($female === $evenNav ? 15 : 0);
            $kendradi = in_array($p['house'], [1, 4, 7, 10]) ? 60 : (in_array($p['house'], [2, 5, 8, 11]) ? 30 : 15);
            $dec = (int) floor($p['inSign'] / 10);
            $drekkana = (in_array($n, ['Sun', 'Mars', 'Jupiter']) && $dec === 0) || (in_array($n, ['Mercury', 'Saturn']) && $dec === 1) || ($female && $dec === 2) ? 15 : 0;
            $sthana = $uchcha + $sapta + $oja + $kendradi + $drekkana;

            // Dig bala: distance from the house opposite to where the planet is strongest
            $weakPoint = self::rev($lagna['lon'] + ($digStrong[$n] - 1) * 30 + 180);
            $dig = self::arc($lon, $weakPoint) / 3;

            // Kala bala
            $nathonnatha = $n === 'Mercury' ? 60 : (in_array($n, ['Sun', 'Jupiter', 'Venus']) ? $fromMidnight * 5 : 60 - $fromMidnight * 5);
            $paksha = in_array($n, $benefics) ? $moonPhase / 3 : 60 - $moonPhase / 3;
            if ($n === 'Moon') $paksha *= 2;
            $tri = ($n === 'Jupiter' || $n === $tribhaga) ? 60 : 0;
            $vara = $n === self::DAY_LORDS[$weekday] ? 45 : 0;
            $hora = $n === $horaLord ? 60 : 0;
            $decl = rad2deg(asin(sin(deg2rad($epsilon)) * sin(deg2rad($lon + $ayan))));
            $ayana = match ($n) {
                'Moon', 'Saturn' => 60 * ($epsilon - $decl) / (2 * $epsilon),
                'Mercury' => 60 * ($epsilon + abs($decl)) / (2 * $epsilon),
                default => 60 * ($epsilon + $decl) / (2 * $epsilon),
            };
            if ($n === 'Sun') $ayana *= 2;
            $kala = $nathonnatha + $paksha + $tri + $vara + $hora + $ayana;

            // Chesta bala
            if ($n === 'Sun') {
                $chesta = $ayana / 2;
            } elseif ($n === 'Moon') {
                $chesta = $moonPhase / 3;
            } else {
                $speed = self::rev($next[$n] - $lon + 180) - 180;
                $chesta = max(0, min(60, 30 * (2 - $speed / $mean[$n])));
            }

            // Drik bala: benefic aspects minus malefic aspects, a quarter of the total
            $drik = 0;
            foreach (self::PLANETS7 as $g) {
                if ($g === $n) continue;
                $dist = ($signs[$n] - $signs[$g] + 12) % 12 + 1;
                $v = self::aspectValue($g, $dist);
                $drik += in_array($g, $benefics) ? $v : -$v;
            }
            $drik /= 4;

            $total = $sthana + $dig + $kala + $chesta + self::NAISARGIKA[$n] + $drik;
            $rows[$n] = [
                'sthana' => $sthana, 'dig' => $dig, 'kala' => $kala, 'chesta' => $chesta,
                'naisargika' => self::NAISARGIKA[$n], 'drik' => $drik, 'total' => $total,
                'rupa' => $total / 60, 'required' => self::REQUIRED_BALA[$n], 'ratio' => $total / self::REQUIRED_BALA[$n],
            ];
        }

        $byTotal = array_keys($rows);
        usort($byTotal, fn ($a, $b) => $rows[$b]['total'] <=> $rows[$a]['total']);
        $byRatio = array_keys($rows);
        usort($byRatio, fn ($a, $b) => $rows[$b]['ratio'] <=> $rows[$a]['ratio']);
        foreach ($rows as $n => &$r) {
            $r['rank'] = array_search($n, $byTotal) + 1;
            $r['relativeRank'] = array_search($n, $byRatio) + 1;
        }
        unset($r);

        return $rows;
    }

    private static function bhavabala(array $lagna, array $planets, array $shadbala, array $cusps): array
    {
        $L = $lagna['signIndex'];
        $elong = self::rev($planets['Moon']['lon'] - $planets['Sun']['lon']);
        $benefics = ['Jupiter', 'Venus', 'Mercury'];
        if ($elong < 180) $benefics[] = 'Moon';

        $rows = [];
        for ($h = 1; $h <= 12; $h++) {
            $cusp = $cusps[$h];
            $sign = (int) floor($cusp / 30);
            $inSign = fmod($cusp, 30);

            $adhipati = $shadbala[self::lordOf($sign)]['total'];

            // Bhava dig bala: where the sign of the house is naturally strongest
            $type = match ($sign) {
                2, 5, 6, 10 => 1,
                3, 11 => 4,
                0, 1, 4 => 10,
                7 => 7,
                8 => $inSign < 15 ? 1 : 10,
                9 => $inSign < 15 ? 10 : 4,
            };
            $away = min(abs($h - $type), 12 - abs($h - $type));
            $dig = (6 - $away) * 10;

            $drishti = 0;
            foreach (self::PLANETS7 as $g) {
                $dist = ($sign - $planets[$g]['signIndex'] + 12) % 12 + 1;
                $v = self::aspectValue($g, $dist);
                $drishti += in_array($g, $benefics) ? $v : -$v;
            }
            $drishti /= 4;

            $total = $adhipati + $dig + $drishti;
            $rows[$h] = ['total' => $total, 'rupa' => $total / 60, 'ratio' => $total / 420];
        }

        $order = array_keys($rows);
        usort($order, fn ($a, $b) => $rows[$b]['total'] <=> $rows[$a]['total']);
        foreach ($rows as $h => &$r) {
            $r['rank'] = array_search($h, $order) + 1;
        }
        unset($r);

        return $rows;
    }

    // ------------------------------------------------------------------
    // Remedies, predictions, lucky factors, yogas
    // ------------------------------------------------------------------

    private static function remedies(array $lagna, array $moon, array $planets): array
    {
        $L = $lagna['signIndex'];
        $mukhis = [];
        foreach (self::RUDRAKSHA_BY_LORD[$moon['nakLord']] as $m) {
            $mukhis[$m] = self::RUDRAKSHA[$m] + ['mukhi' => $m];
        }

        $sign = $lagna['sign'];
        $hindi = $lagna['hindi'];
        $stone = function (string $kind, int $house) use ($L, $sign, $hindi) {
            $lord = self::lordOf($L + $house - 1);
            $text = match ($kind) {
                'life' => "A life stone is the gem of the lagna lord, which you can wear throughout your life. It supports everything that makes up your self-image: health, wealth, education, career, spouse and intellect. The lord of the {$sign} ascendant is {$lord}, so the life stone for {$sign} lagna ({$hindi}) is " . self::GEMS[$lord]['gem'] . '.',
                'lucky' => "A lucky stone is worn to improve luck and open new doors to success. It strengthens the lord of the 5th house of purva punya (past merit), which for the {$sign} ascendant is {$lord}, so your lucky gemstone is " . self::GEMS[$lord]['gem'] . '.',
                'fortune' => "A bhagya (fortune) stone is chosen from the lord of the 9th house. It helps you attract fortune when you need it most and supports prosperity in personal and professional life. For the {$sign} ascendant the 9th lord is {$lord}, so your fortune stone is " . self::GEMS[$lord]['gem'] . '.',
            };
            $title = ['life' => "Life Stone for {$sign} ({$hindi} Lagna)", 'lucky' => "Lucky Gemstone for {$sign} ({$hindi})", 'fortune' => "Fortune Stone for {$sign} ({$hindi})"][$kind];

            return ['title' => $title, 'lord' => $lord, 'text' => $text] + self::GEMS[$lord];
        };

        return [
            'nakshatra'   => $moon['nakshatra'],
            'nakLord'     => $moon['nakLord'],
            'mukhis'      => $mukhis,
            'precautions' => self::RUDRAKSHA_PRECAUTIONS,
            'gemstones'   => [
                'life'    => $stone('life', 1),
                'lucky'   => $stone('lucky', 5),
                'fortune' => $stone('fortune', 9),
            ],
        ];
    }

    private static function placementNote(int $h): string
    {
        return match (true) {
            in_array($h, [1, 4, 7, 10]) => 'a strong angular placement that gives steady, visible results',
            in_array($h, [5, 9]) => 'a fortunate placement that brings support and luck',
            in_array($h, [2, 11]) => 'a wealth-giving placement that supports gains',
            $h === 3 => 'a placement of effort, where results grow with your own initiative',
            default => 'a hidden or testing placement, so results come after effort and some delay',
        };
    }

    private static function dignityLine(string $n, array $p): string
    {
        $sign = $p['sign'];
        $lord = $p['lord'];
        $line = match ($p['dignity'] ?? null) {
            'Exalted' => "{$n} is exalted in {$sign}, its strongest position, so its results are powerful and largely positive.",
            'Debilitated' => "{$n} is debilitated in {$sign}, its weakest sign, so its matters need patience, remedies and conscious effort.",
            'Mooltrikona' => "{$n} is in its mooltrikona sign {$sign}, where it works with great strength and clarity.",
            'Own sign' => "{$n} is in its own sign {$sign}, comfortable and dependable, giving reliable results.",
            'Friendly' => "{$n} sits in {$sign}, the sign of its friend {$lord}, so it works with ease and support.",
            'Enemy' => "{$n} sits in {$sign}, ruled by its enemy {$lord}, so its results come after effort and some resistance.",
            'Neutral' => "{$n} sits in {$sign}, ruled by {$lord}, a neutral sign for it, giving mixed but manageable results.",
            default => "{$n} acts like the lord of the sign it occupies, so it takes on the colour of {$lord}, the ruler of {$sign}.",
        };
        if (!empty($p['retro']) && !in_array($n, ['Rahu', 'Ketu'])) {
            $line .= ' Being retrograde, its results turn inward and may repeat or come with delay before they settle.';
        }
        if (!empty($p['combust'])) {
            $line .= ' Being close to the Sun (combust), some of its outer results can stay hidden or arrive late.';
        }

        return $line;
    }

    private static function isWellPlaced(string $n, array $p): bool
    {
        if (in_array($p['dignity'] ?? null, ['Exalted', 'Mooltrikona', 'Own sign'])) return true;
        if (in_array($p['dignity'] ?? null, ['Debilitated'])) return false;
        return in_array($n, ['Jupiter', 'Venus', 'Mercury', 'Moon']);
    }

    private static function predictions(array $lagna, array $planets): array
    {
        $L = $lagna['signIndex'];
        $ord = KundliHelper::ORDINALS;
        $houseLord = fn (int $h) => self::lordOf($L + $h - 1);
        $signName = fn (int $h) => TransitHelper::SIGNS[($L + $h - 1) % 12];
        $elementOf = fn (int $h) => ($L + $h - 1) % 4;
        $placed = fn (string $planet) => $planets[$planet]['house'];

        // General predictions
        $l4 = $houseLord(4);
        $l2 = $houseLord(2);
        $l11 = $houseLord(11);
        $l10 = $houseLord(10);
        $l7 = $houseLord(7);
        $jup = $planets['Jupiter'];
        $ven = $planets['Venus'];

        $general = [
            'PHYSICAL' => self::PHYSICAL[$L] . ' ' . self::dignityLine($lagna['lord'], $planets[$lagna['lord']]) . " As your lagna lord, it shapes your vitality and the way others see you.",
            'PROPERTY' => "The 4th house rules home, land, vehicles and inner comfort, and in your chart it falls in {$signName(4)}. " . self::PROPERTY_BY_ELEMENT[$elementOf(4)] . " Its lord {$l4} sits in the {$ord[$placed($l4)]} house, " . self::placementNote($placed($l4)) . '.',
            'FINANCE' => "Your 2nd house of savings falls in {$signName(2)} with its lord {$l2} in the {$ord[$placed($l2)]} house, and your 11th house of income falls in {$signName(11)} with its lord {$l11} in the {$ord[$placed($l11)]} house. Jupiter, the natural giver of wealth, is in the {$ord[$jup['house']]} house in {$jup['sign']}, " . self::placementNote($jup['house']) . '.',
            'HEALTH' => self::HEALTH[$L] . ' ' . "Your 6th house of health falls in {$signName(6)}, ruled by {$houseLord(6)}.",
            'CAREER' => "Your 10th house of career falls in {$signName(10)}, a " . self::SIGN_TRAITS[($L + 9) % 12] . ' sign. ' . self::CAREER_BY_ELEMENT[$elementOf(10)] . " Its lord {$l10} sits in the {$ord[$placed($l10)]} house, " . self::placementNote($placed($l10)) . '.',
            'FAMILY' => "Your 7th house of marriage falls in {$signName(7)}, so you are drawn to a " . self::SIGN_TRAITS[($L + 6) % 12] . " partner. Its lord {$l7} sits in the {$ord[$placed($l7)]} house, " . self::placementNote($placed($l7)) . ". Venus, the significator of love and marriage, is in {$ven['sign']} in the {$ord[$ven['house']]} house.",
        ];

        // Planet by planet
        $planetText = [];
        $dashaText = [];
        foreach (self::PLANETS9 as $n) {
            $p = $planets[$n];
            $h = $p['house'];
            $good = self::isWellPlaced($n, $p);
            $houseText = self::HOUSE_RESULTS[$h][$good ? 0 : 1];
            $ruled = [];
            for ($i = 1; $i <= 12; $i++) {
                if ($houseLord($i) === $n) $ruled[] = $ord[$i];
            }
            $rules = $ruled ? ' It rules your ' . implode(' and ', $ruled) . ' house' . (count($ruled) > 1 ? 's' : '') . '.' : '';

            $planetText[$n] = self::KARAKA[$n] . " In your chart it is in the {$ord[$h]} house ({$p['sign']}), where it {$houseText}{$rules} " . self::dignityLine($n, $p);

            $dashaText[$n] = [
                'house' => "The planet {$n} is in the {$ord[$h]} house of your Kundli, the house of " . self::HOUSE_FOCUS[$h] . ". During its period this placement {$houseText}" . ($ruled ? " As the lord of your " . implode(' and ', $ruled) . ' house' . (count($ruled) > 1 ? 's' : '') . ', it also brings those matters into focus.' : ''),
                'sign'  => "{$n} is placed in {$p['sign']} ({$p['hindi']}) in your Kundli. " . self::dignityLine($n, $p) . ' ' . self::ELEMENT_ACTS[$p['signIndex'] % 4],
                'short' => trim(strtok(DashaHelper::PROFILES[$n]['career'], '.') . '.') . " With {$n} in your {$ord[$h]} house, this period " . $houseText,
            ];
        }

        return ['general' => $general, 'planets' => $planetText, 'dasha' => $dashaText];
    }

    private static function lucky(int $L): array
    {
        $lords = [];
        foreach ([1, 9, 5] as $h) {
            $lords[] = self::lordOf($L + $h - 1);
        }
        $lords = array_values(array_unique($lords));
        $days = array_map(fn ($l) => KundliHelper::PLANET_LUCK[$l]['day'], $lords);

        $bad = null;
        foreach ([8, 6, 12] as $h) {
            $l = self::lordOf($L + $h - 1);
            if (!in_array($l, $lords)) {
                $bad = KundliHelper::PLANET_LUCK[$l]['day'];
                break;
            }
        }

        return [
            'days'   => implode(' & ', array_slice($days, 0, 2)),
            'badDay' => $bad ?? '—',
            'colors' => implode(', ', array_unique(array_merge(...array_map(fn ($l) => explode(', ', KundliHelper::PLANET_LUCK[$l]['colour']), array_slice($lords, 0, 2))))),
            'number' => KundliHelper::PLANET_LUCK[$lords[0]]['number'],
        ];
    }

    private static function yogas(array $lagna, array $planets): array
    {
        $s = fn ($n) => $planets[$n]['signIndex'];
        $from = fn ($a, $b) => ($s($b) - $s($a) + 12) % 12 + 1; // house of $b counted from $a
        $house = fn ($n) => $planets[$n]['house'];
        $strong = fn ($n) => in_array($planets[$n]['dignity'], ['Exalted', 'Own sign', 'Mooltrikona']);
        $benefics = ['Jupiter', 'Venus', 'Mercury'];
        $yogas = [];

        if ($s('Sun') === $s('Mercury')) {
            $yogas[] = ['name' => 'Budhaditya Yoga', 'desc' => 'The Sun and Mercury are together in ' . $planets['Sun']['sign'] . ', giving a sharp intellect, good speech and success in learning and administration.'];
        }
        if (in_array($from('Moon', 'Jupiter'), [1, 4, 7, 10])) {
            $yogas[] = ['name' => 'Gajakesari Yoga', 'desc' => 'Jupiter is in a kendra from the Moon, which brings respect, wisdom, lasting reputation and protection in difficult times.'];
        }
        if ($s('Moon') === $s('Mars')) {
            $yogas[] = ['name' => 'Chandra-Mangal Yoga', 'desc' => 'The Moon and Mars are together, giving drive to earn, business sense and the courage to take decisions.'];
        }
        foreach (['Mars' => 'Ruchaka', 'Mercury' => 'Bhadra', 'Jupiter' => 'Hamsa', 'Venus' => 'Malavya', 'Saturn' => 'Sasa'] as $n => $y) {
            if ($strong($n) && in_array($house($n), [1, 4, 7, 10])) {
                $yogas[] = ['name' => "{$y} Yoga", 'desc' => "{$n} is strong in its own or exaltation sign in a kendra house, forming one of the five Mahapurusha yogas that raise a person above the ordinary."];
            }
        }
        foreach ($benefics as $b) {
            if ($house($b) === 10 || $from('Moon', $b) === 10) {
                $yogas[] = ['name' => 'Amala Yoga', 'desc' => "{$b}, a natural benefic, is in the 10th house from the Lagna or the Moon, giving a clean reputation and lasting good name through work."];
                break;
            }
        }
        $adhi = count(array_filter($benefics, fn ($b) => in_array($from('Moon', $b), [6, 7, 8])));
        if ($adhi >= 2) {
            $yogas[] = ['name' => 'Adhi Yoga', 'desc' => 'Benefic planets occupy the 6th, 7th and 8th houses from the Moon, bringing good manners, trustworthy friends and victory over rivals.'];
        }
        $vasu = count(array_filter($benefics, fn ($b) => in_array($from('Moon', $b), [3, 6, 10, 11])));
        if ($vasu >= 2) {
            $yogas[] = ['name' => 'Vasumati Yoga', 'desc' => 'Benefics occupy the growth houses (3, 6, 10, 11) from the Moon, which helps wealth grow steadily over life.'];
        }
        $l9 = self::lordOf($lagna['signIndex'] + 8);
        if ($strong($l9) && in_array($house($l9), [1, 4, 5, 7, 9, 10]) && $planets[$lagna['lord']]['dignity'] !== 'Debilitated') {
            $yogas[] = ['name' => 'Lakshmi Yoga', 'desc' => "The 9th lord {$l9} is strong in a kendra or trikona, a classic combination for wealth, grace and good fortune."];
        }
        $around = array_filter(['Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn'], fn ($n) => in_array($from('Moon', $n), [2, 12]) || $s($n) === $s('Moon'));
        if (!$around && !in_array($house('Moon'), [1, 4, 7, 10])) {
            $yogas[] = ['name' => 'Kemadruma Yoga', 'desc' => 'No planet stands next to the Moon, which can bring periods of loneliness or uneven fortune. Worship of the Moon and Lord Shiva on Mondays is the usual remedy.'];
        }

        return $yogas;
    }
}
