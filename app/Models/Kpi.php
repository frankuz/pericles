<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'nombre',
        'unidad',
        'tendencia_esperada',
        'frecuencia',
        'descripcion',
        'formula',
        'valor_minimo',
        'valor_maximo',
        'meta',
        'kpi_categoria_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kpis';

    
    public function categoria()
    {
        return $this->belongsTo(KpiCategoria::class, 'kpi_categoria_id');
    }

     public function reportes()
    {
        // Un KPI tiene muchos reportes
        return $this->hasMany(KpiReporte::class, 'kpi_id');
    }


}
