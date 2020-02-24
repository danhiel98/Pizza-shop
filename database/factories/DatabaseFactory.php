<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Order;
use App\Pizza;
use App\Client;
use App\Ingredient;
use App\OrderDetail;
use App\PizzaDetail;
use App\BranchOffice;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => bcrypt('secret'),
        'remember_token'    => Str::random(10),
        'type'              => $faker->randomElement([User::NORMAL_USER, User::CLIENT_USER])
    ];
});

$factory->define(BranchOffice::class, function (Faker $faker) {
    return [
        'name'    => $faker->word,
        'address' => $faker->address
    ];
});

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'name'  => $faker->word,
        'price' => $faker->randomFloat(2, 0, 5)
    ];
});

$factory->define(Pizza::class, function (Faker $faker) {
    return [
        'name'       => $faker->word,
        'base_price' => 1.5
    ];
});

$factory->define(PizzaDetail::class, function (Faker $faker) {
    $ingredient = Ingredient::all()->random(); // Obtener un ingrediente especifico
    return [
        'ingredient_price'    => $ingredient->price,
        'ingredient_quantity' => $faker->numberBetween(1, 10),
        'pizza_id'            => Pizza::all()->random()->id, // Obtener una pizza
        'ingredient_id'       => $ingredient->id
    ];
});

$factory->define(Order::class, function (Faker $faker) {
    static $number = 1;
    return [
        'order_number' => $number++,
        'client_id'    => Client::all()->random()->id
    ];
});

$factory->define(OrderDetail::class, function (Faker $faker) {

    return [
        'pizza_quantity' => $faker->numberBetween(1, 5),
        'pizza_id'       => Pizza::all()->random()->id,
        'order_id'       => Order::all()->random()->id
    ];
});
