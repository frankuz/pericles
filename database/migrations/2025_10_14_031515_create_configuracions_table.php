<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->string('variable', 255)->unique();
            $table->text('valor');
            $table->timestamps();
            $table->primary('variable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};
