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
Route::get('/new-order', 'HomeController@new')->name('home');
Route::get('/last-order', 'HomeController@orderNumber');
Route::get('/configs', 'HomeController@config');
Route::get('/users', 'HomeController@users')->name('users');
Route::get('clients/usual', 'Client\ClientController@usual'); // Clientes frecuentes
Route::get('clients/spended', 'Client\ClientController@spended'); // Clientes que más gastan
Route::get('ingredients/popular', 'Ingredient\IngredientController@popular'); // Ingredientes más populares
Route::put('administrators/{administrator}/reset', 'Administrator\AdministratorController@resetPassword'); // Restablecer contraseña de usuario
Route::put('administrators/{administrator}/disable', 'Administrator\AdministratorController@disable'); // Desactivar usuario
Route::put('administrators/{administrator}/enable', 'Administrator\AdministratorController@enable'); // Activar usuario

Route::resource('clients.orders', 'Client\ClientOrderController', ['except' => ['create', 'edit']]);
Route::resource('ingredients', 'Ingredient\IngredientController', ['except' => ['create', 'edit']]);
Route::resource('pizzas', 'Pizza\PizzaController', ['except' => ['create', 'edit']]);
Route::resource('pizzas.pizza-details', 'Pizza\PizzaDetailController', ['only' => ['index']]);
Route::resource('branch-offices', 'BranchOffice\BranchOfficeController', ['except' => ['create', 'edit']]);
Route::resource('orders', 'Order\OrderController', ['except' => ['create', 'edit']]);
Route::resource('orders.order-details', 'Order\OrderDetailController', ['except' => ['create', 'edit']]);
Route::resource('orders.pizzas', 'Order\OrderPizzaController', ['only' => ['index']]);
Route::resource('orders.pizzas.order-details', 'Order\OrderPizzaDetailController', ['only' => ['store']]);
Route::resource('pizzas.ingredients.pizza-details', 'Pizza\PizzaIngredientDetailController', ['only' => ['store']]);
Route::resource('administrators', 'Administrator\AdministratorController', ['except' => ['create', 'edit']]);
