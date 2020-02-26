<?php

namespace App\Transformers;

use App\Ingredient;
use League\Fractal\TransformerAbstract;

class IngredientTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Ingredient $ingredient)
    {
        return [
            'id'          => (int)$ingredient->id,
            'name'        => (string)$ingredient->name,
            'price'       => (double)$ingredient->price,
            'pizza_count' => (int)$ingredient->pizza_count,
            'created_at'  => (string)$ingredient->created_at
        ];
    }
}
