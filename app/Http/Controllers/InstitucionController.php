<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstitucionController extends Controller
{
    public function index()
    {
        $instituciones = Institucion::with(['departamento', 'municipio', 'grupo'])->paginate(15);
        return view('instituciones.index', compact('instituciones'));
    }

    // public function create()
    // {
    //     $departamentos = Departamento::orderBy('nombre')->get();
    //     $grupos = Grupo::orderBy('nombre')->get();
    //     // Los municipios se cargarán dinámicamente con Alpine/JS en la vista
    //     return view('instituciones.create', compact('departamentos', 'grupos'));
    // }
    public function create()
    {
        $departamentos = Departamento::orderBy('nombre')->get();
        $grupos = Grupo::orderBy('nombre')->get();

        // Usuarios con rol "facilitador"
        $facilitadores = User::where('rol', 'facilitador')
            ->orderBy('name') // opcional, por nombre
            ->get();

        // Los municipios se cargarán dinámicamente con Alpine/JS en la vista
        return view('instituciones.create', compact('departamentos', 'grupos', 'facilitadores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dane' => ['nullable', 'string', 'max:12', Rule::unique('instituciones', 'dane')],
            'nombre' => 'required|string|max:150',
            'estado' => 'nullable|string|max:20',
            'fecha_inicio' => 'nullable|string|max:10', // Mantener como string (o usar date_format si se convierte)
            'fecha_cierre' => 'nullable|string|max:10',
            
            'grupo_id' => 'nullable|exists:grupos,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            
            'corregimiento' => 'nullable|string|max:50',
            'vereda' => 'nullable|string|max:50',
            'barrio' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:50',
            'geolocalizacion' => 'nullable|string|max:80',
            
            'es_rural' => 'boolean',
            'es_urbana' => 'boolean',
            'sedes' => 'integer|min:1',
            
            'telefono' => 'nullable|string|max:50',
            'celular' => 'nullable|string|max:50',
            'email' => ['nullable', 'email', 'max:120', Rule::unique('instituciones', 'email')],
            'web' => 'nullable|string|max:120',
            'facebook' => 'nullable|string|max:30',
            'instagram' => 'nullable|string|max:30',

            'rector' => 'nullable|string|max:100',
            'rector_celular' => 'nullable|string|max:50',
            'rector_email' => 'nullable|string|max:50',
            'coordinador' => 'nullable|string|max:100',
            'coordinador_celular' => 'nullable|string|max:50',
            'coordinador_email' => 'nullable|string|max:50',
            
            'estudiantes' => 'integer|min:0',
            'familias' => 'integer|min:0',
            'docentes' => 'integer|min:0',
            'directivos' => 'integer|min:0',
            'orientadores' => 'integer|min:0',
            'administrativos' => 'integer|min:0',
            'servicios' => 'integer|min:0',
            
            'jornada_manana' => 'boolean',
            'jornada_tarde' => 'boolean',
            'jornada_noche' => 'boolean',
            'jornada_unica' => 'boolean',
            'nivel_preescolar' => 'boolean',
            'nivel_primaria' => 'boolean',
            'nivel_secundaria' => 'boolean',
            'nivel_media' => 'boolean',
            
            'modalidades' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        Institucion::create($data);

        return redirect()->route('instituciones.index')->with('success', 'Institución creada exitosamente.');
    }

    public function show(Institucion $institucion)
    {
        return view('instituciones.show', compact('institucion'));
    }

    public function edit(Institucion $institucion)
    {
        $departamentos = Departamento::orderBy('nombre')->get();
        $grupos = Grupo::orderBy('nombre')->get();
        // Los municipios asociados al departamento actual se cargarán en la vista
        $municipios = Municipio::where('departamento_id', $institucion->departamento_id)->orderBy('nombre')->get();
        
        return view('instituciones.edit', compact('institucion', 'departamentos', 'grupos', 'municipios'));
    }


    public function update(Request $request, Institucion $institucion)
    {
        // 1. Definir todas las reglas agrupadas por sección
        $rules = [
            // --- SECCIÓN: BASICS (dane, nombre, estado, etc.) ---
            'institucion' => [
                'dane' => ['nullable', 'string', 'max:12', Rule::unique('instituciones', 'dane')->ignore($institucion->id)],
                'nombre' => 'required|string|max:150',
                'estado' => 'nullable|string|max:20',
                'fecha_inicio' => 'nullable|date', // Cambié string a date para mayor precisión
                'fecha_cierre' => 'nullable|date',
                'grupo_id' => 'nullable|exists:grupos,id',
            ],

            // --- SECCIÓN: LOCALIZACIÓN (departamento_id, municipio_id, etc.) ---
            'localizacion' => [
                'departamento_id' => 'required|exists:departamentos,id',
                'municipio_id' => 'required|exists:municipios,id',
                'corregimiento' => 'nullable|string|max:50',
                'vereda' => 'nullable|string|max:50',
                'barrio' => 'nullable|string|max:50',
                'direccion' => 'nullable|string|max:50',
                'geolocalizacion' => 'nullable|string|max:80',
                'es_rural' => 'nullable|boolean', // nullable si viene de un checkbox
                'es_urbana' => 'nullable|boolean',
            ],
            
            // --- SECCIÓN: CONTACTOS (telefono, celular, email, rector, etc.) ---
            'contactos' => [
                'telefono' => 'nullable|string|max:50',
                'celular' => 'nullable|string|max:50',
                'email' => ['nullable', 'email', 'max:120', Rule::unique('instituciones', 'email')->ignore($institucion->id)],
                'web' => 'nullable|string|max:120',
                'facebook' => 'nullable|string|max:30',
                'instagram' => 'nullable|string|max:30',
                'rector' => 'nullable|string|max:100',
                'rector_celular' => 'nullable|string|max:50',
                'rector_email' => 'nullable|string|max:50',
                'coordinador' => 'nullable|string|max:100',
                'coordinador_celular' => 'nullable|string|max:50',
                'coordinador_email' => 'nullable|string|max:50',
            ],

            // --- SECCIÓN: POBLACION (estudiantes, familias, etc.) ---
            'poblacion' => [
                'estudiantes' => 'nullable|integer|min:0',
                'familias' => 'nullable|integer|min:0',
                'docentes' => 'nullable|integer|min:0',
                'directivos' => 'nullable|integer|min:0',
                'orientadores' => 'nullable|integer|min:0',
                'administrativos' => 'nullable|integer|min:0',
                'servicios' => 'nullable|integer|min:0',
            ],

            // --- SECCIÓN: ACADÉMICO (jornadas, niveles, etc.) ---
            'academico' => [
                'sedes' => 'integer|min:1', // Este es 'required' implícitamente por no ser 'nullable'
                'jornada_manana' => 'nullable|boolean',
                'jornada_tarde' => 'nullable|boolean',
                'jornada_noche' => 'nullable|boolean',
                'jornada_unica' => 'nullable|boolean',
                'nivel_preescolar' => 'nullable|boolean',
                'nivel_primaria' => 'nullable|boolean',
                'nivel_secundaria' => 'nullable|boolean',
                'nivel_media' => 'nullable|boolean',
                'modalidades' => 'nullable|string',
                'observaciones' => 'nullable|string',
            ],
        ];

        // 2. Determinar la sección actual
        // Si no se pasa 'section' en el request, asumimos 'basicos'
        $sectionKey = $request->get('section', 'institucion');

        // 3. Validar solo las reglas de esa sección
        if (!isset($rules[$sectionKey])) {
            // Manejar error si alguien intenta una sección que no existe
            return back()->withErrors(['section' => 'Sección de formulario inválida.']);
        }

        $validatedData = $request->validate($rules[$sectionKey]);

        // 4. Asegurar que los checkboxes (booleanos) que no se envían (unchecked) se guarden como false
        $booleanFields = [
            'es_rural', 'es_urbana', 
            'jornada_manana', 'jornada_tarde', 'jornada_noche', 'jornada_unica',
            'nivel_preescolar', 'nivel_primaria', 'nivel_secundaria', 'nivel_media'
        ];
        
        foreach ($booleanFields as $field) {
            // Si el campo pertenece a la sección validada y no está en el request, lo establecemos a false
            if (array_key_exists($field, $rules[$sectionKey]) && !$request->has($field)) {
                $validatedData[$field] = false;
            }
        }


        // 5. Guardado (Solo se guarda la data validada de la sección actual)
        $institucion->update($validatedData);

        // 6. Redirección de éxito, volviendo a la misma sección de edición
        return redirect()->route('instituciones.show', $institucion)
        ->with('success', 'Institución actualizada exitosamente. ✅');
    }

    public function destroy(Institucion $institucion)
    {
        $institucion->delete();

        return redirect()->route('instituciones.index')->with('success', 'Institución eliminada exitosamente.');
    }
}
