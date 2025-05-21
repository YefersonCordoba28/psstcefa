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

            <form action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- [Mantengo todos los campos existentes igual...] --}}
                
                {{-- Campo Evidencia actualizado para subir imágenes --}}
                <div class="mt-4">
                    <label for="evidencia" class="form-label fw-semibold">
                        <i class="fas fa-image me-1"></i>Evidencia (Imagen)
                    </label>
                    <input type="file" class="form-control" id="evidencia" name="evidencia" accept="image/*">
                    <small class="text-muted">Formatos aceptados: JPEG, PNG, JPG. Tamaño máximo: 2MB</small>
                    @error('evidencia')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- [Mantengo el resto del formulario igual...] --}}

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i> Registrar Accidente
                    </button>
                    <a href="{{ route('accidentes.index') }}" class="btn btn-primary">
                        <i class="fas fa-list me-2"></i> Ver Lista de Accidentes
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection