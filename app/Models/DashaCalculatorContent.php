<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashaCalculatorContent extends Model
{
    protected $table = 'dasha_calculator_contents';
    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
