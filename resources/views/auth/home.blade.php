@extends('bootstrap.template')

@section('title', 'Mi Perfil')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Mi Perfil</h1>
  </div>

  <div class="form-card" style="margin: 0 auto; max-width: 500px;">
    
    @if (session('general'))
        <div class="alert alert-success">
            ✓ {{ session('general') }}
        </div>
    @endif

    <div style="margin-bottom: 2rem;">
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            
            <!-- Nombre -->
            <div style="padding-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Nombre de Usuario</span>
                <span style="font-size: 1.1rem; color: var(--text); font-weight: 500;">{{ Auth::user()->name }}</span>
            </div>

            <!-- Correo -->
            <div style="padding-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Correo Electrónico</span>
                <span style="font-size: 1.1rem; color: var(--text); font-weight: 500;">{{ Auth::user()->email }}</span>
            </div>

            <!-- Registro y Verificación -->
            <div style="display: flex; gap: 2rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                <div style="flex: 1;">
                    <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Miembro desde</span>
                    <span style="font-family: var(--font-mono); font-size: 0.95rem; color: var(--text);">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                </div>
                <div style="flex: 1;">
                    <span style="display: block; font-size: 0.8rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">Estado de cuenta</span>
                    <div style="margin-top: 0.2rem;">
                        @if(Auth::user()->hasVerifiedEmail())
                            <span class="badge badge-green">Verificado</span>
                        @else
                            <span class="badge badge-red">Pendiente</span>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="form-actions" style="margin-top: 0; padding-top: 0; border: none; justify-content: center;">
        <a href="{{ route('home.edit') }}" class="btn btn-gold" style="width: 100%; justify-content: center;">
            Editar Perfil
        </a>
    </div>

  </div>

@endsection