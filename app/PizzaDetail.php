<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaDetail extends Model
{
    protected $fillable = [
        'pizza_id',
        'ingredient_id',
        'ingredient_price',
        'ingredient_quantity'
    ];
}
