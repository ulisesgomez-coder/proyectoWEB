<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->string('nombre', 50)->unique();
            $tabla->string('descripcion')->nullable();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
        });

        Schema::create('usuarios', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('rol_id')->constrained('roles')->restrictOnDelete()->cascadeOnUpdate();
            $tabla->string('nombres', 100);
            $tabla->string('apellidos', 100);
            $tabla->string('correo')->unique();
            $tabla->timestamp('correo_verificado_en')->nullable();
            $tabla->string('contrasena');
            $tabla->string('telefono', 25)->nullable();
            $tabla->string('estado', 20)->default('activo')->index();
            $tabla->string('token_recordar', 100)->nullable();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->softDeletes('eliminado_en');
        });

        Schema::create('cuentas_sociales', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->string('proveedor', 50);
            $tabla->string('usuario_proveedor_id');
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->unique(['proveedor', 'usuario_proveedor_id']);
            $tabla->unique(['usuario_id', 'proveedor']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuentas_sociales');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('roles');
    }
};