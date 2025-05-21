@extends('instructor.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 text-center">
                <h1 class="m-0">Lista de Accidentes</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center bg-dark text-white">
                        <h5 class="card-title m-0">Accidentes Registrados</h5>
                        <div class="d-flex gap-2 mt-2 mt-md-0">
                            <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nuevo
                            </a>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
                                Registrar Persona Involucrada
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-2 p-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr class="text-center">
                                        <th style="width: 5%;">ID</th>
                                        <th style="width: 15%;">Fecha y hora</th>
                                        <th style="width: 15%;">Área</th>
                                        <th style="width: 15%;">Tipo de lesión</th>
                                        <th style="width: 15%;">Tipo de riesgo</th>
                                        <th style="width: 15%;">Tipo de accidente</th>
                                        <th style="width: 10%;">Gravedad</th>
                                        <th style="width: 10%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accidentes as $accidente)
                                        <tr>
                                            <td class="text-center">{{ $accidente->id }}</td>
                                            <td class="text-center">{{ $accidente->fecha_hora }}</td>
                                            <td class="text-center">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $accidente->gravedad === 'leve' ? 'bg-success' : ($accidente->gravedad === 'moderada' ? 'bg-warning' : ($accidente->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                    {{ ucfirst($accidente->gravedad) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                    <button class="btn btn-success btn-sm editbtn"
                                                            data-id="{{ $accidente->id }}"
                                                            data-fecha_hora="{{ $accidente->fecha_hora }}"
                                                            data-area_unidad_productiva_id="{{ $accidente->area_unidad_productiva_id }}"
                                                            data-tipo_lesion_id="{{ $accidente->tipo_lesion_id }}"
                                                            data-tipo_riesgo_id="{{ $accidente->tipo_riesgo_id }}"
                                                            data-tipo_accidente_id="{{ $accidente->tipo_accidente_id }}"
                                                            data-descripcion="{{ $accidente->descripcion }}"
                                                            data-evidencia="{{ $accidente->evidencia }}"
                                                            data-gravedad="{{ $accidente->gravedad }}"
                                                            data-creado_por="{{ $accidente->creado_por }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editar">
                                                        Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deletebtn"
                                                            data-id="{{ $accidente->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#eliminar">
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-3">No hay accidentes registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modales --}}
        @include('modales.editar_accidente')
        @include('modales.eliminar_accidente')
        {{-- Modal Inline para Persona Involucrada --}}
        <div class="modal fade" id="modalPersonalizado" tabindex="-1" aria-labelledby="modalPersonalizadoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-3">
                    <h2 class="mb-4">Registrar Persona Involucrada</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('personas_involucradas.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required value="{{ old('nombre') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" name="apellido" class="form-control" required value="{{ old('apellido') }}">
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Registrar Persona</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/accidentes/${id}`;
                document.getElementById('edit-fecha_hora').value = this.getAttribute('data-fecha_hora').replace(' ', 'T');
                document.getElementById('edit-area_unidad_productiva_id').value = this.getAttribute('data-area_unidad_productiva_id');
                document.getElementById('edit-tipo_lesion_id').value = this.getAttribute('data-tipo_lesion_id');
                document.getElementById('edit-tipo_riesgo_id').value = this.getAttribute('data-tipo_riesgo_id');
                document.getElementById('edit-tipo_accidente_id').value = this.getAttribute('data-tipo_accidente_id');
                document.getElementById('edit-descripcion').value = this.getAttribute('data-descripcion') || '';
                document.getElementById('edit-evidencia').value = this.getAttribute('data-evidencia') || '';
                document.getElementById('edit-gravedad').value = this.getAttribute('data-gravedad');
                document.getElementById('edit-creado_por').value = this.getAttribute('data-creado_por');
            });
        });

        document.querySelectorAll('.deletebtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/accidentes/${id}`;
            });
        });
    });
</script>

<style>
    .badge {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
    }

    .card {
        border-radius: 0.5rem;
    }

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }

        .btn-sm {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .modal-content {
            font-size: 0.9rem;
        }

        .card-header h5 {
            font-size: 1rem;
        }
    }
</style>

@endsection
