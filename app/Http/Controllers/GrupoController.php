<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with('user')->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $asesores = User::where('rol', 'ASESOR')->orderBy('name')->get();
        return view('grupos.create', compact('asesores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            // Aseguramos que el ID exista en la tabla users Y que tenga el rol 'ASESOR'
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        if ($user->rol !== 'ASESOR') {
             return back()->withInput()->withErrors(['user_id' => 'El usuario seleccionado debe tener el rol de ASESOR.']);
        }

        Grupo::create($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo creado exitosamente.');
    }

    public function show(Grupo $grupo)
    {
        return view('grupos.show', compact('grupo'));
    }

    public function edit(Grupo $grupo)
    {
        $asesores = User::where('rol', 'ASESOR')->orderBy('name')->get();
        return view('grupos.edit', compact('grupo', 'asesores'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $user = User::findOrFail($request->user_id);
        if ($user->rol !== 'ASESOR') {
             return back()->withInput()->withErrors(['user_id' => 'El usuario seleccionado debe tener el rol de ASESOR.']);
        }

        $grupo->update($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado exitosamente.');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
