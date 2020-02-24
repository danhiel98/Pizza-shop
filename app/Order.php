<?php

namespace App;

use App\Transformers\OrderTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public $transformer = OrderTransformer::class;

    protected $dates = [ 'deleted_at' ];

    protected $hidden = ['pivot'];

    protected $fillable = [
        'order_number',
        'client_id'
    ];

    public function getDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'order_details', 'order_id', 'pizza_id');
    }

}
