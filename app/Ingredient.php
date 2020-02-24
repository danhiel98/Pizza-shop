<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
        'name',
        'price'
    ];

    public function pizzaDetails()
    {
        return $this->hasMany(PizzaDetail::class);
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_details', 'ingredient_id', 'pizza_id');
    }
}
