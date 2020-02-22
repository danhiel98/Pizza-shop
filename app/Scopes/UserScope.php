<?php

namespace App\Scopes;

use App\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type', Person::NORMAL_USER); // Los usuarios normales (administradores del sistema)
    }
}
