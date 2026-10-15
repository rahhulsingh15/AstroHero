<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RisingAscendantCalculatorContent extends Model
{
    protected $table = 'rising_ascendant_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
