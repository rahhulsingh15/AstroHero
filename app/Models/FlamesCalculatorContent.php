<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlamesCalculatorContent extends Model
{
    protected $table = 'flames_calculator_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
