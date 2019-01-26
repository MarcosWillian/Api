<?php

namespace App\API;

class ApiMessage 
{
    public static function returnMessage($data = null, $message, $code)
    {
        return [
            'message'     => $message,
            'code'        => $code,
            'collections' => $data,
            
        ];
    }
    
}