<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carritos', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('usuario_id')->unique()->constrained('usuarios')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
        });

        Schema::create('productos_carrito', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('carrito_id')->constrained('carritos')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->foreignId('producto_id')->constrained('productos')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->decimal('cantidad', 12, 3)->unsigned();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->unique(['carrito_id', 'producto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos_carrito');
        Schema::dropIfExists('carritos');
    }
};
