<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiCategoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'orden',
    ];

    protected $table = 'kpi_categorias';
    public function kpis()
    {
        return $this->hasMany(Kpi::class, 'kpi_categoria_id');
    }
    
}