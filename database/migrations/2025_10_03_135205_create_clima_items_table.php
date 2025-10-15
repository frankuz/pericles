<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clima_items', function (Blueprint $table) {
            $table->id();
            
            // Campos del Ítem (Pregunta)
            $table->tinyInteger('dim'); // Número de dos cifras
            $table->string('dimension', 40);
            $table->tinyInteger('asp'); // Número de dos cifras
            $table->string('aspecto', 40);
            $table->string('item', 150);
            $table->string('estamento', 15);
            $table->string('escala', 15);
            $table->char('tendencia', 3); // 3 caracteres exactos
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clima_items');
    }
};
