<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendshipReportContent extends Model
{
    protected $table = 'friendship_report_contents';

    protected $fillable = [
        'heading',
        'main_content',
        'faq_content',
    ];
}
