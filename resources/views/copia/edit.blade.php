@extends('layouts.template')

@section('title', 'Editar Copia')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Editar Copia</h1>
    <a href="{{ route('copia.index') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form action="{{ route('copia.update', $copia->id) }}" method="POST"> 
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label" for="idpelicula">Película asociada</label>
            <select name="idpelicula" id="idpelicula" required class="form-control">
                <option value="" @if(old('idpelicula', $copia->idpelicula) == null) selected @endif disabled>Selecciona una película</option>
                @foreach($peliculas as $indice => $titulo)
                    <option value="{{ $indice }}" @if(old('idpelicula', $copia->idpelicula) == $indice) selected @endif>{{ $titulo }}</option>
                @endforeach
             </select>
             @error('idpelicula') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="codigo_barras">Código de barras</label>
            <input class="form-control" required id="codigo_barras" name="codigo_barras" minlength="10" maxlength="10" value="{{ old('codigo_barras', $copia->codigo_barras) }}" type="text">
            @error('codigo_barras') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="estado">Estado de la copia</label>
            <select class="form-control" required id="estado" name="estado">
                <option value="" disabled>Elige el estado</option>
                <option value="Disponible" @if(old('estado', $copia->estado) == 'Disponible') selected @endif>Disponible</option>
                <option value="Alquilado" @if(old('estado', $copia->estado) == 'Alquilado') selected @endif>Alquilado</option>
                <option value="Estropeado" @if(old('estado', $copia->estado) == 'Estropeado') selected @endif>Estropeado</option>
            </select>
            @error('estado') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="formato">Formato</label>
            <select class="form-control" required id="formato" name="formato">
                <option value="" disabled>Elige el formato</option>
                <option value="DVD" @if(old('formato', $copia->formato) == 'DVD') selected @endif>DVD</option>
                <option value="Blu-Ray" @if(old('formato', $copia->formato) == 'Blu-Ray') selected @endif>Blu-Ray</option>
                <option value="CD" @if(old('formato', $copia->formato) == 'CD') selected @endif>CD</option>
            </select>
            @error('formato') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Guardar Cambios</button>
            <a href="{{ route('copia.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection