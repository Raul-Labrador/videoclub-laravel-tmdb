<?php

namespace App\Http\Controllers;


// Importamos el modelo y clases necesarias
use App\Models\Alquiler; 
use App\Models\Cliente; 
use App\Models\Copia; 
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AlquilerCreateRequest; 
use App\Http\Requests\AlquilerEditRequest; 


class AlquilerController extends Controller {
    

    function index(): View {

        $alquileres = Alquiler::with(['copia.pelicula', 'cliente'])->get();
        return view('alquiler.index', ['alquileres' => $alquileres]);
    }

    function create(): View {

        $clientes = Cliente::pluck('nombre', 'id');
        $copias = Copia::with('pelicula')->where('estado', 'Disponible')->get();
        return view('alquiler.create', ['clientes' => $clientes, 'copias' => $copias]);

    }

    function store(AlquilerCreateRequest $request): RedirectResponse {
        try {
            $alquiler = Alquiler::create($request->validated());
            
            // Lógica de negocio: Cambiar estado si se alquila
            if (!$alquiler->fecha_dev) {
                Copia::where('id', $alquiler->idcopia)->update(['estado' => 'Alquilado']);
            }

            return redirect()->route('alquiler.index')->with('mensajeTexto', 'Alquiler registrado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Error al registrar el alquiler.']);
        }
    }

    function edit(Alquiler $alquiler): View {

        $copias = Copia::with('pelicula')->where('estado', 'Alquilado')->get();
        $clientes = Cliente::pluck('nombre', 'id');
        return view('alquiler.edit', ['alquiler' => $alquiler, 'copias' => $copias, 'clientes' => $clientes]);

    }


    public function update(AlquilerCreateRequest $request, Alquiler $alquiler): RedirectResponse {
        try {
            $estabaAlquilado = $alquiler->fecha_dev === null;
            
            $alquiler->update($request->validated());

            // Si ahora tiene fecha de devolución, liberamos la copia
            if ($estabaAlquilado && $alquiler->fecha_dev !== null) {
                Copia::where('id', $alquiler->idcopia)->update(['estado' => 'Disponible']);
            }

            return redirect()->route('alquiler.index')->with('mensajeTexto', 'Alquiler actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'No se pudo actualizar el alquiler.']);
        }
    }

    function destroy(Alquiler $alquiler): RedirectResponse {

        try{

            $result = $alquiler->delete();
            $textmessage='El registro de alquiler se ha eliminado.';

        } catch(\Exception $e) {

            $result = false;
            $textmessage='Error al eliminar el registro de alquiler.';
        }
        
        $message = [
            'mensajeTexto' => $textmessage,
        ];
        
        if($result) {

            return redirect()->route('main')->with($message);

        } else {
            
            return back()->withInput()->withErrors($message);
        }
    }
}