@extends('layouts.template')

@section('title', 'Catálogo de Películas')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Catálogo <span>{{ $peliculas->count() }} películas</span></h1>
    @if(Auth::check() && Auth::user()->rol === 'admin')
        <a href="{{ route('pelicula.create') }}" class="btn btn-gold">+ Añadir Película</a>
    @endif
  </div>

  @if($peliculas->isEmpty())
    <div class="empty-state">
      <div class="empty-state-icon">🎬</div>
      <p>Aún no hay películas en el catálogo.</p>
    </div>
  @else
    <div class="poster-grid">
      @foreach($peliculas as $pelicula)
        <div class="poster-card">
          <div class="poster-img-wrap">
            <img src="{{ $pelicula->getPath() }}" alt="{{ $pelicula->titulo }}" class="poster-img">
            <div class="poster-overlay">
              <a href="{{ route('pelicula.show', $pelicula->id) }}" class="btn btn-gold btn-sm">Ver Detalle</a>
              @if(Auth::check() && Auth::user()->rol === 'admin')
                  <a href="{{ route('pelicula.edit', $pelicula->id) }}" class="btn btn-outline btn-sm">Editar</a>
              @endif
            </div>
          </div>
          <div class="poster-info">
            <div class="poster-title">{{ $pelicula->titulo }}</div>
            <div class="poster-director">{{ $pelicula->director }}</div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endsection