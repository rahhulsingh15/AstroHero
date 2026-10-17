<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgeCalculatorContent extends Model
{
    protected $table = 'age_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
