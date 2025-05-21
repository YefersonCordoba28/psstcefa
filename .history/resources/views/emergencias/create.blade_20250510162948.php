@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-fire me-2"></i>Registrar Emergencia</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('emergencias.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- ... otros campos ... --}}

    {{-- Evidencia --}}
    <div class="mt-4">
        <label for="evidencia" class="form-label fw-semibold">
            <i class="fas fa-paperclip me-1"></i>Evidencia (opcional)
        </label>
        <input type="file" name="evidencia" class="form-control">
    </div>

    {{-- ... otros campos ... --}}

    <div class="text-end mt-4">
        <button type="submit" class="btn btn-dark px-4">
            <i class="fas fa-save me-2"></i>Registrar Emergencia
        </button>
    </div>
</form>

            </form>
        </div>
    </div>
</div>
@endsection
