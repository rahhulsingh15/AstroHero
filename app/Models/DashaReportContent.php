<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashaReportContent extends Model
{
    protected $table = 'dasha_report_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
