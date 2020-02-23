<?php

// Usuario cliente

namespace App;

use App\Scopes\ClientScope;

class Client extends User
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ClientScope);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
