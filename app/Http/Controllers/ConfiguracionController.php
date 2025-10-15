<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones = Configuracion::all();
        return view('configuraciones.index', compact('configuraciones'));
    }

    public function create()
    {
        return view('configuraciones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'variable' => [
                'required', 
                'string', 
                'max:255', 
                'unique:configuraciones,variable',
                'regex:/^[a-z0-9-]+$/',
            ],
            'valor' => 'required|string',
        ]);

        Configuracion::create($validated);

        return redirect()->route('configuraciones.index')->with('success', 'Configuración creada.');
    }

    public function show(Configuracion $configuracion)
    {
        return view('configuraciones.show', compact('configuracion'));
    }

    public function edit(Configuracion $configuracion)
    {
        return view('configuraciones.edit', compact('configuracion'));
    }

    public function update(Request $request, Configuracion $configuracion)
    {
        $validated = $request->validate([
            'variable' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('configuraciones', 'variable')->ignore($configuracion->variable, 'variable'),
                'regex:/^[a-z0-9-]+$/',
            ],
            'valor' => 'required|string',
        ]);

        $configuracion->update($validated);

        return redirect()->route('configuraciones.index')->with('success', 'Configuración actualizada.');
    }

    public function destroy(Configuracion $configuracion)
    {
        $configuracion->delete();

        return redirect()->route('configuraciones.index')->with('success', 'Configuración eliminada.');
    }
}
