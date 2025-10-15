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
        Schema::create('kpi_reportes', function (Blueprint $table) {
            $table->id();
            
            // Claves Foráneas
            // kpi_id (Vincula cada reporte al KPI que mide)
            $table->foreignId('kpi_id')->constrained('kpis')->onUpdate('cascade')->onDelete('cascade');
            
            // institucion_id (Asume que existe una tabla 'instituciones')
            $table->foreignId('institucion_id')->constrained('instituciones')->onUpdate('cascade')->onDelete('restrict');
            
            // Campos de Datos
            $table->unsignedSmallInteger('anio'); // Año (ej: 2025)
            $table->unsignedSmallInteger('periodo')->nullable(); // Periodo (ej: 1 a 12 o 1 a 4)
            $table->decimal('medicion', 10, 2); // Valor medido con 2 decimales
            $table->text('observaciones')->nullable(); // Descripción
            $table->string('responsable', 50)->nullable(); // Máximo 50

            // Restricción para evitar reportes duplicados para un KPI en un año/periodo
            $table->unique(['kpi_id', 'anio', 'periodo', 'institucion_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_reportes');
    }
};
