<?php

// Usuario en general

namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $transformer = UserTransformer::class;

    protected $table = 'users';

    public const CLIENT_USER = 'client'; // Si el usuario es un cliente
    public const NORMAL_USER = 'user'; // Si el usuario se encarga de administrar el sistema

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function isAdmin()
    {
        return $this->type === USER::NORMAL_USER;
    }
}
