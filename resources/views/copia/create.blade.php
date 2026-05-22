@extends('bootstrap.template')

@section('title', 'Añadir Copia')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Añadir Copia</h1>
    <a href="{{ route('copia.index') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form action="{{ route('copia.store') }}" method="POST"> 
        @csrf

        <div class="form-group">
            <label class="form-label" for="idpelicula">Película asociada</label>
            <select name="idpelicula" id="idpelicula" required class="form-control">
                <option value="" @if(old('idpelicula') == null) selected @endif disabled>Selecciona una película</option>
                @foreach($peliculas as $indice => $titulo)
                    <option value="{{ $indice }}" @if(old('idpelicula') == $indice) selected @endif>{{ $titulo }}</option>
                @endforeach
             </select>
             @error('idpelicula') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="codigo_barras">Código de barras</label>
            <input class="form-control" required id="codigo_barras" name="codigo_barras" minlength="10" maxlength="10" placeholder="Ej: 1234567890" value="{{ old('codigo_barras') }}" type="text">
            @error('codigo_barras') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="estado">Estado de la copia</label>
            <select class="form-control" required id="estado" name="estado">
                <option value="" disabled selected>Elige el estado</option>
                <option value="Disponible" @if(old('estado') == 'Disponible') selected @endif>Disponible</option>
                <option value="Alquilado" @if(old('estado') == 'Alquilado') selected @endif>Alquilado</option>
                <option value="Estropeado" @if(old('estado') == 'Estropeado') selected @endif>Estropeado</option>
            </select>
            @error('estado') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="formato">Formato</label>
            <select class="form-control" required id="formato" name="formato">
                <option value="" disabled selected>Elige el formato</option>
                <option value="DVD" @if(old('formato') == 'DVD') selected @endif>DVD</option>
                <option value="Blu-Ray" @if(old('formato') == 'Blu-Ray') selected @endif>Blu-Ray</option>
                <option value="CD" @if(old('formato') == 'CD') selected @endif>CD</option>
            </select>
            @error('formato') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Registrar Copia</button>
            <a href="{{ route('copia.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection