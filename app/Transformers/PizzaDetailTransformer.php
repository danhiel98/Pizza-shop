<?php

namespace App\Transformers;

use App\PizzaDetail;
use League\Fractal\TransformerAbstract;

class PizzaDetailTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(PizzaDetail $pizzaDetail)
    {
        return [
            'id'                  => (int)$pizzaDetail->id,
            'ingredient_price'    => (double)$pizzaDetail->ingredient_price,
            'ingredient_quantity' => (double)$pizzaDetail->ingredient_quantity,
            'pizza'               => [

                'id'         => (int)$pizzaDetail->pizza->id,
                'name'       => (string)$pizzaDetail->pizza->name,
                'base_price' => (double)$pizzaDetail->pizza->base_price,
                'total'      => (double)number_format($pizzaDetail->pizza->price, 2)
            ],
            'ingredient'          => [
                'id'    => (int)$pizzaDetail->ingredient->id,
                'name'  => (string)$pizzaDetail->ingredient->name,
                'price' => (double)$pizzaDetail->ingredient->price
            ],
        ];
    }
}
