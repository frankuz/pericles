<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\KpiCategoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kpis = Kpi::all();
        return view('kpis.index', compact('kpis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = KpiCategoria::orderBy('orden')->get();
        return view('kpis.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Kpi::create($validated);

        return redirect()->route('kpis.index')->with('success', 'KPI creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kpi $kpi)
    {
        return view('kpis.show', compact('kpi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kpi $kpi)
    {
        $categorias = KpiCategoria::orderBy('orden')->get();
        return view('kpis.edit', compact('kpi', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kpi $kpi)
    {
        // Reglas de validación, ajustando 'codigo' y 'frecuencia' para la actualización
        $rules = $this->rules($kpi->id);
        
        $validated = $request->validate($rules);

        $kpi->update($validated);

        return redirect()->route('kpis.index')->with('success', 'KPI actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kpi $kpi)
    {
        $kpi->delete();

        return redirect()->route('kpis.index')->with('success', 'KPI eliminado exitosamente.');
    }
    
    protected function rules(int $kpiId = null): array
    {
        return [
            'kpi_categoria_id' => 'required|integer|exists:kpi_categorias,id', 

            'codigo' => [
                'nullable', 
                'string', 
                'max:20', 
                Rule::unique('kpis', 'codigo')->ignore($kpiId)
            ],
            'nombre' => 'required|string|max:50',
            'unidad' => 'required|string|max:20',
            
            // Tendencia Esperada (Enumeración)
            'tendencia_esperada' => [
                'required', 
                Rule::in(['CRECIENTE', 'DECRECIENTE', 'OBJETIVO'])
            ],
            
            // Frecuencia: Número entero entre 1 y 12
            'frecuencia' => 'required|integer|min:1|max:12',
            
            'descripcion' => 'nullable|string',
            'formula' => 'nullable|string',
            
            // Valores Decimales (Opcionales)
            'valor_minimo' => 'nullable|numeric|decimal:0,2',
            'valor_maximo' => 'nullable|numeric|decimal:0,2',
            'meta' => 'nullable|numeric|decimal:0,2',
        ];
    }

}
