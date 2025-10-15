<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\ClimaParticipanteController;
use App\Http\Controllers\ConfiguracionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('splash');
});
// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/{encuesta_id}/{accion?}', [ClimaParticipanteController::class, 'handle'])
    ->where(['encuesta_id' => '[0-9]+', 'accion' => 'cerrar-sesion|reporte'])
    ->name('clima_participante.handle');
Route::resource('clima-participantes', ClimaParticipanteController::class)->only(['store']); 
Route::post('/clima/guardar-dimension', [ClimaParticipanteController::class, 'saveDim'])->name('clima-participantes.save_dim');
// Route::get('/clima/cerrar-sesion', [ClimaParticipanteController::class, 'closeSession'])->name('clima-participantes.close_session');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('departamentos', DepartamentoController::class);
    Route::resource('municipios', MunicipioController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('instituciones', InstitucionController::class)->parameters(['instituciones' => 'institucion']);
    Route::get('instituciones/{institucion_dane}/sedes', [SedeController::class, 'index'])->name('instituciones.sedes.index');
    Route::resource('sedes', SedeController::class);
    Route::resource('configuraciones', ConfiguracionController::class)->parameters(['configuraciones' => 'configuracion']);;
});
Route::get('penguin', function () { return view('penguin'); });
// Route::get('/institucion', [InstitucionController::class, 'show'])->name('institucion.show');
// Route::resource('instituciones', InstitucionController::class)
        // ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

require __DIR__.'/auth.php'; 
