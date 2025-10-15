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
        Schema::table('users', function (Blueprint $table) {
            // Usa foreignId() para asegurar el tipo de dato (BIGINT UNSIGNED)
            $table->foreignId('institucion_id')
                  ->nullable()
                  ->constrained('instituciones') // Referencia a la tabla 'instituciones'
                  ->onDelete('set null')        // Si la institución se elimina, el campo se pone a NULL
                  ->after('rol'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Necesitas eliminar la restricción antes de eliminar la columna
            $table->dropConstrainedForeignId('institucion_id');
        });
    }
};
