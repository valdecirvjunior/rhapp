<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'name',
        'idCargo',
        'idade',
        'sexo',
        'endereco',
        'avatar',
    ];
}
