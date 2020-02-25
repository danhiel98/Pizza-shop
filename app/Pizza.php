<?php

namespace App;

use App\Transformers\PizzaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use SoftDeletes;

    public $transformer = PizzaTransformer::class;

    protected $dates = [ 'deleted_at' ];

    protected $hidden = ['pivot'];

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

    public function getPriceAttribute()
    {
        $details = $this->pizzaDetails;

        $total = $this->base_price;
        foreach ($details as $detail){
            $total += $detail->ingredient_price * $detail->ingredient_quantity;
        }

        return $total;
    }
}
