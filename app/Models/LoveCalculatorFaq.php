<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveCalculatorFaq extends Model
{
    protected $table = 'love_calculator_faqs';

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];
}
