<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Override;

class Helper extends Facade
{
    #[Override]
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\HelperService::class;
    }
}
