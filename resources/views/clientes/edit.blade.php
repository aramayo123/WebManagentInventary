@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Cliente</h2>
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label @error('nombre') is-invalid @enderror">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ $cliente->email }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"
                    value="{{ $cliente->password }}" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="licencia_expires_at" class="form-label @error('password') is-invalid @enderror">Licencia
                    expira</label>
                <input type="date" name="licencia_expires_at" class="form-control"
                    value="{{ optional($cliente->licencia_expires_at)->format('Y-m-d') }}">
                @error('licencia_expires_at')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
