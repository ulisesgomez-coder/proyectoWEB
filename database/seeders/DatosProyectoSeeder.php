<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatosProyectoSeeder extends Seeder
{
    public function run(): void
    {
        // Roles

        DB::table('roles')->updateOrInsert(
            ['id' => 1],
            [
                'nombre' => 'administrador',
                'descripcion' => 'Responsable de administrar la plataforma',
                'creado_en' => now(),
                'actualizado_en' => now(),
            ]
        );

        DB::table('roles')->updateOrInsert(
            ['id' => 2],
            [
                'nombre' => 'productor',
                'descripcion' => 'Responsable de administrar un huerto',
                'creado_en' => now(),
                'actualizado_en' => now(),
            ]
        );

        DB::table('roles')->updateOrInsert(
            ['id' => 3],
            [
                'nombre' => 'cliente',
                'descripcion' => 'Usuario que consulta y adquiere productos',
                'creado_en' => now(),
                'actualizado_en' => now(),
            ]
        );

        // Usuarios

        for ($numero = 1; $numero <= 10; $numero++) {
            DB::table('usuarios')->updateOrInsert(
                ['id' => $numero],
                [
                    'rol_id' => $numero === 1 ? 1 : ($numero <= 5 ? 2 : 3),
                    'nombres' => 'Usuario '.$numero,
                    'apellidos' => 'Demostración',
                    'correo' => 'usuario'.$numero.'@huertosurbanos.mx',
                    'correo_verificado_en' => now(),
                    'contrasena' => Hash::make('password'),
                    'telefono' => '33123456'.str_pad(
                        (string) $numero,
                        2,
                        '0',
                        STR_PAD_LEFT
                    ),
                    'estado' => 'activo',
                    'token_recordar' => null,
                    'creado_en' => now(),
                    'actualizado_en' => now(),
                    'eliminado_en' => null,
                ]
            );
        }

        // Huertos

        $ciudades = [
            'Guadalajara',
            'Tonalá',
            'Zapopan',
            'Tlaquepaque',
            'Tlajomulco',
        ];

        for ($numero = 1; $numero <= 10; $numero++) {
            DB::table('huertos')->updateOrInsert(
                ['id' => $numero],
                [
                    'propietario_id' => (($numero - 1) % 5) + 1,
                    'nombre' => 'Huerto Urbano '.$numero,
                    'descripcion' => 'Espacio comunitario dedicado al cultivo de productos frescos.',
                    'direccion' => 'Calle del Cultivo número '.$numero,
                    'ciudad' => $ciudades[($numero - 1) % count($ciudades)],
                    'latitud' => 20.6500000 + ($numero / 1000),
                    'longitud' => -103.3500000 - ($numero / 1000),
                    'area_m2' => 100 + ($numero * 25),
                    'estado' => $numero === 10 ? 'inactivo' : 'activo',
                    'creado_en' => now(),
                    'actualizado_en' => now(),
                    'eliminado_en' => null,
                ]
            );
        }
    }
}