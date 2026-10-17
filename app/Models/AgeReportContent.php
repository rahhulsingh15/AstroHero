<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgeReportContent extends Model
{
    protected $table = 'age_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
