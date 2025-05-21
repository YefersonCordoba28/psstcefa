@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Accidente</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('accidentes.store') }}" method="POST">
                @csrf

                {{-- Resto del formulario se mantiene igual --}}
                {{-- ... --}}

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('accidentes.index') }}" class="btn btn-primary">
                        <i class="fas fa-list me-2"></i> Ver Lista de Accidentes
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i> Registrar Accidente
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection