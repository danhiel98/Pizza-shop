<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];

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
}
