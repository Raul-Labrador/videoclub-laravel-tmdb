@extends('layouts.template')

@section('title', 'Inventario de Copias')

@section('content')

  {{-- MODAL DE CONFIRMACIÓN --}}
  <div class="vc-modal-overlay" id="destroyModal">
    <div class="vc-modal">
      <div class="vc-modal-header">
        <span>Confirmar eliminación</span>
        <button class="vc-modal-close" onclick="closeModal()">✕</button>
      </div>
      <div class="vc-modal-body">
        <p>Esta copia será eliminada de forma permanente. Esta acción no se puede deshacer.</p>
      </div>
      <div class="vc-modal-footer">
        <button class="btn btn-outline" onclick="closeModal()">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-red">Eliminar</button>
      </div>
    </div>
  </div>

  {{-- CABECERA --}}
  <div class="page-header">
    <h1 class="page-title">Copias <span>{{ $copias->count() }} registradas</span></h1>
    @auth
      @if(Auth::user()->hasVerifiedEmail())
        <a href="{{ route('copia.create') }}" class="btn btn-gold">+ Nueva Copia</a>
      @endif
    @endauth
  </div>

  {{-- TABLA --}}
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Película</th>
          <th>Código de barras</th>
          <th>Formato</th>
          @auth
            @if(Auth::user()->hasVerifiedEmail())
              <th>Estado</th>
              <th>Acciones</th>
            @endif
          @endauth
        </tr>
      </thead>
      <tbody>
        @foreach($copias as $copia)
          <tr>
            <td><span class="badge badge-muted">{{ $copia->id }}</span></td>
            <td>{{ $copia->pelicula->titulo }}</td>
            <td style="font-family: var(--font-mono); font-size: 0.82rem; color: var(--muted);">
              {{ $copia->codigo_barras }}
            </td>
            <td><span class="badge badge-cyan">{{ $copia->formato }}</span></td>
            @auth
              @if(Auth::user()->hasVerifiedEmail())
                <td>
                  @if($copia->estado === 'Disponible')
                    <span class="badge badge-green">Disponible</span>
                  @elseif($copia->estado === 'Alquilado')
                    <span class="badge badge-gold">Alquilado</span>
                  @else
                    <span class="badge badge-red">{{ $copia->estado }}</span>
                  @endif
                </td>
                <td>
                  <div style="display:flex; gap:0.5rem;">
                    <a href="{{ route('copia.edit', $copia->id) }}" class="btn btn-outline btn-sm">Editar</a>
                    <a class="btn btn-outline-red btn-sm link-destroy"
                       data-href="{{ route('copia.destroy', $copia) }}"
                       data-id="{{ $copia->id }}">
                      Eliminar
                    </a>
                  </div>
                </td>
              @endif
            @endauth
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="table-footer">
          <td colspan="3">Total de copias registradas</td>
          <td colspan="3">{{ count($copias) }}</td>
        </tr>
      </tfoot>
    </table>
  </div>

  <form action="" method="post" id="form-delete">
    @csrf
    @method('delete')
  </form>

@endsection

@section('scripts')
<script src="{{ url('assets/js/borrar.js') }}"></script>
@endsection