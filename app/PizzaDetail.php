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

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
