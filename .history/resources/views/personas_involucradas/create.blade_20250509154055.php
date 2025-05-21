@extends('layouts')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Registrar Persona Involucrada</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('personas_involucradas.store') }}" method="POST" class="row g-3">
        @csrf

        {{-- Nombre --}}
        <div class="col-12 col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        {{-- Apellido --}}
        <div class="col-12 col-md-6">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
        </div>

        {{-- Cargo --}}
        <div class="col-12">
            <label for="cargo_id" class="form-label">Cargo</label>
            <select name="cargo_id" class="form-select">
                <option value="">Seleccione un cargo</option>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Accidente --}}
        <div class="col-12">
            <label for="accidente_id" class="form-label">Accidente</label>
            <select name="accidente_id" class="form-select">
                <option value="">Seleccione un accidente</option>
                @foreach($accidentes as $accidente)
                    <option value="{{ $accidente->id }}" {{ old('accidente_id') == $accidente->id ? 'selected' : '' }}>
                        Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 30) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary w-100 w-md-auto">Registrar Persona</button>
        </div>
    </form>
</div>

<style>
    .container {
        max-width: 800px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 0.375rem;
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }

    .btn-primary {
        padding: 0.5rem 2rem;
        font-size: 1rem;
        border-radius: 0.375rem;
    }

    .alert {
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        padding: 1rem;
        border-radius: 0.375rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        .form-control, .form-select {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
        }

        .btn-primary {
            font-size: 0.9rem;
            padding: 0.4rem 1.5rem;
        }

        .alert {
            font-size: 0.85rem;
            padding: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.25rem;
        }

        .form-control, .form-select {
            font-size: 0.85rem;
        }

        .btn-primary {
            font-size: 0.85rem;
            padding: 0.4rem 1rem;
            width: 100%;
        }

        .form-label {
            font-size: 0.9rem;
        }

        .alert {
            font-size: 0.8rem;
        }
    }
</style>
@endsection