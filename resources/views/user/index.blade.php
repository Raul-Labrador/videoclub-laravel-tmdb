@extends('layouts.template')

@section('title', 'Dashboard — Usuarios')

@section('content')

  <div class="page-header">
    <h1 class="page-title">Dashboard <span>usuarios registrados</span></h1>
  </div>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Verificado</th>
          <th>Registrado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $usuario)
          <tr>
            <td><span class="badge badge-muted">{{ $usuario->id }}</span></td>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
              @if($usuario->email_verified_at)
                <span class="badge badge-green">Verificado</span>
              @else
                <span class="badge badge-red">Pendiente</span>
              @endif
            </td>
            <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--muted);">
              {{ $usuario->created_at->format('d/m/Y') }}
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="table-footer">
          <td colspan="4">Total de usuarios registrados</td>
          <td>{{ count($usuarios) }}</td>
        </tr>
      </tfoot>
    </table>
  </div>

@endsection