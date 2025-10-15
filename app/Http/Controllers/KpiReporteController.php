<?php

namespace App\Http\Controllers;

use App\Models\KpiReporte;
use App\Models\Kpi; // Necesario para obtener datos para vistas
use App\Models\Institucion; // Asumiendo que el modelo existe
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KpiReporteController extends Controller
{
    // ... métodos index, show, destroy (estándar) ...

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Enviar datos necesarios para los dropdowns
        $kpis = Kpi::all();
        $instituciones = Institucion::all(); // Asumiendo que el modelo existe
        
        return view('kpi_reportes.create', compact('kpis', 'instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        KpiReporte::create($validated);

        return redirect()->route('kpi_reportes.index')->with('success', 'Reporte de KPI creado exitosamente.');
    }

    // ... métodos edit, update (estándar) ...

    /**
     * Define las reglas de validación.
     */
    protected function rules(int $reporteId = null): array
    {
        return [
            // Claves Foráneas
            'kpi_id' => 'required|integer|exists:kpis,id',
            'institucion_id' => 'required|integer|exists:instituciones,id',
            
            // Datos
            'anio' => 'required|integer|min:2000|max:' . (date('Y') + 1), // Limitar el año
            'periodo' => 'required|integer|min:1|max:12', // Asumimos un máximo de 12 periodos (mensual)
            'medicion' => 'required|numeric|decimal:0,2',
            'observaciones' => 'nullable|string',
            'responsable' => 'required|string|max:50',

            // UNIQUE: Combinación de estos campos debe ser única (evita reportes duplicados)
            'kpi_id' => Rule::unique('kpi_reportes')->where(function ($query) use ($request, $reporteId) {
                return $query->where('anio', $request->anio)
                             ->where('periodo', $request->periodo)
                             ->where('institucion_id', $request->institucion_id)
                             ->ignore($reporteId);
            }),
        ];
    }
}
