<?php

namespace App\Services\Sistema;

class SistemaService
{
    public static function jsonR(Int $code, String $status, String $message, String $url = null)
    {
        return response()->json(['response' => $status, 'message' => $message, 'url' => $url], $code);
    }
}
