<?php

namespace App\Listeners;

use App\Events\AddCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class ListenerOnAddCourse
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AddCourse $event): void
    {
        DB::table("events_messages")->insert([
            "message" => "A new course was created with name " . $event->course,
            "created_at" => now(),
        ]);
    }
}
