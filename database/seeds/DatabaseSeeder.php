<?php

use App\BranchOffice;
use App\Ingredient;
use App\Order;
use App\OrderDetail;
use App\Person;
use App\Pizza;
use App\PizzaDetail;
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

        Person::truncate();
        BranchOffice::truncate();
        Ingredient::truncate();
        Pizza::truncate();
        PizzaDetail::truncate();
        Order::truncate();
        OrderDetail::truncate();

        Person::create([
            'name'     => 'Principal',
            'email'    => 'admin@mail.com',
            'password' => bcrypt('admin')
        ]);

        $this->call(FactorySeeder::class);
    }
}
