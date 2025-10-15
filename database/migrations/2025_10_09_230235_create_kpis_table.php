<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            
            $table->string('codigo', 20)->nullable()->unique(); // Opcional, máximo 20, único
            $table->string('nombre', 50); // Obligatorio, máximo 50
            $table->string('unidad', 20); // Obligatorio, máximo 20
            $table->enum('tendencia_esperada', ['CRECIENTE', 'DECRECIENTE', 'OBJETIVO']); // Obligatorio
            $table->unsignedTinyInteger('frecuencia')->default(1); // Obligatorio, 1 a 12
            $table->text('descripcion')->nullable(); // Opcional
            $table->text('formula')->nullable(); // Opcional
            $table->decimal('valor_minimo', 10, 2)->nullable(); // Total 10 dígitos, 2 decimales
            $table->decimal('valor_maximo', 10, 2)->nullable(); // Opcional
            $table->decimal('meta', 10, 2)->nullable(); // Opcional
            $table->foreignId('kpi_categoria_id')
                  ->constrained('kpi_categorias')
                  ->onUpdate('cascade')
                  ->onDelete('restrict'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis');
    }
};
