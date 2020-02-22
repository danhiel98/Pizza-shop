<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchOffice extends Model
{
    use SoftDeletes; // Para que no se eliminen los registros de la BD

    protected $dates = [ 'deleted_at' ]; // Para que convierta la fecha en un objeto de Carbon

    protected $fillable = [
        'name',
        'address'
    ];
}
