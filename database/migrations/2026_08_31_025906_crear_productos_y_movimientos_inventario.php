<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('huerto_id')->constrained('huertos')->restrictOnDelete()->cascadeOnUpdate();
            $tabla->string('nombre', 150);
            $tabla->text('descripcion')->nullable();
            $tabla->string('unidad', 20)->default('kg');
            $tabla->decimal('precio_unitario', 10, 2)->unsigned()->default(0);
            $tabla->decimal('existencias', 12, 3)->unsigned()->default(0);
            $tabla->decimal('existencias_minimas', 12, 3)->unsigned()->default(0);
            $tabla->date('fecha_cosecha')->nullable();
            $tabla->date('disponible_hasta')->nullable();
            $tabla->string('ruta_imagen')->nullable();
            $tabla->string('estado', 20)->default('disponible')->index();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->softDeletes('eliminado_en');
            $tabla->index(['huerto_id', 'nombre']);
        });

        Schema::create('movimientos_inventario', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('producto_id')->constrained('productos')->restrictOnDelete()->cascadeOnUpdate();
            $tabla->foreignId('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete()->cascadeOnUpdate();
            $tabla->string('tipo', 20);
            $tabla->decimal('cantidad', 12, 3);
            $tabla->decimal('existencias_resultantes', 12, 3)->unsigned();
            $tabla->string('motivo')->nullable();
            $tabla->nullableMorphs('referencia');
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->index(['producto_id', 'creado_en']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos_inventario');
        Schema::dropIfExists('productos');
    }
};