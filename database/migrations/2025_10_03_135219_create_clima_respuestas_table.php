<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clima_respuestas', function (Blueprint $table) {
            $table->unsignedTinyInteger('respuesta'); // Número de 0 a 4
            $table->foreignId('clima_participante_id')->constrained('clima_participantes')->onDelete('restrict');
            $table->foreignId('clima_item_id')->constrained('clima_items')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clima_respuestas');
    }
};
