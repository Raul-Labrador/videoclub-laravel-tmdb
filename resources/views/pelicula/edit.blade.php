@extends('bootstrap.template')

@section('title', 'Editar Película')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Editar Película</h1>
    <a href="{{ route('pelicula.index') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form action="{{ route('pelicula.update', $pelicula->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label" for="titulo">Título</label>
            <input class="form-control" minlength="3" maxlength="60" required id="titulo" name="titulo" placeholder="Título de la película" value="{{ old('titulo', $pelicula->titulo) }}" type="text">
            @error('titulo') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="director">Director</label>
            <input class="form-control" minlength="3" maxlength="60" required id="director" name="director" placeholder="Director de la película" value="{{ old('director', $pelicula->director) }}" type="text">
            @error('director') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="genero">Género</label>
            <input class="form-control" minlength="3" maxlength="60" required id="genero" name="genero" placeholder="Género de la película" value="{{ old('genero', $pelicula->genero) }}" type="text">
            @error('genero') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="actores">Actores</label>
            <textarea class="form-control" minlength="20" required id="actores" name="actores" placeholder="Actores que aparecen en la película" rows="4">{{ old('actores', $pelicula->actores) }}</textarea>
            @error('actores') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="fecha_estreno">Fecha de estreno</label>
            <input class="form-control" required id="fecha_estreno" name="fecha_estreno" value="{{ old('fecha_estreno', $pelicula->fecha_estreno) }}" type="date">
            @error('fecha_estreno') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="duracion">Duración (minutos)</label>
            <input class="form-control" min="1" max="999" required id="duracion" name="duracion" placeholder="Ej: 120" value="{{ old('duracion', $pelicula->duracion) }}" type="number">
            @error('duracion') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="clasificacion">Clasificación</label>
            <select class="form-control" required id="clasificacion" name="clasificacion">
                <option value="" disabled>Selecciona la clasificación</option>
                <option value="Apta para todos los publicos" @if(old('clasificacion', $pelicula->clasificacion) == 'Apta para todos los publicos') selected @endif>Apta para todos los públicos</option>
                <option value="+7" @if(old('clasificacion', $pelicula->clasificacion) == '+7') selected @endif>+7</option>
                <option value="+12" @if(old('clasificacion', $pelicula->clasificacion) == '+12') selected @endif>+12</option>
                <option value="+16" @if(old('clasificacion', $pelicula->clasificacion) == '+16') selected @endif>+16</option>
                <option value="+18" @if(old('clasificacion', $pelicula->clasificacion) == '+18') selected @endif>+18</option>
            </select>
            @error('clasificacion') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Portada de la película</label>
            
            @if($pelicula->portada != null)
            <div style="background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-sm); padding: 1rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 1rem;">
                <img src="{{ $pelicula->getPath() }}" width="60px" style="border-radius: var(--radius-sm); border: 1px solid var(--border);">
                <div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                        <input type="checkbox" value="true" id="deleteImage" name="deleteImage" style="accent-color: var(--red);">
                        <label for="deleteImage" style="color: var(--muted); font-size: 0.85rem; cursor: pointer;">Eliminar portada actual</label>
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
            
            <!-- Input oculto -->
            <input class="form-control" id="portada" name="portada" type="file" accept="image/*" style="display: none;">
            @error('portada') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Guardar Cambios</button>
            <a href="{{ route('pelicula.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection

@section('scripts')
<script src="{{ url('assets/js/upload.js') }}"></script>
@endsection