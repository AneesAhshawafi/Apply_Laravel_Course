<?php

namespace App\Helpers;

class ApiResponse
{
    public static function send(int $code = 200, bool $status, string $message = null, $data = [], $error = null)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "error" => $error

        ], $code);
    }
}
