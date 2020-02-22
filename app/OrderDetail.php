<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'pizza_quantity',
        'pizza_id',
        'order_id'
    ];
}
