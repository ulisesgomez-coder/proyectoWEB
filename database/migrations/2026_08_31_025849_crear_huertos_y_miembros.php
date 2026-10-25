<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('huertos', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('propietario_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
            $tabla->string('nombre', 150);
            $tabla->text('descripcion')->nullable();
            $tabla->string('direccion');
            $tabla->string('ciudad', 100)->nullable();
            $tabla->decimal('latitud', 10, 7)->nullable();
            $tabla->decimal('longitud', 10, 7)->nullable();
            $tabla->decimal('area_m2', 10, 2)->nullable();
            $tabla->string('estado', 20)->default('activo')->index();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->softDeletes('eliminado_en');
        });

        Schema::create('huerto_usuario', function (Blueprint $tabla) {
            $tabla->foreignId('huerto_id')->constrained('huertos')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->string('funcion_miembro', 30)->default('miembro');
            $tabla->timestamp('fecha_ingreso')->useCurrent();
            $tabla->primary(['huerto_id', 'usuario_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('huerto_usuario');
        Schema::dropIfExists('huertos');
    }
};