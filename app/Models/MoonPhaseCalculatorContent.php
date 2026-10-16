<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoonPhaseCalculatorContent extends Model
{
    protected $table = 'moon_phase_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
