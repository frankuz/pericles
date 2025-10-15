<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'abreviatura',
        'codigo_iso',
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

    public function instituciones()
    {
        return $this->hasMany(Institucion::class);
    }
}
