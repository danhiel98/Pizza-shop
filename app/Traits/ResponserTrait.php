<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait ResponserTrait
{
    // Respuesta correcta
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    // Respuesta de error
    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    // Respuesta de la coleccion de registros encontrados
    public function showAll(Collection $collection, $code = 200){
        return $this->successResponse($collection, $code);
    }

    // Respuesta de modelo específico
    public function showOne($instance, $code = 200){
        return $this->successResponse($instance, $code);
    }
}
