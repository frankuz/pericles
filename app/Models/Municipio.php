<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'provincia',
        'departamento_id',
    ];
    
    // Relación Inversa
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function instituciones()
    {
        return $this->hasMany(Institucion::class);
    }
}
