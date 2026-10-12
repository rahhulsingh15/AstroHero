<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstrologerPage extends Model
{
    use HasFactory;

    protected $table = 'astrologer_pages';

    // slug => admin mein dikhne wala naam
    const PAGES = [
        'chat' => 'Chat with Astrologers',
        'talk' => 'Talk to Astrologers',
    ];

    // slug => resources/views/admin/ ke andar us page ka folder
    const VIEW_FOLDERS = [
        'chat' => 'chat_with_astrologer',
        'talk' => 'talk_to_astrologer',
    ];

    // Admin ke text boxes mein itne hi HTML tags allowed hain
    const ALLOWED_TAGS = '<strong><b><em><i><u><br><p><ul><ol><li><a><span>';

    protected $fillable = [
        'slug',
        'breadcrumb_label',
        'hero_title',
        'hero_description',
        'hero_astrologer_name',
        'hero_astrologer_image',
        'hero_status_text',
        'hero_pill_text',
        'why_title',
        'verify_title',
        'verify_badge',
        'connect_title',
        'connect_description',
        'topics_title',
        'services_title',
        'services_subtitle',
    ];

    public function items()
    {
        return $this->hasMany(AstrologerPageItem::class, 'page_slug', 'slug');
    }

    // Public page ke view ke liye data: page ka content + active items, section ke hisaab se
    public static function viewData(string $slug): array
    {
        return [
            'content'  => static::firstOrNew(['slug' => $slug]),
            'sections' => AstrologerPageItem::where('page_slug', $slug)
                ->where('is_active', 1)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->groupBy('section'),
        ];
    }

    // Hero widget ki photo: upload ki hui, warna default
    public function heroImageUrl(): string
    {
        return asset($this->hero_astrologer_image ?: 'assets/images/chatimg2.png');
    }

    /**
     * Admin ka likha text page ke liye HTML blocks mein badalta hai:
     * khaali line se alag hue hisse <p> ban jate hain, <ul>/<ol>/<p> wale hisse waise hi rehte hain.
     */
    public static function blocks(?string $text): string
    {
        $html = '';

        foreach (preg_split('/\R\s*\R/', trim((string) $text)) as $block) {
            $block = trim($block);
            if ($block === '') continue;

            if (preg_match('/^<(p|ul|ol)\b/i', $block)) {
                $html .= str_replace('<ul>', '<ul class="clean-list">', $block);
            } else {
                $html .= '<p>' . nl2br($block, false) . '</p>';
            }
        }

        return $html;
    }
}
