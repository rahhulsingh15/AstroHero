<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Helpers\TransitHelper;
use App\Models\DailyHoroscope;
use Carbon\Carbon;

class FetchDailyHoroscope extends Command
{
    protected $signature = 'horoscope:fetch {--sign= : Sirf ek sign fetch karna ho (e.g. Aries)}';
    protected $description = 'Fetch horoscope for Today, Tomorrow, Week, Month and Year, written from real calculated planetary transits';

    const PERIODS = ['Today', 'Tomorrow', 'Week', 'Month', 'Year'];

    const SIGN_META = [
        'Aries'       => ['hindi' => 'Mesh',      'dates' => 'Mar 21 – Apr 19', 'planet' => 'Mars',    'symbol' => 'Ram ♈'],
        'Taurus'      => ['hindi' => 'Vrishabh',  'dates' => 'Apr 20 – May 20', 'planet' => 'Venus',   'symbol' => 'Bull ♉'],
        'Gemini'      => ['hindi' => 'Mithun',    'dates' => 'May 21 – Jun 20', 'planet' => 'Mercury', 'symbol' => 'Twins ♊'],
        'Cancer'      => ['hindi' => 'Kark',      'dates' => 'Jun 21 – Jul 22', 'planet' => 'Moon',    'symbol' => 'Crab ♋'],
        'Leo'         => ['hindi' => 'Simha',     'dates' => 'Jul 23 – Aug 22', 'planet' => 'Sun',     'symbol' => 'Lion ♌'],
        'Virgo'       => ['hindi' => 'Kanya',     'dates' => 'Aug 23 – Sep 22', 'planet' => 'Mercury', 'symbol' => 'Maiden ♍'],
        'Libra'       => ['hindi' => 'Tula',      'dates' => 'Sep 23 – Oct 22', 'planet' => 'Venus',   'symbol' => 'Scales ♎'],
        'Scorpio'     => ['hindi' => 'Vrishchik', 'dates' => 'Oct 23 – Nov 21', 'planet' => 'Mars',    'symbol' => 'Scorpion ♏'],
        'Sagittarius' => ['hindi' => 'Dhanu',     'dates' => 'Nov 22 – Dec 21', 'planet' => 'Jupiter', 'symbol' => 'Archer ♐'],
        'Capricorn'   => ['hindi' => 'Makar',     'dates' => 'Dec 22 – Jan 19', 'planet' => 'Saturn',  'symbol' => 'Goat ♑'],
        'Aquarius'    => ['hindi' => 'Kumbh',     'dates' => 'Jan 20 – Feb 18', 'planet' => 'Saturn',  'symbol' => 'Water Bearer ♒'],
        'Pisces'      => ['hindi' => 'Meen',      'dates' => 'Feb 19 – Mar 20', 'planet' => 'Jupiter', 'symbol' => 'Fish ♓'],
    ];

    public function handle()
    {
        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            $this->error('GEMINI_API_KEY is missing in your .env file!');
            return self::FAILURE;
        }

        $today = Carbon::today('Asia/Kolkata');
        $todayDate = $today->toDateString();
        $this->info("Fetching horoscope for date: {$todayDate} (real transits calculated for this date)...");

        $ctx = $this->buildContext($today);
        $auspicious = [
            'Today'    => TransitHelper::abhijitMuhurat($today),
            'Tomorrow' => TransitHelper::abhijitMuhurat($today->copy()->addDay()),
        ];

        $signs = array_keys(self::SIGN_META);
        if ($only = $this->option('sign')) {
            $signs = array_values(array_intersect($signs, [ucfirst(strtolower($only))]));
            if (empty($signs)) {
                $this->error("Unknown sign: {$only}");
                return self::FAILURE;
            }
        }

        $total = count($signs);
        $failed = [];

        foreach ($signs as $n => $sign) {
            if ($n > 0) sleep(4); // free-tier rate limit ke liye thoda gap

            if (!$this->fetchSign($apiKey, $sign, $ctx, $todayDate, $auspicious)) {
                $failed[] = $sign;
            }
        }

        // Jo signs fail hue (API busy / adhoora jawab) unhe thoda ruk kar ek baar aur try karo
        if ($failed) {
            $this->warn('Retrying failed signs in 30 seconds: ' . implode(', ', $failed));
            sleep(30);

            $retry = $failed;
            $failed = [];
            foreach ($retry as $n => $sign) {
                if ($n > 0) sleep(4);

                if (!$this->fetchSign($apiKey, $sign, $ctx, $todayDate, $auspicious)) {
                    $failed[] = $sign;
                }
            }
        }

        if ($failed) {
            $this->error('Failed signs: ' . implode(', ', $failed) . '. Dobara chalane ke liye: php artisan horoscope:fetch --sign=<Sign>');
            return self::FAILURE;
        }

