<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseAPIController extends Controller
{
    public function __construct()
    {

    }

    protected function successResponse(array $data, $code = null)
    {
        return response()->json($data);
    }

    protected function errorResponse(string $message, $code = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ]);
    }
}
