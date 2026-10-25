<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('listas_deseos', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('usuario_id')->unique()->constrained('usuarios')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
        });

        Schema::create('productos_lista_deseos', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('lista_deseos_id')->constrained('listas_deseos')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->foreignId('producto_id')->constrained('productos')->cascadeOnDelete()->cascadeOnUpdate();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->unique(['lista_deseos_id', 'producto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos_lista_deseos');
        Schema::dropIfExists('listas_deseos');
    }
};
