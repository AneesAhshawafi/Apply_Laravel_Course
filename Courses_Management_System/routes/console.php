<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
// Tasks Scheduling
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Tasks Scheduling
Schedule::call(function () {
    DB::table('courses')->insert(["name" => "Laravel course", "active" => "1", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()]);
})->everySecond();
