<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MangalDoshaCalculatorContent extends Model
{
    protected $table = 'mangal_dosha_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
