<?php

namespace App;

use App\Scopes\ClientScope;

class Client extends Person
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ClientScope);
    }
}
