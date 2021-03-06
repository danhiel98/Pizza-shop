<?php

namespace App;

use App\Transformers\PizzaDetailTransformer;
use Illuminate\Database\Eloquent\Model;

class PizzaDetail extends Model
{
    public $transformer = PizzaDetailTransformer::class;

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

    public function getTotalAttribute()
    {
        return $this->ingredient_price * $this->ingredient_quantity;
    }
}
