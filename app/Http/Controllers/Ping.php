<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class Ping extends Controller
{
    public function getAll() : JsonResponse
    {
        return response()->json(['status' => 'ok']);
    }
}
