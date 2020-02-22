<?php

namespace App;

use App\Scopes\UserScope;

class User extends Person
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }
}
