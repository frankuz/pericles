<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\Institucion;
use Illuminate\Http\Request;

class SedeController extends Controller
{

    public function index(string $institucion_dane)
    {
        $sedes = Sede::where('institucion_dane', $institucion_dane)
                      ->get(); 
        $institucion = Institucion::where('dane', $institucion_dane)->first();
        return view('sedes.index', [
            'sedes' => $sedes,
            'institucion_dane' => $institucion_dane,
            'institucion' => $institucion // Pasamos el objeto
        ]);
        // <a href="{{ route('instituciones.sedes.index', ['institucion_dane' => $institucion->dane]) }}">
        //     Ver Sedes
        // </a>
    }

    public function create()
    {
        return view('sedes.create');
    }

    public function show(Sede $sede)
    {
        return view('sedes.show', compact('sede'));
    }

    public function edit(Sede $sede)
    {
        return view('sedes.edit', compact('sede'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'institucion_dane' => 'required|char:12|exists:instituciones,dane', // Clave foránea
            'dane_sede' => 'required|char:12|unique:sedes,dane_sede',
            'nombre_sineb' => 'required|string|max:100',
            'nombre' => 'required|string|max:100',
            'zona' => 'required|string|max:10',
            'estado' => 'required|string|max:20',
            'es_principal' => 'required|boolean',
        ]);

        Sede::create($validatedData);

        return redirect()->route('sedes.index')->with('success', 'Sede creada.');
    }

    public function update(Request $request, Sede $sede)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'zona'   => 'required|string|max:10',
            'estado' => 'required|string|max:20',
        ]);
        
        $sede->update($validatedData);

        return redirect()->route('sedes.show', $sede)
            ->with('success', 'Sede actualizada exitosamente.');
    }

    public function destroy(Sede $sede)
    {
        $sede->delete();

        return redirect()->route('sedes.index')->with('success', 'Sede eliminada exitosamente.');
    }
}
