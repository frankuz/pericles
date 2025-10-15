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
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id(); // id

            // --- Campos de Identificación y Fechas ---
            $table->char('dane', 12)->unique();
            $table->string('nombre', 150); // nombre, string, máx 150 caracteres
            $table->string('estado', 20)->nullable(); // estado, string, máx 20 caracteres
            $table->string('fecha_inicio', 10)->nullable(); // fecha_inicio, date
            $table->string('fecha_cierre', 10)->nullable(); // fecha_cierre, date

            // --- Relaciones y Ubicación ---
            $table->foreignId('grupo_id')->nullable()->constrained('grupos')->onDelete('set null'); // id_grupo, relaciona con tabla 'grupos'
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('restrict'); // id_departamento
            $table->foreignId('municipio_id')->constrained('municipios')->onDelete('restrict'); // id_municipio

            $table->string('corregimiento', 50)->nullable();
            $table->string('vereda', 50)->nullable();
            $table->string('barrio', 50)->nullable();
            $table->string('direccion', 50)->nullable();
            $table->string('geolocalizacion', 80)->nullable();
            
            // --- Tipos y Sedes ---
            $table->boolean('es_rural')->default(false); // es_rural, bool
            $table->boolean('es_urbana')->default(false); // es_urbana, bool
            $table->integer('sedes')->default(1); // sedes, integer

            // --- Contacto ---
            $table->string('telefono', 50)->nullable();
            $table->string('celular', 50)->nullable();
            $table->string('email', 120)->unique()->nullable();
            $table->string('web', 120)->nullable();
            $table->string('facebook', 30)->nullable();
            $table->string('instagram', 30)->nullable();

            // --- Personal Directivo ---
            $table->string('rector', 100)->nullable();
            $table->string('rector_celular', 50)->nullable();
            $table->string('rector_email', 50)->nullable();
            $table->string('coordinador', 100)->nullable();
            $table->string('coordinador_celular', 50)->nullable();
            $table->string('coordinador_email', 50)->nullable();

            // --- Estadísticas (enteros) ---
            $table->integer('estudiantes')->default(0);
            $table->integer('familias')->default(0);
            $table->integer('docentes')->default(0);
            $table->integer('directivos')->default(0);
            $table->integer('orientadores')->default(0);
            $table->integer('administrativos')->default(0);
            $table->integer('servicios')->default(0);
            
            // --- Jornadas y Niveles (booleanos) ---
            $table->boolean('jornada_manana')->default(false);
            $table->boolean('jornada_tarde')->default(false);
            $table->boolean('jornada_noche')->default(false);
            $table->boolean('jornada_unica')->default(false);
            $table->boolean('nivel_preescolar')->default(false);
            $table->boolean('nivel_primaria')->default(false);
            $table->boolean('nivel_secundaria')->default(false);
            $table->boolean('nivel_media')->default(false);

            // --- Campos de Texto Largo ---
            $table->text('modalidades')->nullable(); // modalidades, texto largo
            $table->text('observaciones')->nullable(); // observaciones, texto largo
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
