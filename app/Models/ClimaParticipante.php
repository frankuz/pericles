<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimaParticipante extends Model
{
    use HasFactory;

    protected $fillable = [
        'completado',
        'estamento',
        'ip',
        'clima_encuesta_id',
        'sede_id',
    ];

    protected $casts = [
        'completado' => 'boolean',
    ];

    /**
     * Relación: Un participante pertenece a una Encuesta.
     */
    public function encuesta()
    {
        return $this->belongsTo(ClimaEncuesta::class, 'clima_encuesta_id');
    }

    /**
     * Relación: Un participante pertenece a una Sede.
     */
    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
    
    /**
     * Relación: Un participante tiene muchas respuestas.
     */
    public function respuestas()
    {
        return $this->hasMany(ClimaRespuesta::class);
    }
}
