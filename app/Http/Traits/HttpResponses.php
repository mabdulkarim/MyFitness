<?php

namespace App\Http\Traits;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request was successful',
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function error($message, $code)
    {
        return response()->json([
            'error' => [
                'code' => $code,
                'message' => $message
            ]
        ], $code);
    }
}
