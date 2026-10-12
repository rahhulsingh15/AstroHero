<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AstrologerCategory;
use App\Models\DailyHoroscope;
use App\Models\HeroSection;
use App\Models\HomeService;
use App\Helpers\TransitHelper;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HeroSection::where('is_active', 1)->latest()->first();



        $today = Carbon::today('Asia/Kolkata')->toDateString();

        $latestDate = DailyHoroscope::where('horoscope_date', $today)->exists()
            ? $today
            : DailyHoroscope::max('horoscope_date');

        $allHoroscopes = DailyHoroscope::where('horoscope_date', $latestDate)->get();
        $allSigns = $allHoroscopes->where('period', 'Today')->values();
        $activeHoroscope = $allSigns->first();

        $signImagesMap = [
            'Aries'       => 'horoscope-01.avif',
            'Taurus'      => 'horoscope-02.avif',
            'Gemini'      => 'horoscope-03.avif',
            'Cancer'      => 'horoscope-04.avif',
            'Leo'         => 'horoscope-05.avif',
            'Virgo'       => 'horoscope-06.avif',
            'Libra'       => 'horoscope-07.avif',
            'Scorpio'     => 'horoscope-08.avif',
            'Sagittarius' => 'horoscope-09.avif',
            'Capricorn'   => 'horoscope-10.avif',
            'Aquarius'    => 'horoscope-11.avif',
            'Pisces'      => 'horoscope-12.avif',
        ];

        $groupedRaashiData = [];
        $uniqueSigns = $allSigns->pluck('sign_name')->unique();

        foreach ($uniqueSigns as $signName) {
            $signRecords = $allHoroscopes->where('sign_name', $signName);
            $todayRecord = $signRecords->firstWhere('period', 'Today') ?? $signRecords->first();

            if (!$todayRecord) continue;

            $periodDetails = [];

            $baseDate = Carbon::parse($todayRecord->horoscope_date);
            $dateLabels = [
                'Today'    => 'Today · ' . $baseDate->format('d M Y'),
                'Tomorrow' => 'Tomorrow · ' . $baseDate->copy()->addDay()->format('d M Y'),
                'Week'     => 'Week · ' . $baseDate->copy()->startOfWeek()->format('d M') . ' – ' . $baseDate->copy()->endOfWeek()->format('d M Y'),
                'Month'    => 'Month · ' . $baseDate->format('F Y'),
                'Year'     => 'Year · ' . $baseDate->format('Y'),
            ];

            foreach (['Today', 'Tomorrow', 'Week', 'Month', 'Year'] as $pKey) {
                $record = $signRecords->firstWhere('period', $pKey) ?? $todayRecord;

                $periodDetails[$pKey] = [
                    'dateLabel'    => $dateLabels[$pKey],
                    'reading'      => $record->reading,
                    'mood'         => $record->mood,
                    'lucky'        => $record->lucky_number,
                    'color'        => $record->lucky_color,
                    'auspicious'   => $record->auspicious_time,
                    'pillars'      => [
                        'love'   => ['status' => $record->love_status, 'percent' => (int)$record->love_percent],
                        'career' => ['status' => $record->career_status, 'percent' => (int)$record->career_percent],
                        'health' => ['status' => $record->health_status, 'percent' => (int)$record->health_percent],
                        'money'  => ['status' => $record->money_status, 'percent' => (int)$record->money_percent],
                    ]
                ];
            }

            $groupedRaashiData[] = [
                'name'          => $todayRecord->sign_name,
                'hindi'         => $todayRecord->hindi_name ?? '',
                'dates'         => $todayRecord->date_range ?? '',
                'img'           => asset('assets/images/' . ($signImagesMap[$todayRecord->sign_name] ?? 'horoscope-01.avif')),
                'dateFormatted' => Carbon::parse($todayRecord->horoscope_date)->format('d M Y'),
                'periods'       => $periodDetails,
            ];
        }

        // "Browse by Category" cards
        $categories = AstrologerCategory::where('is_active', 1)->orderBy('sort_order')->orderBy('id')->get();

        // "Our Services" slider: [1 => upar wali row ke cards, 2 => neeche wali row ke cards]
        $serviceRows = HomeService::where('is_active', 1)->orderBy('sort_order')->orderBy('id')->get()
            ->groupBy('slider_row')
            ->sortKeys();

        // Rashi the Moon is in today, highlighted on the hero wheel
        $moonSign = TransitHelper::panchang(Carbon::today('Asia/Kolkata'))['moonSign'];

        return view('home', compact('hero', 'allSigns', 'activeHoroscope', 'groupedRaashiData', 'categories', 'serviceRows', 'moonSign'));
    }
}