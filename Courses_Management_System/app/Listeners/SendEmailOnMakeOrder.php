<?php

namespace App\Listeners;

use App\Events\MakeOrderCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailOnMakeOrder
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
    public function handle(MakeOrderCart $event): void
    {
        //
    }
}
