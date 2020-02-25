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
            'id'                => (int)$pizza->id,
            'name'              => (string)$pizza->name,
            'base_price'        => (double)$pizza->base_price,
            'ingredients_price' => (double)number_format($pizza->ingredients_price, 2),
            'total'             => (double)number_format($pizza->price, 2),
            'created_at'        => (string)$pizza->created_at
        ];
    }
}
