@extends('layouts.template')

@section('title', 'Editar Perfil')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Editar Perfil</h1>
    <a href="{{ route('home') }}" class="btn btn-outline">← Volver</a>
  </div>

  <div class="form-card" style="margin: 0 auto; max-width: 600px;">
    <form method="POST" action="{{ route('home.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label" for="name">Nombre</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Correo Electrónico</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <hr style="border-top: 1px solid var(--border); margin: 2rem 0;">
        <p style="color: var(--gold); font-size: 0.9rem; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Cambiar Contraseña (Opcional)</p>

        <div class="form-group">
            <label class="form-label" for="currentpassword">Contraseña Actual</label>
            <input id="currentpassword" type="password" class="form-control" name="currentpassword" placeholder="Requerida solo si cambias la contraseña">
            @error('currentpassword') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Nueva Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" autocomplete="new-password" placeholder="Dejar en blanco para mantener la actual">
            @error('password') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password-confirm">Confirmar Nueva Contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">Guardar Cambios</button>
            <a href="{{ route('home') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
  </div>

@endsection