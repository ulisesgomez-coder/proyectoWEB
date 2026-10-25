<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    protected $table = 'administradors';

    protected $fillable = [
        'nombre_completo',
        'usuario',
        'email',
        'password',
        'activo',
        'nivel',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'nivel' => 'integer',
        ];
    }
}
