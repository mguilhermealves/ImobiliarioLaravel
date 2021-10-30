<?php

namespace App\Services\Sistema;

use Illuminate\Support\Facades\Mail;

class SistemaService
{
    public static function jsonR(Int $code, Int $status, String $message, String $url = null, Int $parent = 0)
    {
        return response()->json(['response' => $status, 'message' => $message, 'url' => $url, 'parent' => $parent], $code);
    }

    public static function enviaEmail(String $view, String $to, String $subject, Object $obj = null, String $message = null)
    {
        Mail::send($view, [
          'obj' => $obj,
          'message' => $message,
        ], function ($mail) use ($to, $subject) {
            $mail->from(config('app.email'), config('app.name'));
            $mail->to($to);
            $mail->subject($subject);
        });
    }
}
