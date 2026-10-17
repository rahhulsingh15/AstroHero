<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('horoscope:fetch')
    ->dailyAt('00:01') // live karte waqt wapas '00:01' kar dena
    ->timezone('Asia/Kolkata')
    ->withoutOverlapping();



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');