<?php

namespace App\Listeners;

use App\Events\AddCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class ListenerOnAddCourse implements ShouldQueue
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
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    // public $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    // public $queue = 'listeners';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 10; //the suration the listener must wiat in the queue before executing
}
