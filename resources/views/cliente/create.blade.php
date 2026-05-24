@extends('layouts.template')

@section('title', 'Añadir Cliente')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Añadir Cliente</h1>
    <a href="{{ route('cliente.index') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data"> 
        @csrf

        <div class="form-group">
            <label class="form-label" for="DNI">DNI</label>
            <input class="form-control" minlength="9" maxlength="9" required id="DNI" name="DNI" placeholder="DNI del cliente" value="{{ old('DNI') }}" type="text">
            @error('DNI') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" minlength="3" maxlength="60" required id="nombre" name="nombre" placeholder="Nombre del cliente" value="{{ old('nombre') }}" type="text">
            @error('nombre') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="apellidos">Apellidos</label>
            <input class="form-control" minlength="3" maxlength="60" required id="apellidos" name="apellidos" placeholder="Apellidos del cliente" value="{{ old('apellidos') }}" type="text">
            @error('apellidos') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="telefono">Teléfono</label>
            <input class="form-control" minlength="9" maxlength="9" required id="telefono" name="telefono" placeholder="Teléfono de contacto" value="{{ old('telefono') }}" type="text">
            @error('telefono') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" minlength="3" maxlength="70" required id="email" name="email" placeholder="Correo de contacto" value="{{ old('email') }}" type="text">
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Foto de perfil <span style="color:var(--muted); font-weight:400;">(opcional)</span></label>
            
            <!-- Zona de Drag & Drop adaptada al diseño global -->
            <div id="dropZone" class="drop-zone" style="border: 2px dashed var(--border2); border-radius: var(--radius-sm); padding: 2rem; text-align: center; cursor: pointer; background: var(--bg3); transition: all 0.3s ease; margin-top: 0.5rem;">
                <div class="drop-zone-icon" style="font-size: 2rem; margin-bottom: 0.5rem; color: var(--gold);">📷</div>
                <div class="drop-zone-text" style="color: var(--muted); font-size: 0.9rem;">
                    <strong>Arrastra una imagen aquí</strong> o haz clic para seleccionar
                    <br>
                    <small>Formatos: JPG, PNG, GIF (Máx. 2MB)</small>
                </div>
                <div id="imagePreview"></div>
            </div>
            
            <!-- Input oculto -->
            <input class="form-control" id="foto" name="foto" type="file" accept="image/*" style="display: none;">
            @error('foto') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Registrar Cliente</button>
            <a href="{{ route('cliente.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection

@section('scripts')
<script src="{{ url('assets/js/upload.js') }}"></script>
@endsection