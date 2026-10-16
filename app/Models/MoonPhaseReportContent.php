<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoonPhaseReportContent extends Model
{
    protected $table = 'moon_phase_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
