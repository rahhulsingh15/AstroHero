<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IshtaDevataReportContent extends Model
{
    protected $table = 'ishta_devata_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
