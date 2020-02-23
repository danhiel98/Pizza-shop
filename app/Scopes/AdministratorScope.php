<?php

namespace App\Scopes;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class AdministratorScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type', User::NORMAL_USER); // Los usuarios normales (administradores del sistema)
    }
}
