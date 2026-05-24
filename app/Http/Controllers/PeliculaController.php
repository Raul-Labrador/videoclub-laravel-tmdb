<?php

namespace App\Http\Controllers;


// Importamos el modelo y clases necesarias
use App\Models\Pelicula; 
use App\Services\TmdbService;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PeliculaCreateRequest;    


class PeliculaController extends Controller {
    
    private function handlePortada(Request $request, Pelicula $pelicula): void {
        if ($request->deleteImage == 'true' && $pelicula->portada) {
            Storage::disk('public')->delete($pelicula->portada);
            $pelicula->portada = null;
        }

        if ($request->hasFile('portada')) {
            if ($pelicula->portada) Storage::disk('public')->delete($pelicula->portada);
            $pelicula->portada = $request->file('portada')->store('portadas', 'public');
        }
    }

    function index(): View {

        // Obtenemos todas las películas para visualizarlas
        $peliculas = Pelicula::all(); 
        return view('pelicula.index', ['peliculas' => $peliculas]);

    }

    
    function create(): View {
        
        // Devolvemos la vista create con el formulario
        return view('pelicula.create');
    }

    
    function store(PeliculaCreateRequest $request, TmdbService $tmdbService): RedirectResponse {
        try {
            $pelicula = Pelicula::create($request->validated());
            
            // Si no hay archivo, intentamos TMDB
            if (!$request->hasFile('portada')) {
                $tmdb = $tmdbService->searchMovie($pelicula->titulo);
                if (!empty($tmdb['results'][0]['poster_path'])) {
                    $imageContents = \Illuminate\Support\Facades\Http::get($tmdbService->getImageUrl($tmdb['results'][0]['poster_path']))->body();
                    $filename = 'portadas/' . $pelicula->id . '.jpg';
                    Storage::disk('public')->put($filename, $imageContents);
                    $pelicula->portada = $filename;
                    $pelicula->save();
                }
            } else {
                $this->handlePortada($request, $pelicula);
                $pelicula->save();
            }

            return redirect()->route('pelicula.index')->with('mensajeTexto', 'Película creada correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }
    
    function show(Pelicula $pelicula): View {

        return view('pelicula.show', ['pelicula' => $pelicula]);

    }

    function edit(Pelicula $pelicula): View {

        return view('pelicula.edit', ['pelicula' => $pelicula]);

    }

    function update(Request $request, Pelicula $pelicula): RedirectResponse {
        try {
            $pelicula->fill($request->all());
            $this->handlePortada($request, $pelicula);
            $pelicula->save();

            return redirect()->route('pelicula.index')->with('mensajeTexto', 'Película actualizada.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Error al actualizar.']);
        }
    }

    function destroy(Pelicula $pelicula): RedirectResponse {
        try {
            if ($pelicula->portada) {
                Storage::delete($pelicula->portada);
            }

            $result = $pelicula->delete();
            $textmessage = 'La película se ha eliminado.';

        } catch (\Illuminate\Database\QueryException $e) {

            $result = false;
            $textmessage = 'Error: Esta película no puede eliminarse porque tiene copias asociadas.';

        } catch (\Exception $e) {

            $result = false;
            $textmessage = 'Error fatal al eliminar la película.';
        }

        $message = [
            'mensajeTexto' => $textmessage,
        ];
        
        if ($result){

                return redirect()->route('main')->with($message);

            } else {

                return back()->withInput()->withErrors($message);

            }
    }
}