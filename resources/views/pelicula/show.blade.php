@extends('bootstrap.template')

@section('title', $pelicula->titulo)

@section('content')

  {{-- MODAL DE CONFIRMACIÓN DE BORRADO --}}
  <div class="vc-modal-overlay" id="destroyModal">
    <div class="vc-modal">
      <div class="vc-modal-header">
        <span>Confirmar eliminación</span>
        <button class="vc-modal-close" onclick="closeModal()">✕</button>
      </div>
      <div class="vc-modal-body">
        <p>Estás a punto de eliminar la película: <strong style="color: var(--text);">{{ $pelicula->titulo }}</strong>.</p>
        <p>Esta acción es irreversible.</p>
      </div>
      <div class="vc-modal-footer">
        <button class="btn btn-outline" onclick="closeModal()">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-red">Eliminar Película</button>
      </div>
    </div>
  </div>

  <div class="page-header">
    <h1 class="page-title">{{ $pelicula->titulo }}</h1>
    <a href="{{ route('pelicula.index') }}" class="btn btn-outline">← Volver al Catálogo</a>
  </div>

  {{-- FICHA TÉCNICA --}}
  <div style="display: flex; flex-wrap: wrap; gap: 2.5rem; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 2.5rem; margin-bottom: 2rem;">
      
      <!-- FOTO Y ACCIONES -->
      <div style="flex: 0 0 300px; max-width: 100%;">
          <img src="{{ $pelicula->getPath() }}" alt="{{ $pelicula->titulo }}" style="width: 100%; border-radius: var(--radius-sm); border: 1px solid var(--border2); box-shadow: 0 10px 30px rgba(0,0,0,0.5);">

          @auth
            @if(Auth::user()->hasVerifiedEmail())
              <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1.5rem;">
                  <a href="{{ route('pelicula.edit', $pelicula->id) }}" class="btn btn-gold" style="justify-content: center;">Editar Película</a>
                  <a href="#" class="btn btn-red link-destroy" style="justify-content: center;" data-href="{{ route('pelicula.destroy', $pelicula->id) }}">Eliminar Película</a>
              </div>
            @endif
          @endauth
      </div>

      <!-- DATOS DE LA PELÍCULA -->
      <div style="flex: 1; min-width: 300px;">
          <h2 style="color: var(--gold); font-family: var(--font-display); font-size: 3rem; letter-spacing: 1px; line-height: 1.1; margin-bottom: 0.5rem;">{{ $pelicula->titulo }}</h2>
          <p style="color: var(--muted); font-size: 1.1rem; font-style: italic; border-bottom: 1px solid var(--border); padding-bottom: 1rem; margin-bottom: 2rem;">
              Dirigida por: <span style="color: var(--text); font-style: normal; font-weight: 500;">{{ $pelicula->director }}</span>
          </p>

          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-bottom: 2.5rem;">
              <div>
                  <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Género</span>
                  <span style="font-size: 1.1rem; color: var(--text); font-weight: 500;">{{ $pelicula->genero }}</span>
              </div>
              <div>
                  <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Fecha de Estreno</span>
                  <span style="font-family: var(--font-mono); font-size: 1.1rem; color: var(--text);">{{ \Carbon\Carbon::parse($pelicula->fecha_estreno)->format('d/m/Y') }}</span>
              </div>
              <div>
                  <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Duración</span>
                  <span style="font-size: 1.1rem; color: var(--text); font-weight: 500;">{{ $pelicula->duracion }} min</span>
              </div>
              <div>
                  <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Clasificación</span>
                  <span class="badge badge-cyan" style="font-size: 0.9rem; margin-top: 0.3rem; padding: 0.4rem 0.8rem;">{{ $pelicula->clasificacion }}</span>
              </div>
          </div>

          <div>
              <span style="display: block; font-size: 0.85rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem; margin-bottom: 1rem;">Reparto Principal</span>
              <p style="color: var(--text); line-height: 1.8; font-size: 1.05rem;">{{ $pelicula->actores }}</p>
          </div>
      </div>
  </div>

  {{-- SECCIÓN DE COMENTARIOS --}}
  <div style="margin-top: 4rem;">
      <h3 style="color: var(--gold); font-family: var(--font-display); font-size: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem; margin-bottom: 2rem;">Comentarios de Usuarios</h3>
      
      <div style="display: flex; flex-direction: column; gap: 1.5rem;">
          @forelse($pelicula->valoraciones as $valoracion)
              <div style="background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-sm); padding: 1.5rem;">
                  <p style="color: var(--text); line-height: 1.6; font-size: 1.05rem; margin-bottom: 1.5rem;">{{ $valoracion->comment }}</p>
                  
                  <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); padding-top: 1rem;">
                      <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--muted);">{{ $valoracion->created_at->format('d/m/Y') }}</span>
                      
                      @if(session('valoraciones') != null && in_array($valoracion->id, session('valoraciones')))
                          <a href="{{ route('valoracion.edit', $valoracion->id) }}" style="font-size: 0.85rem; color: var(--gold); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Editar comentario</a>
                      @endif
                  </div>
              </div>
          @empty
              <p style="color: var(--muted); font-style: italic;">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
          @endforelse
      </div>

      @auth
          <div style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; margin-top: 3rem;">
              <form method="post" action="{{ route('valoracion.store', $pelicula->id) }}">
                  @csrf
                  <input type="hidden" name="idpelicula" value="{{ $pelicula->id }}">
                  <div class="form-group">
                      <label class="form-label" for="comment">Añade tu comentario</label>
                      <textarea class="form-control" minlength="5" id="comment" name="comment" placeholder="Escribe tu opinión sobre esta película..." rows="4">{{old('comment')}}</textarea>
                  </div>
                  <button type="submit" class="btn btn-gold">Publicar Comentario</button>
              </form>
          </div>
      @endauth
  </div>

  <form action="" method="post" id="form-delete">
      @csrf
      @method('delete')
  </form>

@endsection

@section('scripts')
<script src="{{ url('assets/js/borrar.js') }}"></script>
@endsection