        $this->info('Success! ' . ($total * 5) . ' records stored for ' . $todayDate . '.');
        return self::SUCCESS;
    }

    // Ek sign ke 5 periods Gemini se lao aur DB me save karo
    private function fetchSign(string $apiKey, string $sign, array $ctx, string $todayDate, array $auspicious): bool
    {
        $this->line("Requesting {$sign}...");
        $data = $this->requestSign($apiKey, $this->buildPrompt($sign, $ctx));

        if (!$data) {
            $this->warn(" [FAILED] {$sign}");
            return false;
        }

        $meta = self::SIGN_META[$sign];

        foreach (self::PERIODS as $pKey) {
            $pData = $data[$pKey];

            $percents = [];
            foreach (['love', 'career', 'health', 'money'] as $area) {
                $percents[$area] = max(40, min(95, (int) ($pData[$area . '_percent'] ?? 70)));
            }

            DailyHoroscope::updateOrCreate(
                [
                    'sign_name'      => $sign,
                    'period'         => $pKey,
                    'horoscope_date' => $todayDate,
                ],
                [
                    'hindi_name'      => $meta['hindi'],
                    'date_range'      => $meta['dates'],
                    'reading'         => trim($pData['reading']),
                    'lucky_color'     => preg_match('/^#[0-9a-fA-F]{6}$/', $pData['lucky_color'] ?? '') ? $pData['lucky_color'] : '#E3B568',
                    'lucky_number'    => (string) max(1, min(9, (int) ($pData['lucky_number'] ?? 3))),
                    'mood'            => $pData['mood'] ?? '✨ Calm',
                    'auspicious_time' => $auspicious[$pKey] ?? $auspicious['Today'],
                    'ruling_planet'   => $meta['planet'],
                    'symbol'          => $meta['symbol'],
                    'love_percent'    => $percents['love'],
                    'love_status'     => $this->statusFor($percents['love']),
                    'career_percent'  => $percents['career'],
                    'career_status'   => $this->statusFor($percents['career']),
                    'health_percent'  => $percents['health'],
                    'health_status'   => $this->statusFor($percents['health']),
                    'money_percent'   => $percents['money'],
                    'money_status'    => $this->statusFor($percents['money']),
                ]
            );
        }

        $this->line(" [STORED 5 PERIODS] {$sign}");

        return true;
    }

    private function statusFor(int $percent): string
    {
        return match (true) {
            $percent >= 85 => 'High',
            $percent >= 75 => 'Strong',
            $percent >= 65 => 'Good',
            $percent >= 55 => 'Steady',
            default        => 'Slow',
        };
    }

    // Sab signs ke liye common astronomical facts (ek hi baar calculate hote hain)
    private function buildContext(Carbon $today): array
    {
        $tomorrow = $today->copy()->addDay();
        $weekStart = $today->copy()->startOfWeek();
        $weekEnd = $today->copy()->endOfWeek()->startOfDay();
        $monthStart = $today->copy()->startOfMonth();
        $monthEnd = $today->copy()->endOfMonth()->startOfDay();
        $yearStart = $today->copy()->startOfYear();
        $yearEnd = $today->copy()->endOfYear()->startOfDay();

        $weekMoon = [];
        for ($day = $weekStart->copy(); $day->lte($weekEnd); $day->addDay()) {
            $weekMoon[] = ['date' => $day->copy(), 'signIndex' => TransitHelper::positions($day)['Moon']['signIndex']];
        }

        $allPlanets = ['Sun', 'Mars', 'Mercury', 'Jupiter', 'Venus', 'Saturn', 'Rahu', 'Ketu'];

        return [
            'today'           => $today,
            'tomorrow'        => $tomorrow,
            'weekStart'       => $weekStart,
            'weekEnd'         => $weekEnd,
            'posToday'        => TransitHelper::positions($today),
            'posTomorrow'     => TransitHelper::positions($tomorrow),
            'posYearStart'    => TransitHelper::positions($yearStart),
            'panchangToday'   => TransitHelper::panchang($today),
            'panchangTomorrow'=> TransitHelper::panchang($tomorrow),
            'weekMoon'        => $weekMoon,
            'weekIngresses'   => TransitHelper::ingresses($weekStart, $weekEnd, $allPlanets),
            'monthIngresses'  => TransitHelper::ingresses($monthStart, $monthEnd, $allPlanets),
            'monthPhases'     => TransitHelper::moonPhases($monthStart, $monthEnd),
            'yearIngresses'   => TransitHelper::ingresses($yearStart, $yearEnd, ['Mars', 'Jupiter', 'Saturn', 'Rahu', 'Ketu']),
        ];
    }

    private function house(int $planetSignIndex, int $signIndex): string
    {
        $n = (($planetSignIndex - $signIndex + 12) % 12) + 1;
        $suffix = ($n % 10 === 1 && $n !== 11) ? 'st' : (($n % 10 === 2 && $n !== 12) ? 'nd' : (($n % 10 === 3 && $n !== 13) ? 'rd' : 'th'));
        return $n . $suffix . ' house';
    }

    private function transitLines(array $positions, int $signIndex, array $planets): string
    {
        $lines = [];
        foreach ($planets as $p) {
            $pos = $positions[$p];
            $lines[] = "- {$p}: {$pos['sign']} {$pos['degree']}°" . ($pos['retro'] ? ' (retrograde)' : '') . ' -> ' . $this->house($pos['signIndex'], $signIndex);
        }
        return implode("\n", $lines);
    }

    private function ingressLines(array $events, int $signIndex): string
    {
        if (empty($events)) return '- No planet changes sign in this period.';

        $lines = [];
        foreach ($events as $e) {
            $toIndex = array_search($e['to'], TransitHelper::SIGNS);
            $lines[] = "- {$e['date']->format('d M')}: {$e['planet']} moves {$e['from']} -> {$e['to']} (" . $this->house($toIndex, $signIndex) . ')';
        }
        return implode("\n", $lines);
    }

    private function buildPrompt(string $sign, array $ctx): string
    {
        $signIndex = array_search($sign, TransitHelper::SIGNS);
        $hindi = self::SIGN_META[$sign]['hindi'];
        $lord = self::SIGN_META[$sign]['planet'];

        $today = $ctx['today'];
        $tomorrow = $ctx['tomorrow'];
        $pT = $ctx['panchangToday'];
        $pN = $ctx['panchangTomorrow'];

        $todayTransits = $this->transitLines($ctx['posToday'], $signIndex, TransitHelper::PLANETS);
        $tomorrowMoon = $this->transitLines($ctx['posTomorrow'], $signIndex, ['Moon']);
        $yearStartTransits = $this->transitLines($ctx['posYearStart'], $signIndex, ['Jupiter', 'Saturn', 'Rahu', 'Ketu']);

        $weekMoon = [];
        foreach ($ctx['weekMoon'] as $m) {
            $weekMoon[] = '- ' . $m['date']->format('D d M') . ': Moon in ' . TransitHelper::SIGNS[$m['signIndex']] . ' (' . $this->house($m['signIndex'], $signIndex) . ')';
        }
        $weekMoon = implode("\n", $weekMoon);

        $phases = [];
        foreach ($ctx['monthPhases'] as $ph) {
            $phases[] = '- ' . $ph['date']->format('d M') . ': ' . $ph['phase'];
        }
        $phases = implode("\n", $phases);

        $weekIngresses = $this->ingressLines($ctx['weekIngresses'], $signIndex);
        $monthIngresses = $this->ingressLines($ctx['monthIngresses'], $signIndex);
        $yearIngresses = $this->ingressLines($ctx['yearIngresses'], $signIndex);

        $weekRange = $ctx['weekStart']->format('d M') . ' – ' . $ctx['weekEnd']->format('d M Y');

        return <<<PROMPT
You are a senior Vedic astrologer writing for a professional astrology website (Astrotalk-style quality). Write the horoscope for {$sign} ({$hindi} rashi, lord: {$lord}).

Every astronomical fact below was calculated with real ephemeris data (sidereal zodiac, Lahiri ayanamsa). "House" means the house counted from {$sign} (gochar).

=== TODAY: {$today->format('l, d F Y')} ===
Tithi: {$pT['tithi']} ({$pT['paksha']}) | Nakshatra: {$pT['nakshatra']} | Moon sign: {$pT['moonSign']}
Planet positions and the house they transit for {$sign}:
{$todayTransits}

=== TOMORROW: {$tomorrow->format('l, d F Y')} ===
Tithi: {$pN['tithi']} ({$pN['paksha']}) | Nakshatra: {$pN['nakshatra']}
{$tomorrowMoon}
(All other planets are in the same houses as today.)

=== THIS WEEK: {$weekRange} ===
Moon's journey:
{$weekMoon}
Sign changes this week:
{$weekIngresses}

=== THIS MONTH: {$today->format('F Y')} ===
Sign changes this month:
{$monthIngresses}
Moon phases:
{$phases}

=== THIS YEAR: {$today->format('Y')} ===
Slow planets at the start of the year:
{$yearStartTransits}
Major sign changes during the year:
{$yearIngresses}

RULES FOR ACCURACY (most important):
1. Use ONLY the planetary facts given above. Never invent, guess or change a planet's sign, house, nakshatra, tithi, retrograde status or a date. If a fact is not listed above, do not mention it.
2. Interpret with classical Vedic gochar principles: what each house stands for (1 self, 2 wealth/family, 3 effort/siblings, 4 home/mother, 5 love/children/intellect, 6 health/enemies/debts, 7 partner, 8 obstacles/sudden events, 9 luck/dharma, 10 career, 11 gains, 12 expenses/isolation), the nature of each planet, and whether it is retrograde.
3. Each reading must name at least two of the real transits above (planet + sign or house) and explain what they mean for {$sign} in daily life. Today and Tomorrow must be driven mainly by the Moon's house, tithi and nakshatra of that day, so they must read clearly different from each other.
4. Be honest and balanced. If the transits are difficult (for example Moon, Saturn, Mars, Rahu or Ketu in the 6th, 8th or 12th house), say so gently and give practical caution. Do not make every area sound great.
5. The four percent scores (40 to 95) must follow the transits: houses 5 and 7 drive love, 10 and 6 drive career, 1, 6 and 8 drive health, 2 and 11 drive money. Benefics (Jupiter, Venus, Mercury, a waxing Moon) in a house raise its score; malefics (Saturn, Mars, Rahu, Ketu) or a retrograde planet lower it. The four scores must differ from each other and differ between periods.
6. Tone: warm, direct, second person ("you"), simple English, no hype, no guarantees, no medical/legal/financial promises. Remedies must be simple traditional ones linked to the planet causing trouble (a mantra, a donation, a colour, a fast).
7. lucky_color: a hex colour connected to the day's Moon nakshatra/weekday lord or to {$lord}. lucky_number: one digit 1-9 as a string. mood: one emoji followed by one word that honestly matches the reading.

FORMAT OF EACH "reading":
- Today, Tomorrow: one paragraph of 4 to 5 full sentences. No headings.
- Week: five sections separated by a blank line, each starting with its heading exactly: "Personal:", "Money:", "Health:", "Love:", "Remedy:". Mention specific weekdays using the Moon's journey above. 2 sentences per section.
- Month: one opening paragraph, then sections separated by a blank line starting exactly with "Career:", "Finance:", "Love and Relationships:", "Health:", "Remedy:". Mention the real dates of sign changes and moon phases. 2 to 3 sentences per section.
- Year: sections separated by a blank line starting exactly with "Love and Relationships:", "Health and Wellness:", "Career and Education:", "Money and Finances:", "Tip of the Year:". Build it around Jupiter, Saturn and Rahu/Ketu and the real dates they change sign. 2 to 3 sentences per section.

OUTPUT: only a raw JSON object (no markdown, no notes) with exactly these five keys: "Today", "Tomorrow", "Week", "Month", "Year". Each value is an object with exactly these keys:
"reading" (string), "mood" (string), "lucky_number" (string), "lucky_color" (string), "love_percent" (integer), "career_percent" (integer), "health_percent" (integer), "money_percent" (integer).
PROMPT;
    }

    // Ek sign ka data Gemini se lao; saare 5 periods valid hon tabhi array return hota hai
    private function requestSign(string $apiKey, string $prompt): ?array
    {
        $models = ['gemini-3.5-flash-lite', 'gemini-3.8-flash'];

        foreach ($models as $m) {
            for ($attempt = 1; $attempt <= 2; $attempt++) {
                try {
                    $res = Http::withoutVerifying()
                        ->timeout(120)
                        ->post("https://generativelanguage.googleapis.com/v1beta/models/{$m}:generateContent?key={$apiKey}", [
                            'contents' => [
                                ['parts' => [['text' => $prompt]]]
                            ],
                            'generationConfig' => [
                                'response_mime_type' => 'application/json',
                                'temperature'        => 0.8,
                            ]
                        ]);
                } catch (\Exception $e) {
                    $this->warn("  {$m}: " . $e->getMessage());
                    continue;
                }

                if (!$res->successful()) {
                    $this->warn("  {$m}: HTTP {$res->status()}");
                    // 429 = rate limit, 500/503 = Gemini busy: thoda ruk kar dobara
                    if (in_array($res->status(), [429, 500, 503])) sleep(20);
                    continue;
                }

                $rawText = $res->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
                $data = json_decode(trim(str_replace(['```json', '```'], '', $rawText)), true);
                $data = $data['periods'] ?? $data;

                if ($this->isValid($data)) {
                    return $data;
                }

                $this->warn("  {$m}: incomplete JSON, retrying...");
            }
        }

        return null;
    }

    private function isValid($data): bool
    {
        if (!is_array($data)) return false;

        foreach (self::PERIODS as $pKey) {
            if (empty($data[$pKey]['reading']) || mb_strlen($data[$pKey]['reading']) < 150) {
                return false;
            }
        }

        return true;
    }
}
