<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimaRespuesta extends Model
{
    use HasFactory;
    public $timestamps = false; 

    protected $fillable = [
        'respuesta', // 0 a 4
        'clima_participante_id',
        'clima_item_id',
    ];

    /**
     * Relación: Una respuesta pertenece a un Participante.
     */
    public function participante()
    {
        return $this->belongsTo(ClimaParticipante::class, 'clima_participante_id');
    }

    /**
     * Relación: Una respuesta pertenece a un Ítem (pregunta).
     */
    public function item()
    {
        return $this->belongsTo(ClimaItem::class, 'clima_item_id');
    }
}
