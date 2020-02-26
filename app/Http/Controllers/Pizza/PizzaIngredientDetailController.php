<?php

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Controller;
use App\Ingredient;
use App\Pizza;
use App\PizzaDetail;
use Illuminate\Http\Request;

class PizzaIngredientDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pizza $pizza, Ingredient $ingredient)
    {
        $rules = [
            'ingredient_price'    => 'min:0.05',
            'ingredient_quantity' => 'min:1|max:100'
        ];

        $fields = $request->only([
            'ingredient_price',
            'ingredient_quantity'
        ]);

        $fields['pizza_id']      = $pizza->id;
        $fields['ingredient_id'] = $ingredient->id;

        $pizzaDetail = PizzaDetail::firstOrCreate($fields);

        $code = $pizzaDetail->wasRecentlyCreated ? 201 : 200;

        return $this->showOne($pizzaDetail, $code);
    }
}
