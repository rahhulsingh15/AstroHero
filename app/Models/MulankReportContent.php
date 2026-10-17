<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MulankReportContent extends Model
{
    protected $table = 'mulank_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
