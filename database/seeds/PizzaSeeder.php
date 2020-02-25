<?php

use App\Pizza;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pizza::truncate();

        $pizzas = [
            [
                'name'       => 'Pizza de jamón y peperoni',
                'base_price' => 2
            ],
            [
                'name'       => 'Pizza con piña',
                'base_price' => 2.5
            ],
            [
                'name'       => 'Pizza con queso',
                'base_price' => 1.8
            ],
        ];

        foreach ($pizzas as $pizza) Pizza::create($pizza);
    }
}
