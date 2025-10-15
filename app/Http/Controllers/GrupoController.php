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
        // FILTRO: Obtener solo usuarios con rol 'Facilitador'
        $facilitadores = User::where('rol', 'Facilitador')->orderBy('name')->get();
        return view('grupos.create', compact('facilitadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            // Aseguramos que el ID exista en la tabla users Y que tenga el rol 'Facilitador'
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        if ($user->rol !== 'Facilitador') {
             return back()->withInput()->withErrors(['user_id' => 'El usuario seleccionado debe tener el rol de Facilitador.']);
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
        // FILTRO: Obtener solo usuarios con rol 'Facilitador'
        $facilitadores = User::where('rol', 'Facilitador')->orderBy('name')->get();
        return view('grupos.edit', compact('grupo', 'facilitadores'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $user = User::findOrFail($request->user_id);
        if ($user->rol !== 'Facilitador') {
             return back()->withInput()->withErrors(['user_id' => 'El usuario seleccionado debe tener el rol de Facilitador.']);
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
