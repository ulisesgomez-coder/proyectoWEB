<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notificaciones', function (Blueprint $tabla) {
            $tabla->uuid('id')->primary();
            $tabla->string('tipo');
            $tabla->string('destinatario_tipo');
            $tabla->unsignedBigInteger('destinatario_id');
            $tabla->text('datos');
            $tabla->timestamp('leida_en')->nullable();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->index(['destinatario_tipo', 'destinatario_id']);
        });

        Schema::create('registros_actividad', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->foreignId('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete()->cascadeOnUpdate();
            $tabla->string('accion', 100);
            $tabla->nullableMorphs('entidad');
            $tabla->string('direccion_ip', 45)->nullable();
            $tabla->text('agente_usuario')->nullable();
            $tabla->json('propiedades')->nullable();
            $tabla->timestamp('creado_en')->nullable();
            $tabla->timestamp('actualizado_en')->nullable();
            $tabla->index(['accion', 'creado_en']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros_actividad');
        Schema::dropIfExists('notificaciones');
    }
};
