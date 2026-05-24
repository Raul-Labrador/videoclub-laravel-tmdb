<?php

namespace App\Http\Controllers;

use App\Models\Cliente; 
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ClienteCreateRequest; 
use App\Http\Requests\ClienteEditRequest; 

class ClienteController extends Controller {
    
    // Método privado unificado para gestionar la subida/borrado de fotos
    private function handleFoto(Request $request, Cliente $cliente): void {
        // Borrar imagen si se marca el checkbox o si se va a reemplazar
        if (($request->deleteImage == 'true' || $request->hasFile('foto')) && $cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
            $cliente->foto = null;
        }

        // Subir nueva foto si existe
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('clientes', 'public');
            $cliente->foto = $path;
        }
    }

    function index(): View {
        return view('cliente.index', ['clientes' => Cliente::all()]);
    }

    function create(): View {
        return view('cliente.create');
    }

    function store(ClienteCreateRequest $request): RedirectResponse {
        try {
            $cliente = new Cliente($request->validated());
            $this->handleFoto($request, $cliente);
            $cliente->save();

            return redirect()->route('cliente.index')->with('mensajeTexto', 'El cliente se ha añadido correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Error al guardar el cliente.']);
        }
    }

    function show(Cliente $cliente): View {
        return view('cliente.show', ['cliente' => $cliente]); 
    }

    function edit(Cliente $cliente): View {
        return view('cliente.edit', ['cliente' => $cliente]); 
    }

    function update(ClienteEditRequest $request, Cliente $cliente): RedirectResponse { 
        try {
            $cliente->fill($request->validated());
            $this->handleFoto($request, $cliente);
            $cliente->save();

            return redirect()->route('cliente.index')->with('mensajeTexto', 'El cliente se ha actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['mensajeTexto' => 'Error al actualizar el cliente.']);
        }
    }

    function destroy(Cliente $cliente): RedirectResponse {
        try {
            if ($cliente->foto) {
                 Storage::disk('public')->delete($cliente->foto);
            }
            $cliente->delete();
            return redirect()->route('cliente.index')->with('mensajeTexto', 'El cliente se ha eliminado.');
        } catch (\Exception $e) {
            return back()->withErrors(['mensajeTexto' => 'Error al eliminar el cliente.']);
        }
    }
}