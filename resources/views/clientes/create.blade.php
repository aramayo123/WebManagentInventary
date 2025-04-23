@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Cliente</h2>
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"> 
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <div class="mb-3">
                <label for="licencia_expires_at" class="form-label @error('password') is-invalid @enderror">Licencia expira</label>
                <input type="date" name="licencia_expires_at" value="{{ old('licencia_expires_at') }}"
                    class="form-control">
                    @error('licencia_expires_at')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
@endsection
