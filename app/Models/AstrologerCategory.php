<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstrologerCategory extends Model
{
    use HasFactory;

    protected $table = 'astrologer_categories';

    // Icon badge ke rang (style.css ki .card-{key} classes)
    const COLORS = [
        'love'     => 'Pink',
        'marriage' => 'Golden',
        'career'   => 'Green',
        'women'    => 'Purple',
        'business' => 'Blue',
        'health'   => 'Red',
    ];

    protected $fillable = [
        'name',
        'astro_count',
        'link',
        'icon',
        'color',
        'sort_order',
        'is_active',
    ];
}
