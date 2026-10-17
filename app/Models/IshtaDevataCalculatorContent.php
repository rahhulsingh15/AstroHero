<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IshtaDevataCalculatorContent extends Model
{
    protected $table = 'ishta_devata_calculator_contents';

    protected $fillable = [
        'heading',
        'description',
        'main_content',
        'faq_content',
    ];
}
