<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumerologyCalculatorFaq extends Model
{
    protected $table = 'numerology_calculator_faqs';

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];
}
