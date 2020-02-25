<?php

use App\PizzaDetail;
use Illuminate\Database\Seeder;

class PizzaDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PizzaDetail::truncate();

        $pizzaDetails = [
            // Pizza de jamón y peperoni
            [
                'pizza_id'            => 1,
                'ingredient_id'       => 3,
                'ingredient_price'    => 0.20,
                'ingredient_quantity' => 1
            ],
            [
                'pizza_id'            => 1,
                'ingredient_id'       => 4,
                'ingredient_price'    => 0.50,
                'ingredient_quantity' => 2
            ],
            [
                'pizza_id'            => 1,
                'ingredient_id'       => 5,
                'ingredient_price'    => 0.40,
                'ingredient_quantity' => 2
            ],
            // Pizza con piña
            [
                'pizza_id'            => 2,
                'ingredient_id'       => 2,
                'ingredient_price'    => 0.30,
                'ingredient_quantity' => 1
            ],
            [
                'pizza_id'            => 2,
                'ingredient_id'       => 3,
                'ingredient_price'    => 0.20,
                'ingredient_quantity' => 2
            ],
            [
                'pizza_id'            => 2,
                'ingredient_id'       => 6,
                'ingredient_price'    => 0.25,
                'ingredient_quantity' => 3
            ],
            // Pizza con queso
            [
                'pizza_id'            => 3,
                'ingredient_id'       => 1,
                'ingredient_price'    => 0.20,
                'ingredient_quantity' => 2
            ],
            [
                'pizza_id'            => 3,
                'ingredient_id'       => 2,
                'ingredient_price'    => 0.30,
                'ingredient_quantity' => 3
            ],
            [
                'pizza_id'            => 3,
                'ingredient_id'       => 3,
                'ingredient_price'    => 0.20,
                'ingredient_quantity' => 1
            ],
        ];

        foreach ($pizzaDetails as $detail) PizzaDetail::create($detail);
    }
}
