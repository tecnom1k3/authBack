<?php
namespace Digitec\Exception;

use App\Exceptions\Handler as AppExceptionHandler;

class Handler extends AppExceptionHandler
{
    public function render($request, \Exception $e)
    {
        if ($e instanceof Exception) {
            return response()->json([
                'error'   => $e->getCode(), 
                'message' => $e->getMessage()
            ], $e->getCode());
        }
        return parent::render($request, $e);
    }
}