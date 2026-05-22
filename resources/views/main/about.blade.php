@extends('bootstrap.template')

@section('title', 'Acerca de VideoClub App')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Acerca de la Aplicación</h1>
    <a href="{{ route('main') }}" class="btn btn-outline">← Volver al Panel</a>
  </div>

  <div class="form-card" style="max-width: 800px; margin: 0 auto;">
    
    <h3 style="color: var(--gold); font-family: var(--font-display); font-size: 1.8rem; letter-spacing: 1px; margin-bottom: 1rem;">
        Propósito del Proyecto
    </h3>
    <p style="color: var(--text); font-size: 1.05rem; line-height: 1.7; margin-bottom: 2rem;">
        Esta aplicación es un sistema de gestión integral diseñado para administrar todos los aspectos de un videoclub moderno. Facilita el seguimiento automático del inventario, la administración de la base de datos de clientes y el registro preciso de las transacciones de alquiler en tiempo real.
    </p>

    <hr style="border-top: 1px solid var(--border); margin: 2rem 0;">

    <h3 style="color: var(--gold); font-family: var(--font-display); font-size: 1.8rem; letter-spacing: 1px; margin-bottom: 1.25rem;">
        Módulos Principales
    </h3>
    <ul style="display: flex; flex-direction: column; gap: 0.85rem; color: var(--text); font-size: 1rem; padding-left: 0;">
        <li style="display: flex; align-items: center; gap: 0.75rem;">
            <span style="color: var(--gold);">🎬</span> <strong>Catálogo de Películas:</strong> Gestión completa de títulos, directores y clasificaciones por edades.
        </li>
        <li style="display: flex; align-items: center; gap: 0.75rem;">
            <span style="color: var(--cyan);">👥</span> <strong>Gestión de Clientes:</strong> Control de perfiles de usuarios, documentación de contacto y avatares.
        </li>
        <li style="display: flex; align-items: center; gap: 0.75rem;">
            <span style="color: var(--red);">📀</span> <strong>Inventario de Copias:</strong> Registro físico de formatos (DVD, Blu-Ray, CD) acoplados mediante códigos de barras únicos.
        </li>
        <li style="display: flex; align-items: center; gap: 0.75rem;">
            <span style="color: var(--green);">🤝</span> <strong>Flujo de Alquileres:</strong> Control transaccional riguroso de fechas de salida, devoluciones pendientes y tarifas.
        </li>
    </ul>

    <hr style="border-top: 1px solid var(--border); margin: 2rem 0;">

    <h3 style="color: var(--gold); font-family: var(--font-display); font-size: 1.8rem; letter-spacing: 1px; margin-bottom: 1.25rem;">
        Stack Tecnológico
    </h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.5rem; font-family: var(--font-mono); font-size: 0.85rem;">
        <div style="background: var(--bg3); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--border);">
            <span style="color: var(--red); display: block; font-weight: 700; margin-bottom: 0.25rem;">FRAMEWORK</span>
            Laravel 12 (PHP)
        </div>
        <div style="background: var(--bg3); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--border);">
            <span style="color: var(--cyan); display: block; font-weight: 700; margin-bottom: 0.25rem;">BASE DE DATOS</span>
            MySQL / Eloquent ORM
        </div>
        <div style="background: var(--bg3); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--border);">
            <span style="color: var(--gold); display: block; font-weight: 700; margin-bottom: 0.25rem;">INTERFAZ / UI</span>
            Blade & Pure CSS3
        </div>
        <div style="background: var(--bg3); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--border);">
            <span style="color: var(--green); display: block; font-weight: 700; margin-bottom: 0.25rem;">INTEGRACIONES</span>
            TMDb API Service
        </div>
    </div>

  </div>

@endsection