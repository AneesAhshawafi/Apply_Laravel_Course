<?php

namespace App\Services;

class HelperService
{
    public function greet(string $name)
    {
        return "Welcome {$name}";
    }
}
