<?php

use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persons = factory(App\Person::class, 10)->create();
        $branchOffices = factory(App\BranchOffice::class, 3)->create();
        $ingredients = factory(App\Ingredient::class, 15)->create();
        $pizzas = factory(App\Pizza::class, 5)->create();
        $pizzaDetails = factory(App\PizzaDetail::class, 20)->create();
        $orders = factory(App\Order::class, 7)->create();
        $orderDetails = factory(App\OrderDetail::class, 15)->create();
    }
}
