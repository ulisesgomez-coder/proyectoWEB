<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ordenes', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->string('folio', 30)->unique();
            $tabla->foreignId('usuario_id')->constrained('usuarios')->restrictOnDelete()->cascadeOnUpdate();
            $tabla->string('tipo', 20)->default('orden');
            $tabla->string('estado', 30)->default('pendiente')->index();
            $tabla->decimal('subtotal', 12, 2)->unsigned()->default(0);
            $tabla->decimal('total', 12, 2)->unsigned()->default(0);
            $tabla->text('notas')->nullable();
            $tabla->timestamp('fecha_solicitud')->nullable();
            $tabla->timestamp('fecha_finalizacion')->nullable();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->index(['usuario_id', 'creado_en']);
        });

        Schema::create('detalles_orden', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('orden_id')->constrained('ordenes')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->foreignId('producto_id')->constrained('productos')->restrictOnDelete()->cascadeOnUpdate();
            $tabla->string('nombre_producto', 150);
            $tabla->string('unidad', 20);
            $tabla->decimal('cantidad', 12, 3)->unsigned();
            $tabla->decimal('precio_unitario', 10, 2)->unsigned();
            $tabla->decimal('total_partida', 12, 2)->unsigned();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->unique(['orden_id', 'producto_id']);
        });

        Schema::create('transacciones', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('orden_id')->constrained('ordenes')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->string('referencia', 100)->nullable()->unique();
            $tabla->string('metodo', 30);
            $tabla->string('estado', 30)->default('pendiente')->index();
            $tabla->decimal('monto', 12, 2)->unsigned();
            $tabla->timestamp('pagado_en')->nullable();
            $tabla->json('respuesta_pasarela')->nullable();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones');
        Schema::dropIfExists('detalles_orden');
        Schema::dropIfExists('ordenes');
    }
};
