<?php

namespace App\Traits;

trait ApiResponses
{
    protected function success(string $message, $data = null, $token = null, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'token' => $token,
            'timesptamp' => now()->toISOString(),
            'status' => $statusCode,

        ], $statusCode);
    }

    protected function error(string $message, $errors = null, $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
            'token' => null,
            'errors' => $errors,
            'timesptamp' => now()->toISOString(),
            'status' => $statusCode,

        ], $statusCode);
    }


    public  function notFound(string $message, $errors = null, $statusCode)
    {
        return $this->error($message, $errors, $statusCode);
    }
}
