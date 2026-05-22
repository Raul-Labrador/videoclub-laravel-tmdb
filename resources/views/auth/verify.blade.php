@extends('bootstrap.template')

@section('title', 'Verifica tu Email')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Verificación de Correo</h1>
  </div>

  <div class="form-card" style="margin: 0 auto; text-align: center;">
    
    @if (session('resent'))
        <div class="alert alert-success" style="justify-content: center; margin-bottom: 1.5rem;">
          ✓ Se ha enviado un nuevo enlace de verificación a tu correo.
        </div>
    @endif

    <div style="color: var(--muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
        <p>Antes de continuar, por favor revisa tu bandeja de entrada para verificar tu dirección de correo electrónico a través del enlace que te hemos enviado.</p>
        <p style="margin-top: 0.5rem;">Si no has recibido el mensaje, puedes solicitar otro haciendo clic en el botón de abajo.</p>
    </div>

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-gold" style="width: 100%; justify-content: center;">
            Solicitar otro enlace
        </button>
    </form>
  </div>

@endsection