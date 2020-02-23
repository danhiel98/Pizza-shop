<?php

// Usuario administrador del sistema

namespace App;

use App\Scopes\AdministratorScope;

class Administrator extends User
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AdministratorScope);
    }
}
