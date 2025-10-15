<?php

namespace App\Http\Controllers;

use App\Models\KpiCategoria;
use Illuminate\Http\Request;

class KpiCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = KpiCategoria::orderBy('orden')->get();
        // Lógica para mostrar todas las categorías (ej: vista Inertia o Blade)
        return view('kpi_categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lógica para mostrar el formulario de creación
        return view('kpi_categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:20|unique:kpi_categorias,nombre',
            'orden' => 'required|integer|min:1|max:49|unique:kpi_categorias,orden',
        ]);

        KpiCategoria::create($validated);

        // Redirección después de guardar
        return redirect()->route('kpi_categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KpiCategoria $kpiCategoria)
    {
        // Lógica para mostrar una categoría específica
        return view('kpi_categorias.show', compact('kpiCategoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KpiCategoria $kpiCategoria)
    {
        // Lógica para mostrar el formulario de edición
        return view('kpi_categorias.edit', compact('kpiCategoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KpiCategoria $kpiCategoria)
    {
        // Validación de datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:20|unique:kpi_categorias,nombre,' . $kpiCategoria->id,
            'orden' => 'required|integer|min:1|max:49|unique:kpi_categorias,orden,' . $kpiCategoria->id,
        ]);

        $kpiCategoria->update($validated);

        // Redirección después de actualizar
        return redirect()->route('kpi_categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KpiCategoria $kpiCategoria)
    {
        $kpiCategoria->delete();

        // Redirección después de eliminar
        return redirect()->route('kpi_categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
