<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyHoroscope;
use Carbon\Carbon;

class HoroscopeController extends Controller
{
    // URL slug => tab ka naam, DB ka period, page title, heading ka aakhri shabd,
    // landing page ka intro aur "what moves the sky" wala paragraph
    const PERIODS = [
        'daily'    => ['tab' => 'Daily', 'db' => 'Today', 'title' => "Today's Horoscope", 'suffix' => 'Today',
            'intro' => 'Read what the stars hold for you today in love, career, health and money, written from real planetary transits as per Vedic astrology.',
            'sky'   => 'A single day is shaped mostly by the Moon. It changes nakshatra roughly once a day and moves to a new sign about every two and a quarter days, so the house it lights up for your rashi keeps shifting. We pair the Moon\'s position with the day\'s tithi and the slower planets around it to tell you where your energy is likely to flow today.'],
        'tomorrow' => ['tab' => 'Tomorrow', 'db' => 'Tomorrow', 'title' => "Tomorrow's Horoscope", 'suffix' => 'Tomorrow',
            'intro' => 'Plan ahead with tomorrow\'s prediction for your rashi and know what the Moon\'s next move means for your day.',
            'sky'   => 'Tomorrow rarely feels like a copy of today, because the Moon will have moved on to a new nakshatra and sometimes a new sign. Reading a day ahead lets you move an important call, a purchase or a difficult conversation to the hours that suit you better.'],
        'weekly'   => ['tab' => 'Weekly', 'db' => 'Week', 'title' => 'Weekly Horoscope', 'suffix' => 'This Week',
            'intro' => 'Every week carries a different energy. See how this week\'s planetary movements shape your personal life, money, health and love.',
            'sky'   => 'Across seven days the Moon passes through about three signs, so your week naturally has stronger and quieter days. Mercury, Venus or the Sun may also change sign within the week. The weekly reading maps those shifts to weekdays so you know when to push and when to rest.'],
        'monthly'  => ['tab' => 'Monthly', 'db' => 'Month', 'title' => 'Monthly Horoscope', 'suffix' => 'This Month',
            'intro' => 'Your month at a glance: career, finance, relationships and health, built around this month\'s sign changes and moon phases.',
            'sky'   => 'A month contains one full lunar cycle, with a new moon (Amavasya) and a full moon (Purnima), and the Sun moves into a new sign once. Mercury, Venus and Mars often change sign too. The monthly reading is built around those dates, so you can see which part of the month favours which area of life.'],
        'yearly'   => ['tab' => 'Yearly', 'db' => 'Year', 'title' => 'Yearly Horoscope', 'suffix' => 'This Year',
            'intro' => 'The big picture for your year, guided by the movements of Jupiter, Saturn, Rahu and Ketu.',
            'sky'   => 'The tone of a year is set by the slow planets. Jupiter spends about a year in one sign, Saturn about two and a half years, and Rahu and Ketu about eighteen months. The houses they occupy from your rashi decide the long themes of growth, responsibility and change for the year.'],
    ];

    // Zodiac Signs Metadata (Hindi name, dates, icons, image)
    const ZODIAC = [
        'Aries'       => ['hindi' => 'Mesh', 'icon' => '♈', 'dates' => 'Mar 21 – Apr 19', 'img' => 'horoscope-01.avif'],
        'Taurus'      => ['hindi' => 'Vrishabh', 'icon' => '♉', 'dates' => 'Apr 20 – May 20', 'img' => 'horoscope-02.avif'],
        'Gemini'      => ['hindi' => 'Mithun', 'icon' => '♊', 'dates' => 'May 21 – Jun 20', 'img' => 'horoscope-03.avif'],
        'Cancer'      => ['hindi' => 'Kark', 'icon' => '♋', 'dates' => 'Jun 21 – Jul 22', 'img' => 'horoscope-04.avif'],
        'Leo'         => ['hindi' => 'Singh', 'icon' => '♌', 'dates' => 'Jul 23 – Aug 22', 'img' => 'horoscope-05.avif'],
        'Virgo'       => ['hindi' => 'Kanya', 'icon' => '♍', 'dates' => 'Aug 23 – Sep 22', 'img' => 'horoscope-06.avif'],
        'Libra'       => ['hindi' => 'Tula', 'icon' => '♎', 'dates' => 'Sep 23 – Oct 22', 'img' => 'horoscope-07.avif'],
        'Scorpio'     => ['hindi' => 'Vrishchik', 'icon' => '♏', 'dates' => 'Oct 23 – Nov 21', 'img' => 'horoscope-08.avif'],
        'Sagittarius' => ['hindi' => 'Dhanu', 'icon' => '♐', 'dates' => 'Nov 22 – Dec 21', 'img' => 'horoscope-09.avif'],
        'Capricorn'   => ['hindi' => 'Makar', 'icon' => '♑', 'dates' => 'Dec 22 – Jan 19', 'img' => 'horoscope-10.avif'],
        'Aquarius'    => ['hindi' => 'Kumbh', 'icon' => '♒', 'dates' => 'Jan 20 – Feb 18', 'img' => 'horoscope-11.avif'],
        'Pisces'      => ['hindi' => 'Meen', 'icon' => '♓', 'dates' => 'Feb 19 – Mar 20', 'img' => 'horoscope-12.avif'],
    ];

