@extends('instructor.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Registrar Persona Involucrada</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('personas_involucradas.store') }}" method="POST">
        @csrf

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        {{-- Apellido --}}
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
        </div>

        {{-- Cargo --}}
        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargo</label>
            <select name="cargo_id" class="form-control">
                <option value="">Seleccione un cargo</option>
                @foreach($datos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Accidente --}}
        <div class="mb-3">
            <label for="accidente_id" class="form-label">Accidente</label>
            <select name="accidente_id" class="form-control">
                <option value="">Seleccione un accidente</option>
                @foreach($accidentes as $accidente)
                    <option value="{{ $accidente->id }}" {{ old('accidente_id') == $accidente->id ? 'selected' : '' }}>
                        Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 30) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Persona</button>
    </form>
</div>
@endsection
