<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'user_id',
    ];
    
    // Relación Inversa (el facilitador)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instituciones()
    {
        return $this->hasMany(Institucion::class);
    }
}
