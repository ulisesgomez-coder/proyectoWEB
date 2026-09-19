<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public const CREATED_AT = 'creado_en';
    public const UPDATED_AT = 'actualizado_en';

    protected $guarded = [];

    protected $hidden = [
        'contrasena',
        'token_recordar',
    ];

    protected function casts(): array
    {
        return [
            'correo_verificado_en' => 'datetime',
            'creado_en' => 'datetime',
            'actualizado_en' => 'datetime',
            'eliminado_en' => 'datetime',
        ];
    }

    public function huertosPropios(): HasMany
    {
        return $this->hasMany(
            Huerto::class,
            'propietario_id'
        );
    }
}