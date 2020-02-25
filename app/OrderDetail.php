<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\OrderDetailTransformer;

class OrderDetail extends Model
{
    public $transformer = OrderDetailTransformer::class;

    protected $fillable = [
        'pizza_quantity',
        'pizza_id',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function getPizzaPriceAttribute()
    {
        return $this->pizza->price;
    }

    public function getTotalAttribute()
    {
        return $this->pizza->price * $this->pizza_quantity;
    }
}
