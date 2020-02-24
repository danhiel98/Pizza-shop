<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait ResponserTrait
{
    // Trasformar la respuesta
    protected function transformData($data, $transformer){
        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }

    // Respuesta correcta
    protected function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    // Respuesta de error
    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    // Respuesta de la coleccion de registros encontrados
    public function showAll(Collection $collection, $code = 200)
    {
        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);

        return $this->successResponse($collection, $code);
    }

    // Respuesta de modelo específico
    public function showOne($instance, $code = 200)
    {
        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);

        return $this->successResponse($instance, $code);
    }
}
