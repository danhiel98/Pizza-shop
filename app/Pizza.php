<?php

namespace App;

use App\Transformers\PizzaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Pizza extends Model
{
    use SoftDeletes;
    use SearchableTrait;

    public $transformer = PizzaTransformer::class;

    protected $dates = [ 'deleted_at' ];

    protected $hidden = ['pivot'];

    protected $searchable = [
        'columns' => [
            'pizzas.name' => 10
        ]
    ];

    protected $fillable = [
        'name',
        'base_price'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function pizzaDetails()
    {
        return $this->hasMany(PizzaDetail::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'pizza_id', 'order_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'order_details', 'pizza_id', 'ingredient_id');
    }

    public function getIngredientsPriceAttribute()
    {
        $details = $this->pizzaDetails;

        $total = 0;
        foreach ($details as $detail){
            $total += $detail->ingredient_price * $detail->ingredient_quantity;
        }

        return $total;
    }

    public function getPriceAttribute()
    {
        return $this->base_price + $this->ingredients_price;
    }
}
