@extends('layouts.template')

@section('title', 'Crear Cuenta')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Crear Cuenta</h1>
  </div>

  <div class="form-card" style="margin: 0 auto;">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">Nombre de Usuario</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ej: JuanPerez">
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Correo Electrónico</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="correo@ejemplo.com">
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
            @error('password') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password-confirm">Confirmar Contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
        </div>

        <div class="form-actions" style="flex-direction: column; gap: 1rem; align-items: stretch; text-align: center;">
            <button type="submit" class="btn btn-gold" style="justify-content: center;">
                Registrar Cuenta
            </button>
            
            <div style="margin-top: 0.5rem; font-size: 0.85rem;">
                <a href="{{ route('login') }}" style="color: var(--gold); font-weight: 500;">¿Ya tienes una cuenta? Inicia sesión</a>
            </div>
        </div>
    </form>
  </div>

@endsection