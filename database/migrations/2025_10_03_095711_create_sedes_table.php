<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->char('institucion_dane', 12);
            $table->char('dane', 12)->unique();
            $table->string('nombre_sineb', 100)->nullable();
            $table->string('nombre', 100); 
            $table->string('zona', 10);
            $table->string('estado', 20);
            $table->boolean('es_principal');
            $table->timestamps();

            $table->foreign('institucion_dane')
                  ->references('dane')
                  ->on('instituciones')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sedes');
    }
};
