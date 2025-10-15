<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clima_participantes', function (Blueprint $table) {
            $table->id();
            
            // Campos del Participante
            $table->string('estamento', 15);
            $table->ipAddress('ip'); // Tipo de dato IP
            $table->boolean('completado')->default(false);
            
            // Claves Foráneas
            $table->foreignId('clima_encuesta_id')->constrained('clima_encuestas')->onDelete('restrict');
            $table->foreignId('sede_id')->constrained('sedes')->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clima_participantes');
    }
};
