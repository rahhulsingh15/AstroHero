<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['ip_address', 'fcm_token', 'status', 'user_agent'];
}
