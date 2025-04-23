@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">Clientes</h2>

  <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Crear Cliente</a>

  @if ($clientes->isEmpty())
    <div class="alert alert-info">No hay clientes registrados.</div>
  @else
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Licencia expira</th>
          <th>Ultima sesion</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($clientes as $cliente)
          <tr>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->licencia_expires_at ? $cliente->licencia_expires_at : 'Sin fecha' }}</td>
            <td>{{ $cliente->last_used_at ? $cliente->last_used_at : 'Sin fecha' }}</td>
            <td>
              <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">Editar</a>
              <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection