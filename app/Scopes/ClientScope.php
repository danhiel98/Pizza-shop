<?php

namespace App\Scopes;

use App\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class ClientScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type', Person::CLIENT_USER); // Devuelve solamente los usuarios que sean clientes
    }
}
