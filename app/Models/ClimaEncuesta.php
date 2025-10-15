<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimaEncuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'anio',
        'estado',
        'valido',
        'clave',
        'institucion_id',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'valido' => 'boolean',
    ];

    /**
     * Relación: Una encuesta pertenece a una Institución.
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    /**
     * Relación: Una encuesta tiene muchos participantes.
     */
    public function participantes()
    {
        return $this->hasMany(ClimaParticipante::class);
    }
}
