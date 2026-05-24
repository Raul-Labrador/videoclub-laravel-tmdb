@extends('layouts.template')

@section('title', $cliente->nombre)

@section('content')

  {{-- MODAL DE CONFIRMACIÓN DE BORRADO --}}
  <div class="vc-modal-overlay" id="destroyModal">
    <div class="vc-modal">
      <div class="vc-modal-header">
        <span>Confirmar eliminación</span>
        <button class="vc-modal-close" onclick="closeModal()">✕</button>
      </div>
      <div class="vc-modal-body">
        <p>Estás a punto de eliminar al cliente: <strong style="color: var(--text);">{{ $cliente->nombre }} {{ $cliente->apellidos }}</strong>.</p>
        <p>Esta acción es irreversible.</p>
      </div>
      <div class="vc-modal-footer">
        <button class="btn btn-outline" onclick="closeModal()">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-red">Eliminar Cliente</button>
      </div>
    </div>
  </div>

  <div class="page-header">
    <h1 class="page-title">Ficha de Cliente</h1>
    <a href="{{ route('cliente.index') }}" class="btn btn-outline">← Volver al Directorio</a>
  </div>

  <div style="display: flex; flex-wrap: wrap; gap: 2.5rem; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 2.5rem;">
      
      <!-- FOTOGRAFÍA Y ACCIONES -->
      <div style="flex: 0 0 250px; max-width: 100%;">
          <img src="{{ $cliente->getPath() }}" alt="{{ $cliente->nombre }}" style="width: 100%; border-radius: var(--radius-sm); border: 1px solid var(--border2); box-shadow: 0 10px 30px rgba(0,0,0,0.5); aspect-ratio: 1/1; object-fit: cover;">

          <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1.5rem;">
              <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-cyan" style="justify-content: center; background: var(--cyan); color: #000; font-weight: 600; padding: 0.55rem 1.25rem; border-radius: var(--radius-sm); text-transform: uppercase; letter-spacing: 0.06em; font-size: 0.82rem; text-align: center;">Editar Perfil</a>
              <a href="#" class="btn btn-red link-destroy" style="justify-content: center;" data-href="{{ route('cliente.destroy', $cliente->id) }}">Eliminar Cliente</a>
          </div>
      </div>

      <!-- DATOS DEL CLIENTE -->
      <div style="flex: 1; min-width: 250px;">
          <h2 style="color: var(--cyan); font-family: var(--font-display); font-size: 3rem; letter-spacing: 1px; line-height: 1.1; margin-bottom: 0.5rem;">{{ $cliente->nombre }} {{ $cliente->apellidos }}</h2>
          <p style="color: var(--muted); font-size: 1.1rem; font-style: italic; border-bottom: 1px solid var(--border); padding-bottom: 1rem; margin-bottom: 2rem;">
              Usuario Activo del Videoclub
          </p>

          <div style="display: flex; flex-direction: column; gap: 1.5rem;">
              <div>
                  <span style="display: block; font-size: 0.85rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">DNI</span>
                  <span style="font-family: var(--font-mono); font-size: 1.2rem; color: var(--text); font-weight: 500;">{{ $cliente->DNI }}</span>
              </div>

              <div>
                  <span style="display: block; font-size: 0.85rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Teléfono de Contacto</span>
                  <span style="font-family: var(--font-mono); font-size: 1.2rem; color: var(--text); font-weight: 500;">{{ $cliente->telefono }}</span>
              </div>

              <div>
                  <span style="display: block; font-size: 0.85rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Correo Electrónico</span>
                  <span style="font-size: 1.2rem; color: var(--text); font-weight: 500;">{{ $cliente->email }}</span>
              </div>
          </div>
      </div>
  </div>

  <form action="" method="post" id="form-delete">
      @csrf
      @method('delete')
  </form>

@endsection

@section('scripts')
<script src="{{ url('assets/js/borrar.js') }}"></script>
@endsection