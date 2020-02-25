<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('lang/{locale}', 'LocalizationController@index');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('clients.orders', 'Client\ClientOrderController', ['except' => ['store', 'edit']]);
Route::resource('ingredients', 'Ingredient\IngredientController', ['except' => ['store', 'edit']]);
Route::resource('pizzas', 'Pizza\PizzaController', ['except' => ['store', 'edit']]);
Route::resource('pizzas.pizza-details', 'Pizza\PizzaDetailController', ['only' => ['index']]);
Route::resource('branch-offices', 'BranchOffice\BranchOfficeController', ['except' => ['store', 'edit']]);
Route::resource('orders', 'Order\OrderController', ['except' => ['store', 'edit']]);
Route::resource('orders.order-details', 'Order\OrderDetailController', ['except' => ['store', 'edit']]);
Route::resource('orders.pizzas', 'Order\OrderPizzaController', ['only' => ['index']]);
