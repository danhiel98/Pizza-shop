<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'         => (int)$user->id,
            'name'       => (string)$user->name,
            'email'      => (string)$user->email,
            'created_at' => (string)$user->created_at
        ];
    }
}
