<?php

namespace App\Listeners_Domain\Orders\Listeners;

use App\Events\MakeOrderCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Events\ShouldBeDiscovered;

class SendEmailOnMakeOrder implements ShouldBeDiscovered
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
    public static function shouldBeDiscovered(): bool
    {
        return app()->environment('production');
    }
}
