<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MulankCalculatorContent extends Model
{
    protected $table = 'mulank_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
