<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Class Ping
 * @package App\Http\Controllers
 */
class Ping extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAll() : JsonResponse
    {
        return response()->json(['status' => 'ok']);
    }
}
