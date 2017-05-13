<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Interface RestfulController
 * @package App\Http\Controllers
 */
interface RestfulController
{
    /**
     * @return JsonResponse
     */
    public function getAll() : JsonResponse;
}