<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    protected $fillable = ['title', 'body', 'link', 'sent_count', 'failed_count'];
}
