<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return view('departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:2|unique:departamentos,codigo',
            'nombre' => 'required|string|max:5',
            'abreviatura' => 'nullable|string|max:3',
            'codigo_iso' => 'nullable|string|max:6',
        ]);

        Departamento::create($request->all());

        return redirect()->route('departamentos.index')->with('success', 'Departamento creado exitosamente.');
    }

    public function show(Departamento $departamento)
    {
        return view('departamentos.show', compact('departamento'));
    }

    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit', compact('departamento'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'codigo' => 'required|string|max:2|unique:departamentos,codigo,' . $departamento->id,
            'nombre' => 'required|string|max:50',
            'abreviatura' => 'nullable|string|max:3',
            'codigo_iso' => 'nullable|string|max:6',
        ]);

        $departamento->update($request->all());

        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado exitosamente.');
    }

    public function destroy(Departamento $departamento)
    {
        $departamento->delete();

        return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado exitosamente.');
    }
}
