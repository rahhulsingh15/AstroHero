<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlamesReportContent extends Model
{
    protected $table = 'flames_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
