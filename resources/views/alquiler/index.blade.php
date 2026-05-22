@extends('bootstrap.template')

@section('title', 'Registro de Alquileres')

@section('content')

  {{-- MODAL DE CONFIRMACIÓN --}}
  <div class="vc-modal-overlay" id="destroyModal">
    <div class="vc-modal">
      <div class="vc-modal-header">
        <span>Confirmar eliminación</span>
        <button class="vc-modal-close" onclick="closeModal()">✕</button>
      </div>
      <div class="vc-modal-body">
        <p>Este registro de alquiler será eliminado de forma permanente. Esta acción no se puede deshacer.</p>
      </div>
      <div class="vc-modal-footer">
        <button class="btn btn-outline" onclick="closeModal()">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-red">Eliminar</button>
      </div>
    </div>
  </div>

  {{-- CABECERA --}}
  <div class="page-header">
    <h1 class="page-title">Alquileres <span>{{ $alquileres->count() }} registros</span></h1>
    <a href="{{ route('alquiler.create') }}" class="btn btn-gold">+ Nuevo Alquiler</a>
  </div>

  {{-- ALQUILERES ACTIVOS --}}
  <div class="section-label">Activos</div>
  <div class="table-wrap" style="margin-bottom: 2rem;">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Película / Formato</th>
          <th>Cliente</th>
          <th>Fecha salida</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($alquileres->filter(fn($a) => $a->fecha_dev == null) as $alquiler)
          <tr>
            <td><span class="badge badge-muted">{{ $alquiler->id }}</span></td>
            <td>
              {{ $alquiler->copia->pelicula->titulo }}
              <span class="badge badge-cyan" style="margin-left:0.4rem">{{ $alquiler->copia->formato }}</span>
            </td>
            <td>{{ $alquiler->cliente->nombre }}</td>
            <td style="font-family: var(--font-mono); font-size:0.82rem; color:var(--muted);">
              {{ $alquiler->fecha_sal }}
            </td>
            <td>
              <div style="display:flex; gap:0.5rem;">
                <a href="{{ route('alquiler.edit', $alquiler->id) }}" class="btn btn-outline btn-sm">Editar</a>
                <a class="btn btn-outline-red btn-sm link-destroy"
                   data-href="{{ route('alquiler.destroy', $alquiler) }}"
                   data-id="{{ $alquiler->id }}">
                  Eliminar
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="text-align:center; color:var(--muted); padding: 2rem;">
              No hay alquileres activos en este momento.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- ALQUILERES DEVUELTOS --}}
  <div class="section-label">Devueltos</div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Película / Formato</th>
          <th>Cliente</th>
          <th>Fecha salida</th>
          <th>Fecha devolución</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($alquileres->filter(fn($a) => $a->fecha_dev != null) as $alquiler)
          <tr>
            <td><span class="badge badge-muted">{{ $alquiler->id }}</span></td>
            <td>
              {{ $alquiler->copia->pelicula->titulo }}
              <span class="badge badge-cyan" style="margin-left:0.4rem">{{ $alquiler->copia->formato }}</span>
            </td>
            <td>{{ $alquiler->cliente->nombre }}</td>
            <td style="font-family: var(--font-mono); font-size:0.82rem; color:var(--muted);">
              {{ $alquiler->fecha_sal }}
            </td>
            <td style="font-family: var(--font-mono); font-size:0.82rem; color:var(--green);">
              {{ $alquiler->fecha_dev }}
            </td>
            <td>
              <div style="display:flex; gap:0.5rem;">
                @if(Auth::check() && Auth::user()->rol === 'admin')
                    <a href="{{ route('alquiler.edit', $alquiler->id) }}" class="btn btn-outline btn-sm">Editar</a>
                    <a class="btn btn-outline-red btn-sm link-destroy" data-href="{{ route('alquiler.destroy', $alquiler) }}">Eliminar</a>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align:center; color:var(--muted); padding: 2rem;">
              No hay alquileres devueltos todavía.
            </td>
          </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr class="table-footer">
          <td colspan="5">Total de alquileres registrados</td>
          <td>{{ count($alquileres) }}</td>
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