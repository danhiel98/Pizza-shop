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
        $users         = factory(App\User::class, 5)->create();
        $branchOffices = factory(App\BranchOffice::class, 3)->create();
        $ingredients   = factory(App\Ingredient::class, 15)->create();
        $pizzas        = factory(App\Pizza::class, 5)->create();
        $pizzaDetails  = factory(App\PizzaDetail::class, 20)->create();
        $orders        = factory(App\Order::class, 15)->create();
        $orderDetails  = factory(App\OrderDetail::class, 40)->create();
    }
}
