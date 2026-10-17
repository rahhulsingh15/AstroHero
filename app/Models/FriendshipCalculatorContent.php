<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendshipCalculatorContent extends Model
{
    protected $table = 'friendship_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
