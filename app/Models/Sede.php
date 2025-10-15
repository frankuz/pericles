<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $fillable = [
        'dane_sede',
        'nombre_sineb',
        'nombre',
        'zona',
        'estado',
        'es_principal'
    ];
    
    protected $casts = [
        'es_principal' => 'boolean',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_dane', 'dane');
    }
}
