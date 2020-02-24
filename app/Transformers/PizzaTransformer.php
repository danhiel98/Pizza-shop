<?php

namespace App\Transformers;

use App\Pizza;
use League\Fractal\TransformerAbstract;

class PizzaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Pizza $pizza)
    {
        return [
            'id'         => (int)$pizza->id,
            'name'       => (string)$pizza->name,
            'base_price' => (double)$pizza->base_price,
            'created_at' => (string)$pizza->created_at
        ];
    }
}
