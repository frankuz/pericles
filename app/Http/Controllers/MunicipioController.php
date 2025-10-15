<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Models\Departamento; // ¡Importar Modelo Departamento!
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {
        $municipios = Municipio::with('departamento')->get();
        return view('municipios.index', compact('municipios'));
    }

    public function create()
    {
        $departamentos = Departamento::orderBy('nombre')->get();
        return view('municipios.create', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:5|unique:municipios,codigo',
            'nombre' => 'required|string|max:40',
            'provincia' => 'nullable|string|max:40',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        Municipio::create($request->all());

        return redirect()->route('municipios.index')->with('success', 'Municipio creado exitosamente.');
    }

    public function show(Municipio $municipio)
    {
        return view('municipios.show', compact('municipio'));
    }

    public function edit(Municipio $municipio)
    {
        $departamentos = Departamento::orderBy('nombre')->get();
        return view('municipios.edit', compact('municipio', 'departamentos'));
    }

    public function update(Request $request, Municipio $municipio)
    {
        $request->validate([
            'codigo' => 'required|string|max:5|unique:municipios,codigo,' . $municipio->id,
            'nombre' => 'required|string|max:40',
            'provincia' => 'nullable|string|max:40',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $municipio->update($request->all());

        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado exitosamente.');
    }

    public function destroy(Municipio $municipio)
    {
        $municipio->delete();

        return redirect()->route('municipios.index')->with('success', 'Municipio eliminado exitosamente.');
    }
}
