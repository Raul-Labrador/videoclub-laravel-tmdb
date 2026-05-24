@extends('layouts.template')

@section('title', 'Nuevo Alquiler')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Nuevo Alquiler</h1>
    <a href="{{ route('alquiler.index') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form action="{{ route('alquiler.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label class="form-label" for="idcopia">Copia a alquilar</label>
        <select name="idcopia" id="idcopia" required class="form-control">
          <option value="" disabled @if(old('idcopia') == null) selected @endif>Selecciona una película</option>
          @foreach($copias as $copia)
            <option value="{{ $copia->id }}" @if(old('idcopia') == $copia->id) selected @endif>
              {{ $copia->pelicula->titulo }} — {{ $copia->formato }}
            </option>
          @endforeach
        </select>
        @error('idcopia') <div class="form-error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="idcliente">Cliente</label>
        <select name="idcliente" id="idcliente" required class="form-control">
          <option value="" disabled @if(old('idcliente') == null) selected @endif>Selecciona un cliente</option>
          @foreach($clientes as $indice => $nombre)
            <option value="{{ $indice }}" @if(old('idcliente') == $indice) selected @endif>{{ $nombre }}</option>
          @endforeach
        </select>
        @error('idcliente') <div class="form-error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="fecha_sal">Fecha de salida</label>
        <input type="date" id="fecha_sal" name="fecha_sal" required class="form-control"
               value="{{ old('fecha_sal') }}">
        @error('fecha_sal') <div class="form-error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="fecha_dev">Fecha de devolución <span style="color:var(--muted); font-weight:400;">(opcional)</span></label>
        <input type="date" id="fecha_dev" name="fecha_dev" class="form-control"
               value="{{ old('fecha_dev') }}">
        @error('fecha_dev') <div class="form-error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="precio">Precio (€)</label>
        <input type="number" id="precio" name="precio" required min="1" max="999" class="form-control"
               placeholder="Ej: 3" value="{{ old('precio') }}">
        @error('precio') <div class="form-error">{{ $message }}</div> @enderror
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-gold">Registrar Alquiler</button>
        <a href="{{ route('alquiler.index') }}" class="btn btn-outline">Cancelar</a>
      </div>

    </form>
  </div>

@endsection