<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="VideoClub App — Gestión de películas, alquileres y catálogo">
  <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon.ico') }}">
  <title>@yield('title', 'VideoClub App')</title>

  {{-- Fuentes y CSS global --}}
  <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">

  {{-- CSS específico de la vista --}}
  @yield('styles')
</head>
<body>

{{-- NAVBAR --}}
  <nav class="navbar">
    <div class="navbar-inner">

      {{-- Logo --}}
      <a href="{{ route('main') }}" class="navbar-brand">
        VIDEO<span>CLUB</span>
      </a>

      {{-- Links públicos --}}
      <div class="navbar-links">
        <a href="{{ route('main') }}" class="{{ request()->routeIs('main') ? 'active' : '' }}">Inicio</a>
        <a href="{{ route('pelicula.index') }}" class="{{ request()->routeIs('pelicula.*') ? 'active' : '' }}">Películas</a>
        <a href="{{ route('copia.index') }}" class="{{ request()->routeIs('copia.*') ? 'active' : '' }}">Copias</a>

        @auth
          @if(Auth::user()->hasVerifiedEmail())
            <a href="{{ route('cliente.index') }}" class="{{ request()->routeIs('cliente.*') ? 'active' : '' }}">Clientes</a>
            <a href="{{ route('alquiler.index') }}" class="{{ request()->routeIs('alquiler.*') ? 'active' : '' }}">Alquiler</a>
          @endif
        @endauth
      </div>

      {{-- Auth --}}
      <div class="navbar-auth">
        @guest
          <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
          <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Registro</a>
        @else
          @if(Auth::user()->hasVerifiedEmail())
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
          @endif
          <a href="{{ route('home') }}" class="{{ request()->routeIs('home*') ? 'active' : '' }}">Perfil</a>
          <form action="{{ route('logout') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit" class="btn-nav-logout">Logout</button>
          </form>
        @endguest
      </div>

    </div>
  </nav>

  {{-- CONTENIDO PRINCIPAL --}}
  <main class="page-wrapper">

    {{-- Alertas de sesión --}}
    @if(session('mensajeTexto'))
      <div class="alert alert-success">
        ✓ {{ session('mensajeTexto') }}
      </div>
    @endif

    @error('mensajeTexto')
      <div class="alert alert-danger">
        ✕ {{ $message }}
      </div>
    @enderror

    @yield('content')

  </main>

  {{-- FOOTER --}}
  <footer>
    <span>© {{ date('Y') }} VideoClub App — Proyecto académico</span>
  </footer>

  {{-- Scripts --}}
  <script src="{{ url('assets/js/main.js') }}"></script>
  @yield('scripts')

</body>
</html>