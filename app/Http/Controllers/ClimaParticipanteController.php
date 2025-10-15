<?php

namespace App\Http\Controllers;

use App\Models\ClimaRespuesta;
use App\Models\ClimaParticipante;
use App\Models\ClimaEncuesta;
use App\Models\ClimaItem;
use App\Models\Sede;
use App\Models\Institucion;
use \App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Para generar el token

class ClimaParticipanteController extends Controller
{
    public function handle(int $encuesta_id, string $accion = null)
    {
        if($accion === 'cerrar-sesion'){
            session()->flush();
            return redirect()->route('clima_participante.handle', ['encuesta_id' => $encuesta_id]);
        } elseif (session()->has('clima.encuesta.completa')){
            return $this->completeSurvey($encuesta_id);
        } elseif (session()->has('clima.participante.id')) {
            return $this->showSurvey();
        }else{
            $climaEncuesta = ClimaEncuesta::with('institucion')->find($encuesta_id);
            $url = parse_url(url('/'), PHP_URL_HOST) . "/$encuesta_id";
            if (!$climaEncuesta) {
                return view('clima.encuesta-indisponible')->with('error', "No existe una encuesta vinculada a esta url ($url).");
            }
            if ($climaEncuesta->estado === false) {
                return view('clima.encuesta-indisponible')->with('error', "Esta encuesta está inactiva ($url).");
            }
            $nombreInstitucion = $climaEncuesta->institucion->nombre ?? 'Institución Desconocida';
            session([
                'clima.encuesta.id' => $encuesta_id,
                'clima.encuesta.clave' => $climaEncuesta->clave,
                'clima.institucion.dane' => $climaEncuesta->institucion->dane,
                'clima.institucion.nombre' => $nombreInstitucion,
            ]);
            return $this->create();
        }
    }

    public function showSurvey()
    {
        $estamento = session('clima.participante.estamento');

        $items = ClimaItem::where('estamento', $estamento)
                        ->orderBy('dim', 'asc')
                        ->orderBy('asp', 'asc')
                        ->get();

        $itemsAgrupadosPorDim = $items->groupBy('dim');
        $configuracion =Configuracion::where('variable', 'texto-introduccion-encuesta')->first();
        $textoIntroduccionEncuesta = $configuracion->valor ?? '';
        return view('clima.participante-survey')
            ->with('items_por_dimension', $itemsAgrupadosPorDim)
            ->with('textoIntroduccionEncuesta', $textoIntroduccionEncuesta);
    }
    
    public function saveDim(Request $request)
    {
        $participanteId = session('clima.participante.id');

        // Recuperar todas las respuestas enviadas
        $respuestas = $request->input('respuestas', []);

        // Guardar cada respuesta
        foreach ($respuestas as $itemId => $valor) {
            ClimaRespuesta::create([
                'clima_item_id' => $itemId,
                'respuesta' => $valor,
                'clima_participante_id' => $participanteId,
            ]);
        }
        
        $encuestaId = session('clima.encuesta.id');
        $dimensiones = session('clima.dimensiones', []);
        $dimension = $request->input('dimension');
        if (array_key_exists($dimension, $dimensiones)) {
            $dimensiones[$dimension] = true;
        }
        session(['clima.dimensiones' => $dimensiones]);
        $allTrue = array_reduce($dimensiones, fn($carry, $val) => $carry && $val, true);
        if($allTrue){
            session(['clima.encuesta.completa' => true]);
        }
        return redirect()->route('clima_participante.handle', ['encuesta_id' => $encuestaId]);
    }

    public function create()
    {
        $institucionDane = session('clima.institucion.dane'); 
        $sedes = Sede::where('institucion_dane', $institucionDane)
                    ->orderBy('es_principal', 'desc') 
                    ->orderBy('nombre', 'asc')
                    ->get();

        return view('clima.participante-create', ['sedes' => $sedes,]);
    }

    public function store(Request $request)
    {
        $encuestaClaveEsperada = session('clima.encuesta.clave');
        $validatedData = $request->validate([
            'estamento' => 'required|string|max:15',
            'sede_id' => 'required|integer|exists:sedes,id',
            'clave' => 'required|string|size:4|in:' . $encuestaClaveEsperada,
        ]);
        $estamento = $validatedData['estamento'];
        $encuestaId = session('clima.encuesta.id');
        $participante = ClimaParticipante::create([
            'estamento' => $estamento,
            'ip' => $request->ip(),
            'completado' => false,
            'clima_encuesta_id' => $encuestaId,
            'sede_id' => $validatedData['sede_id'],
        ]);
        $dimUnicos = ClimaItem::where('estamento', $estamento)
                      ->pluck('dim')
                      ->unique()
                      ->values();
        $dimStatus = $dimUnicos->mapWithKeys(function ($dim) {
            return [$dim => false];
        })->toArray();
        session([
            'clima.participante.id' => $participante->id,
            'clima.participante.estamento' => $validatedData['estamento'],
            'clima.dimensiones' => $dimStatus,
        ]);
        return redirect()->route('clima_participante.handle', ['encuesta_id' => $encuestaId]);
    }

    public function completeSurvey(int $encuesta_id)
    {
        $participante = ClimaParticipante::find(session('clima.participante.id'));
        $participante->completado = true;
        $participante->save();
        session()->flush();
        return view('clima.encuesta-indisponible')
            ->with('success', "Has diligenciado toda la encuesta.")
            ->with('encuesta_id', $encuesta_id);
        // return redirect()->route('clima_participante.handle', ['encuesta_id' => $encuestaId]);
    }
}
