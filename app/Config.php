<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\DefaultTransformer;

class Config extends Model
{
    public $transformer = DefaultTransformer::class;

    protected $fillable = [
        'business_name',
        'pizza_base_price'
    ];
}
