<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveCalculatorContent extends Model
{
    protected $table = 'love_calculator_contents';

    // Jodit editor se aaye HTML mein sirf yahi tags rehne denge
    const ALLOWED_TAGS = '<h2><h3><h4><h5><p><br><hr><strong><b><em><i><u><s><sub><sup><span><a><ul><ol><li>'
        . '<blockquote><table><thead><tbody><tfoot><tr><th><td><div><img><figure><figcaption>';

    protected $fillable = [
        'meta_title',
        'breadcrumb_label',
        'hero_title',
        'hero_highlight',
        'hero_intro',
        'hero_more',
        'form_title',
        'form_highlight',
        'main_content',
        'extra_content',
        'faq_subtitle',
        'faq_title',
        'report_meta_title',
        'report_banner_tag',
        'report_banner_title',
        'report_banner_text',
        'report_banner_button',
        'report_experts_title',
    ];

    // Page ki ek hi row hai
    public static function current(): self
    {
        return static::firstOrNew([]);
    }

    /**
     * Jodit ka HTML saaf karo: faltu tags, onclick jaise attributes aur javascript: links hata do.
     */
    public static function cleanHtml(?string $html): string
    {
        $html = strip_tags((string) $html, self::ALLOWED_TAGS);
        $html = preg_replace('/\s+on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? '';
        $html = preg_replace('/(href|src)\s*=\s*(["\'])\s*javascript:[^"\']*\2/i', '$1="#"', $html) ?? '';

        return trim($html);
    }
}
