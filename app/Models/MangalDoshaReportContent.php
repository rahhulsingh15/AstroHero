<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MangalDoshaReportContent extends Model
{
    protected $table = 'mangal_dosha_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
