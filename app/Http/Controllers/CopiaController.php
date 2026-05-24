<?php

namespace App\Http\Controllers;

use App\Models\Pelicula; 
use App\Models\Copia; 
use App\Http\Requests\CopiaCreateRequest; 
use App\Http\Requests\CopiaEditRequest; 
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CopiaController extends Controller {
    
    function index(): View {
        // Usamos with('pelicula') para evitar el problema de N+1 consultas
        $copias = Copia::with('pelicula')->get(); 
        return view('copia.index', ['copias' => $copias]);
    }

    function create(): View {
        return view('copia.create', ['peliculas' => Pelicula::pluck('titulo', 'id')]);
    }

    function store(CopiaCreateRequest $request): RedirectResponse {
        try {
            Copia::create($request->validated());
            return redirect()->route('copia.index')->with('mensajeTexto', 'La copia ha sido registrada correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Error al guardar la copia: ' . $e->getMessage()]);
        }
    }

    function edit(Copia $copia): View {
        return view('copia.edit', [
            'copia' => $copia, 
            'peliculas' => Pelicula::pluck('titulo', 'id')
        ]);
    }

    function update(CopiaEditRequest $request, Copia $copia): RedirectResponse {
        try {
            $copia->update($request->validated());
            return redirect()->route('copia.index')->with('mensajeTexto', 'La copia se ha actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Error al actualizar la copia.']);
        }
    }

    function destroy(Copia $copia): RedirectResponse {
        try {      
            $copia->delete();
            return redirect()->route('copia.index')->with('mensajeTexto', 'La copia se ha eliminado.');
        } catch (\Exception $e) {
            return back()->withErrors(['mensajeTexto' => 'Error al eliminar la copia. Asegúrate de que no tenga registros de alquiler activos.']);
        }
    }
}