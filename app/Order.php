<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
        'order_number',
        'client_id'
    ];

    public function getClient(){
        return $this->hasOne(Client::class);
    }
}
