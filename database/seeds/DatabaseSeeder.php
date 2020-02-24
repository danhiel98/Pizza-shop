<?php

use App\User;
use App\Order;
use App\Pizza;
use App\Ingredient;
use App\OrderDetail;
use App\PizzaDetail;
use App\BranchOffice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // No tener en cuenta llaves foraneas para poder eliminar las tablas sin problema
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        BranchOffice::truncate();
        Ingredient::truncate();
        Pizza::truncate();
        PizzaDetail::truncate();
        Order::truncate();
        OrderDetail::truncate();

        User::create([
            'name'     => 'Principal',
            'email'    => 'admin@mail.com',
            'password' => bcrypt('admin')
        ]);

        $this->call(FactorySeeder::class);
    }
}
