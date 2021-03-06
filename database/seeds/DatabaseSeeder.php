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

        // $this->call(FactorySeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BranchOfficeSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(PizzaSeeder::class);
        $this->call(PizzaDetailSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
    }
}
