<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;
    protected $table = 'instituciones';

    protected $fillable = [
        'dane', 'nombre', 'estado', 'fecha_inicio', 'fecha_cierre',
        'grupo_id', 'departamento_id', 'municipio_id',
        'corregimiento', 'vereda', 'barrio', 'direccion', 'geolocalizacion',
        'es_rural', 'es_urbana', 'sedes',
        'telefono', 'celular', 'email', 'web', 'facebook', 'instagram',
        'rector', 'rector_celular', 'rector_email',
        'coordinador', 'coordinador_celular', 'coordinador_email',
        'estudiantes', 'familias', 'docentes', 'directivos', 'orientadores', 'administrativos', 'servicios',
        'jornada_manana', 'jornada_tarde', 'jornada_noche', 'jornada_unica',
        'nivel_preescolar', 'nivel_primaria', 'nivel_secundaria', 'nivel_media',
        'modalidades', 'observaciones',
    ];

    protected $casts = [
        'es_rural' => 'boolean',
        'es_urbana' => 'boolean',
        'jornada_manana' => 'boolean',
        'jornada_tarde' => 'boolean',
        'jornada_noche' => 'boolean',
        'jornada_unica' => 'boolean',
        'nivel_preescolar' => 'boolean',
        'nivel_primaria' => 'boolean',
        'nivel_secundaria' => 'boolean',
        'nivel_media' => 'boolean',
    ];
    
    // Aquí definiríamos las relaciones:

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function sedes()
    {
        return $this->hasMany(Sede::class, 'institucion_dane', 'dane');
    }

    public function climaEncuestas()
    {
        return $this->hasMany(ClimaEncuesta::class);
    }

    public function kpiReportes()
    {
        return $this->hasMany(KpiReporte::class, 'institucion_id');
    }
}
