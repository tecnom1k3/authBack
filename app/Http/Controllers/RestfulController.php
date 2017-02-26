<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

interface RestfulController
{
    public function getAll() : JsonResponse;
}