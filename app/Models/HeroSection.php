<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $table = 'hero_sections';

    protected $fillable = [
        'is_active',
        'eyebrow_text',
        'heading',
        'lead_text',
        'btn1_title',
        'btn1_link',
        'btn2_title',
        'btn2_link',
        'stat1_value',
        'stat1_label',
        'stat2_value',
        'stat2_label',
        'stat3_value',
        'stat3_label',
        'match_score',
    ];
}