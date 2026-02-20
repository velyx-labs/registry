<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class ComponentNotFoundException extends \Exception
{
    protected $code = 404;

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => 'Component not found',
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
