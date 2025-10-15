<?php

namespace App\Http\Controllers\API;

class TestController extends BaseAPIController
{
    public function test()
    {
        return response()->json([
            'message' => 'Hello there. I am working!'
        ]);
    }
}
