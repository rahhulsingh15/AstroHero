<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumerologyCalculatorContent extends Model
{
    protected $table = 'numerology_calculator_contents';

    protected $fillable = [
        'meta_title',
        'breadcrumb_label',
        'hero_title',
        'hero_intro',
        'form_title',
        'promo_text',
        'main_content',
        'faq_subtitle',
        'faq_title',
        'report_banner_title',
        'report_banner_text',
        'report_content',
    ];

    // Page ki ek hi row hai
    public static function current(): self
    {
        return static::firstOrNew([]);
    }
}
