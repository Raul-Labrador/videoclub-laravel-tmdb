@extends('layouts.template')

@section('title', 'Editar Comentario')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Editar Comentario</h1>
    <!-- El botón volver nos lleva a la página de detalle de la película asociada al comentario -->
    <a href="{{ route('pelicula.show', $valoracion->idpelicula) }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('valoracion.update', $valoracion->id) }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label" for="comment">Tu Comentario</label>
            <textarea class="form-control" minlength="5" id="comment" name="comment" placeholder="Escribe aquí tu opinión sobre la película..." rows="4">{{ old('comment', $valoracion->comment) }}</textarea>
            @error('comment') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Guardar Cambios</button>
            <a href="{{ route('pelicula.show', $valoracion->idpelicula) }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection