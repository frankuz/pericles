<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiReporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_id',
        'institucion_id',
        'anio',
        'periodo',
        'medicion',
        'observaciones',
        'responsable',
    ];

    /**
     * Get the KPI that this report belongs to.
     */
    public function kpi()
    {
        return $this->belongsTo(Kpi::class);
    }
    
    /**
     * Get the Institution that made this report (Assuming Institution model exists).
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }
}
