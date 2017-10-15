<?php
namespace Digitec\Exception;

use App\Exceptions\Handler as AppExceptionHandler;

/**
 * Class Handler
 * @package Digitec\Exception
 */
class Handler extends AppExceptionHandler
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
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