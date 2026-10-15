<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RisingAscendantReportContent extends Model
{
    protected $table = 'rising_ascendant_report_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
