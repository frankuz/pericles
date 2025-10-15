<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clima_encuestas', function (Blueprint $table) {
            $table->id();

            // Campos de la Encuesta
            $table->year('anio'); // Número de 4 cifras (tipo YEAR o CHAR(4))
            $table->boolean('estado');
            $table->boolean('valido');
            $table->char('clave', 4); // 4 caracteres exactos
            
            // Clave Foránea
            $table->foreignId('institucion_id')->constrained('instituciones')->onDelete('restrict');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clima_encuestas');
    }
};
