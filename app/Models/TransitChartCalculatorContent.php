<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransitChartCalculatorContent extends Model
{
    protected $table = 'transit_chart_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
