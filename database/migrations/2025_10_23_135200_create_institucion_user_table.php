<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institucion_user', function (Blueprint $table) {
            
            $table->foreignId('institucion_id')
                  ->constrained(
                      table: 'instituciones', 
                      column: 'id'
                  )
                  ->onDelete('cascade');
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->primary(['institucion_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institucion_user');
    }
};
