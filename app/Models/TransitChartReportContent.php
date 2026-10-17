<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransitChartReportContent extends Model
{
    protected $table = 'transit_chart_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