    // /horoscope/daily-horoscope : sirf rashi chunne ka page
    public function landing($period)
    {
        return view('horoscope-landing', [
            'period'     => $period,
            'periods'    => self::PERIODS,
            'zodiacMeta' => self::ZODIAC,
        ]);
    }

    // Purane URL (/horoscope, /horoscope/aries) naye URL par bhej do
    public function legacy(Request $request, $sign = null)
    {
        $period = strtolower($request->query('period', 'daily'));
        if (!array_key_exists($period, self::PERIODS)) {
            $period = 'daily';
        }

        $sign = $sign ?? $request->query('sign');

        return $sign
            ? redirect()->route('horoscope.detail', ['period' => $period, 'sign' => strtolower($sign)])
            : redirect()->route('horoscope.landing', ['period' => $period]);
    }

    // /horoscope/daily-horoscope/aries : ek rashi ka poora horoscope
    public function detail($period, $sign)
    {
        $selectedSign = ucfirst(strtolower($sign));
        $zodiacMeta = self::ZODIAC;

        // Galat sign aaye toh rashi chunne wale page par bhej do
        if (!array_key_exists($selectedSign, $zodiacMeta)) {
            return redirect()->route('horoscope.landing', ['period' => $period]);
        }

        // Latest date fetch karo
        $today = Carbon::today('Asia/Kolkata')->toDateString();
        $latestDate = DailyHoroscope::where('horoscope_date', $today)->exists()
            ? $today
            : DailyHoroscope::max('horoscope_date');

        // Is sign ke 5 periods ka actual data fetch karo
        $horoscopes = DailyHoroscope::where('sign_name', $selectedSign)
            ->where('horoscope_date', $latestDate)
            ->get();

        $periodData = [];
        $fallback = $horoscopes->first();

        foreach (self::PERIODS as $p) {
            $record = $horoscopes->firstWhere('period', $p['db']) ?? $fallback;

            $periodData[$p['tab']] = [
                'reading'         => $record->reading ?? 'No reading available for this period.',
                'short_reading'   => \Illuminate\Support\Str::limit($record->reading ?? '', 220),
                'mood'            => $record->mood ?? 'Calm',
                'lucky_number'    => $record->lucky_number ?? '7',
                'lucky_color'     => $record->lucky_color ?? '#e5b026',
                'auspicious_time' => $record->auspicious_time ?? '09:00 AM - 11:00 AM',
                'ruling_planet'   => $record->ruling_planet ?? 'Saturn',
                'symbol'          => $record->symbol ?? 'Goat 🐐',
                'tarot_card'      => $record->tarot_card ?? 'The Devil',
                'lucky_stone'     => $record->lucky_stone ?? 'Blue Sapphire',
                'love_percent'    => (int) ($record->love_percent ?? 70),
                'love_status'     => $record->love_status ?? '',
                'career_percent'  => (int) ($record->career_percent ?? 60),
                'career_status'   => $record->career_status ?? '',
                'health_percent'  => (int) ($record->health_percent ?? 75),
                'health_status'   => $record->health_status ?? '',
                'money_percent'   => (int) ($record->money_percent ?? 65),
                'money_status'    => $record->money_status ?? '',
                'date_formatted'  => Carbon::parse($latestDate)->format('l, d F Y'),
            ];
        }

        $periods = self::PERIODS;

        return view('horoscope', compact('selectedSign', 'zodiacMeta', 'periodData', 'period', 'periods'));
    }
}
