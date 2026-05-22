@extends('bootstrap.template')

@section('title', 'Editar Alquiler')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Editar Alquiler</h1>
    <a href="{{ route('alquiler.index') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card">
    <form action="{{ route('alquiler.update', $alquiler->id) }}" method="POST"> 
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label" for="idcopia">Copia a alquilar</label>
            <select name="idcopia" id="idcopia" required class="form-control">
                <option value="" @if(old('idcopia', $alquiler->idcopia) == null) selected @endif disabled>Selecciona una película</option>
                @foreach($copias as $copia)
                    <option value="{{ $copia->id }}" @if(old('idcopia', $alquiler->idcopia) == $copia->id) selected @endif>
                        {{ $copia->pelicula->titulo }} — {{ $copia->formato }}
                    </option>
                @endforeach
             </select>
             @error('idcopia') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="idcliente">Cliente</label>
            <select name="idcliente" id="idcliente" required class="form-control">
                <option value="" @if(old('idcliente', $alquiler->idcliente) == null) selected @endif disabled>Selecciona un cliente</option>
                @foreach($clientes as $indice => $idcliente)
                    <option value="{{ $indice }}" @if(old('idcliente', $alquiler->idcliente) == $indice) selected @endif>
                        {{ $idcliente }}
                    </option>
                @endforeach
             </select>
             @error('idcliente') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="fecha_sal">Fecha de salida</label>
            <input class="form-control" required id="fecha_sal" name="fecha_sal" value="{{ old('fecha_sal', $alquiler->fecha_sal) }}" type="date">
            @error('fecha_sal') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="fecha_dev">Fecha de devolución <span style="color:var(--muted); font-weight:400;">(opcional)</span></label>
            <input class="form-control" id="fecha_dev" name="fecha_dev" value="{{ old('fecha_dev', $alquiler->fecha_dev) }}" type="date">
            @error('fecha_dev') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="precio">Precio (€)</label>
            <input class="form-control" min="1" max="999" required id="precio" name="precio" placeholder="Ej: 3" value="{{ old('precio', $alquiler->precio) }}" type="number">
            @error('precio') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Actualizar Alquiler</button>
            <a href="{{ route('alquiler.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection