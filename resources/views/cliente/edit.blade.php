@extends('bootstrap.template')

@section('title', 'Editar Cliente')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Editar Cliente</h1>
    <a href="{{ route('cliente.index') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form action="{{ route('cliente.update', $cliente->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label" for="DNI">DNI</label>
            <input class="form-control" minlength="9" maxlength="9" required id="DNI" name="DNI" placeholder="DNI del cliente" value="{{ old('DNI', $cliente->DNI) }}" type="text">
            @error('DNI') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" minlength="3" maxlength="60" required id="nombre" name="nombre" placeholder="Nombre del cliente" value="{{ old('nombre', $cliente->nombre) }}" type="text">
            @error('nombre') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="apellidos">Apellidos</label>
            <input class="form-control" minlength="3" maxlength="60" required id="apellidos" name="apellidos" placeholder="Apellidos del cliente" value="{{ old('apellidos', $cliente->apellidos) }}" type="text">
            @error('apellidos') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="telefono">Teléfono</label>
            <input class="form-control" minlength="9" maxlength="9" required id="telefono" name="telefono" placeholder="Teléfono de contacto" value="{{ old('telefono', $cliente->telefono) }}" type="text">
            @error('telefono') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" minlength="3" maxlength="70" required id="email" name="email" placeholder="Correo de contacto" value="{{ old('email', $cliente->email) }}" type="text">
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Foto de perfil</label>
            
            @if($cliente->foto != null)
            <div style="background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-sm); padding: 1rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 1rem;">
                <img src="{{ $cliente->getPath() }}" width="80px" style="border-radius: var(--radius-sm); border: 1px solid var(--border);">
                <div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                        <input type="checkbox" value="true" id="deleteImage" name="deleteImage" style="accent-color: var(--red);">
                        <label for="deleteImage" style="color: var(--muted); font-size: 0.85rem; cursor: pointer;">Eliminar imagen actual</label>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Zona de Drag & Drop -->
            <div id="dropZone" class="drop-zone" style="border: 2px dashed var(--border2); border-radius: var(--radius-sm); padding: 2rem; text-align: center; cursor: pointer; background: var(--bg3); transition: all 0.3s ease;">
                <div class="drop-zone-icon" style="font-size: 2rem; margin-bottom: 0.5rem; color: var(--gold);">📷</div>
                <div class="drop-zone-text" style="color: var(--muted); font-size: 0.9rem;">
                    <strong>Arrastra una nueva imagen aquí</strong> o haz clic para cambiarla
                    <br>
                    <small>Formatos: JPG, PNG, GIF (Máx. 2MB)</small>
                </div>
                <div id="imagePreview"></div>
            </div>
            
            <input class="form-control" id="foto" name="foto" type="file" accept="image/*" style="display: none;">
            @error('foto') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Guardar Cambios</button>
            <a href="{{ route('cliente.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection

@section('scripts')
<script src="{{ url('assets/js/arrastrarPerfil.js') }}"></script>
<script>
    const dz = document.getElementById('dropZone');
    dz.addEventListener('dragover', () => { dz.style.borderColor = 'var(--gold)'; dz.style.background = 'var(--surface2)'; });
    dz.addEventListener('dragleave', () => { dz.style.borderColor = 'var(--border2)'; dz.style.background = 'var(--bg3)'; });
</script>
@endsection