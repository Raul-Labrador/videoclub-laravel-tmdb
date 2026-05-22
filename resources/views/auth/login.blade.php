@extends('bootstrap.template')

@section('title', 'Iniciar Sesión')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Iniciar Sesión</h1>
  </div>

  <div class="form-card" style="margin: 0 auto;">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">Correo Electrónico</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="tu@email.com">
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="••••••••">
            @error('password') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem; margin-bottom: 1.5rem;">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color: var(--gold); width: auto; cursor: pointer;">
            <label class="form-label" for="remember" style="margin-bottom: 0; cursor: pointer; text-transform: none; font-weight: 500;">
                Recordarme en este equipo
            </label>
        </div>

        <div class="form-actions" style="flex-direction: column; gap: 1rem; align-items: stretch; text-align: center;">
            <button type="submit" class="btn btn-gold" style="justify-content: center;">
                Entrar a la aplicación
            </button>

            <div style="margin-top: 0.5rem; display: flex; justify-content: space-between; font-size: 0.85rem;">
                <a href="{{ route('register') }}" style="color: var(--gold); font-weight: 500;">¿No tienes cuenta? Regístrate</a>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: var(--muted);">¿Olvidaste tu contraseña?</a>
                @endif
            </div>
        </div>
    </form>
  </div>

@endsection