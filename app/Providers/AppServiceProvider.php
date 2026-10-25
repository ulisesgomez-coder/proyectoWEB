<?php

namespace App\Providers;

use App\Models\Administrador;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Operaciones permitidas para cada nivel.
        $permisos = [
            'consultar' => [1, 2, 3],
            'crear' => [2, 3],
            'editar' => [2, 3],
            'eliminar' => [3],
            'restaurar' => [3],
            'eliminar-definitivamente' => [3],
            'administrar-cuentas' => [3],
        ];

        foreach ($permisos as $operacion => $nivelesPermitidos) {
            Gate::define(
                $operacion,
                function ($usuario) use ($nivelesPermitidos): bool {
                    return $usuario instanceof Administrador
                        && $usuario->activo
                        && in_array(
                            $usuario->nivel,
                            $nivelesPermitidos,
                            true
                        );
                }
            );
        }
    }
}