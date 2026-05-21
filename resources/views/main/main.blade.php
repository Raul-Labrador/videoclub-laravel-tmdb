@extends('bootstrap.template')

@section('title', 'Panel de Gestión — VideoClub')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Panel de Gestión</h1>
  </div>

  <div class="dashboard-grid">

    <a href="{{ route('pelicula.index') }}" class="dashboard-card gold">
      <div class="dashboard-card-icon">🎬</div>
      <div class="dashboard-card-title">Catálogo de Películas</div>
      <div class="dashboard-card-desc">Administrar títulos, directores y portadas.</div>
    </a>

    @auth
      @if(Auth::user()->hasVerifiedEmail())
        <a href="{{ route('cliente.index') }}" class="dashboard-card cyan">
          <div class="dashboard-card-icon">👥</div>
          <div class="dashboard-card-title">Clientes</div>
          <div class="dashboard-card-desc">Gestionar perfiles, contactos y datos de clientes.</div>
        </a>
      @endif
    @endauth

    <a href="{{ route('copia.index') }}" class="dashboard-card red">
      <div class="dashboard-card-icon">📀</div>
      <div class="dashboard-card-title">Inventario y Copias</div>
      <div class="dashboard-card-desc">Control de stock, códigos de barras y formatos.</div>
    </a>

    @auth
      @if(Auth::user()->hasVerifiedEmail())
        <a href="{{ route('alquiler.index') }}" class="dashboard-card green">
          <div class="dashboard-card-icon">🤝</div>
          <div class="dashboard-card-title">Registros de Alquiler</div>
          <div class="dashboard-card-desc">Rastrear transacciones, fechas de salida y devolución.</div>
        </a>
      @endif
    @endauth

    <a href="{{ route('about') }}" class="dashboard-card">
      <div class="dashboard-card-icon">ℹ️</div>
      <div class="dashboard-card-title">Acerca de</div>
      <div class="dashboard-card-desc">Información de la aplicación.</div>
    </a>

  </div>

@endsection