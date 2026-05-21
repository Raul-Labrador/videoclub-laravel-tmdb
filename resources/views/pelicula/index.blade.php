@extends('bootstrap.template')

@section('title', 'Catálogo de Películas')

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/pelicula/indexStyle.css') }}">
@endsection

@section('content')

  {{-- CABECERA --}}
  <div class="page-header">
    <h1 class="page-title">
      Catálogo
      <span>{{ $peliculas->count() }} películas</span>
    </h1>
    @auth
      @if(Auth::user()->hasVerifiedEmail())
        <a href="{{ route('pelicula.create') }}" class="btn btn-gold">
          + Añadir Película
        </a>
      @endif
    @endauth
  </div>

  {{-- CATÁLOGO VACÍO --}}
  @if($peliculas->isEmpty())
    <div class="empty-state">
      <div class="empty-state-icon">🎬</div>
      <p>Aún no hay películas en el catálogo.</p>
    </div>

  {{-- GRID DE PELÍCULAS --}}
  @else
    <div class="poster-grid">
      @foreach($peliculas as $pelicula)
        <div class="poster-card">

          {{-- Imagen --}}
          <div class="poster-img-wrap">
            <img src="{{ $pelicula->getPath() }}" alt="{{ $pelicula->titulo }}" class="poster-img">
            <div class="poster-overlay">
              <a href="{{ route('pelicula.show', $pelicula->id) }}" class="btn btn-gold btn-sm">
                Ver Detalle
              </a>
              @auth
                @if(Auth::user()->hasVerifiedEmail())
                  <a href="{{ route('pelicula.edit', $pelicula->id) }}" class="btn btn-outline btn-sm">
                    Editar
                  </a>
                @endif
              @endauth
            </div>
          </div>

          {{-- Info --}}
          <div class="poster-info">
            <div class="poster-title">{{ $pelicula->titulo }}</div>
            <div class="poster-director">{{ $pelicula->director }}</div>
          </div>

        </div>
      @endforeach
    </div>
  @endif

@endsection