@extends('layouts.template')

@section('title', 'Clientes')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Clientes <span>{{ $clientes->count() }} registrados</span></h1>
    @if(Auth::check() && Auth::user()->rol === 'admin')
        <a href="{{ route('cliente.create') }}" class="btn btn-gold">+ Registrar Cliente</a>
    @endif
  </div>

  @if($clientes->isEmpty())
    <div class="empty-state">
      <div class="empty-state-icon">👥</div>
      <p>Aún no hay clientes registrados.</p>
    </div>
  @else
    <div class="cliente-grid">
      @foreach($clientes as $cliente)
        <div class="cliente-card">
          <div class="cliente-avatar"><img src="{{ $cliente->getPath() }}" alt="{{ $cliente->nombre }}"></div>
          <div class="cliente-info">
            <div class="cliente-name">{{ $cliente->nombre }} {{ $cliente->apellidos }}</div>
            <div class="cliente-email">{{ $cliente->email }}</div>
          </div>
          <div class="cliente-actions">
            <a href="{{ route('cliente.show', $cliente->id) }}" class="btn btn-outline btn-sm">Ver perfil</a>
            @if(Auth::check() && Auth::user()->rol === 'admin')
                <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-outline-red btn-sm">Editar</a>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endsection