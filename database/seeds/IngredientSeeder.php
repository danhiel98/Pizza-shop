<?php

use App\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::truncate();

        $ingredients = [
            [
                'name' => 'Tomate',
                'price' => 0.20
            ],
            [
                'name' => 'Queso',
                'price' => 0.30
            ],
            [
                'name' => 'Salsa',
                'price' => 0.20
            ],
            [
                'name' => 'Jamón',
                'price' => 0.50
            ],
            [
                'name' => 'Peperoni',
                'price' => 0.40
            ],
            [
                'name' => 'Piña',
                'price' => 0.25
            ],
        ];

        foreach ($ingredients as $ingredient) Ingredient::create($ingredient);
    }
}
