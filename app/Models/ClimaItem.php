<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimaItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'dim',
        'dimension',
        'asp',
        'aspecto',
        'item',
        'estamento',
        'escala',
        'tendencia',
    ];

    /**
     * Relación: Un ítem tiene muchas respuestas.
     */
    public function respuestas()
    {
        return $this->hasMany(ClimaRespuesta::class);
    }
}
