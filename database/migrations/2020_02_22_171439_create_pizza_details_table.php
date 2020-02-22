<?php

// Tabla de detalle de pizza

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_details', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('ingredient_price', 4,2);
            $table->integer('ingredient_quantity');
            $table->integer('pizza_id')->unsigned();
            $table->integer('ingredient_id')->unsigned();
            $table->timestamps();

            $table->foreign('pizza_id')->references('id')->on('pizzas')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_details');
    }
}
