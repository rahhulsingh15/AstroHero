<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoveCalculaterController extends Controller
{
    const BANDS = [
        80 => ['title' => 'Soulmate Bond', 'text' => 'You two share a deep connection and are practically soulmates. Your names point to a high level of understanding and mutual respect, so keep nurturing the trust you already have and this bond will only grow stronger.'],
        60 => ['title' => 'A Promising Bond', 'text' => 'You have a promising bond that can develop into a strong relationship. With a little effort, open communication and time for each other, this connection has everything it needs to last.'],
        40 => ['title' => 'A Growing Bond', 'text' => 'There is real potential here, but it needs patience. Focus on building trust and spending quality time together, and you will see this bond grow steadily.'],
        0  => ['title' => 'A Fainter Bond', 'text' => 'A lower score does not mean it is impossible, but making this relationship work will need sincere effort and compromise from both of you. Honest conversations are the best place to start.'],
    ];

    public function index()
    {
        return view('love-calculator');
    }

    public function report(Request $request)
    {
        $name1 = trim((string) $request->query('name1'));
        $name2 = trim((string) $request->query('name2'));

        // Score sirf English letters se banta hai, isliye dono naam me kam se kam ek letter hona chahiye
        if (!preg_match('/[a-z]/i', $name1) || !preg_match('/[a-z]/i', $name2)) {
            return redirect()->route('love-calculator');
        }

        $percent = $this->lovePercent($name1, $name2);

        foreach (self::BANDS as $min => $band) {
            if ($percent >= $min) break;
        }

        return view('love-report', [
            'name1'   => mb_substr($name1, 0, 30),
            'name2'   => mb_substr($name2, 0, 30),
            'gender1' => $request->query('gender1') === 'female' ? 'female' : 'male',
            'gender2' => $request->query('gender2') === 'male' ? 'male' : 'female',
            'percent' => $percent,
            'band'    => $band,
        ]);
    }

    // Numerology (Pythagorean) name number: a=1 ... i=9, j=1 ... reduced to a single digit
    private function nameNumber(string $letters): int
    {
        $sum = 0;
        foreach (str_split($letters) as $ch) {
            $sum += (ord($ch) - 97) % 9 + 1;
        }
        while ($sum > 9) {
            $sum = array_sum(str_split((string) $sum));
        }
        return $sum;
    }

    // Same two names always give the same score, in either order
    private function lovePercent(string $name1, string $name2): int
    {
        $a = preg_replace('/[^a-z]/', '', strtolower($name1));
        $b = preg_replace('/[^a-z]/', '', strtolower($name2));

        $pair = [$a, $b];
        sort($pair);

        $diff = abs($this->nameNumber($a) - $this->nameNumber($b));
        $common = count(array_intersect(array_unique(str_split($a)), array_unique(str_split($b))));

        $score = 66 - $diff * 4 + min($common, 5) * 4 + crc32(implode('+', $pair)) % 13;

        return max(32, min(98, $score));
    }
}
