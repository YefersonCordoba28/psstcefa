@extends('instructor.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-center">Lista de Accidentes</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center bg-dark text-white">
                        <h5 class="card-title m-0 mb-2 mb-md-0">Accidentes Registrados</h5>
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">Registrar Nuevo</a>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
                                Registrar Persona Involucrada
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-2 p-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center" style="width: 5%;">ID</th>
                                        <th class="text-center" style="width: 15%;">Fecha y hora</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Tipo de lesión</th>
                                        <th class="text-center">Tipo de riesgo</th>
                                        <th class="text-center">Tipo de accidente</th>
                                        <th class="text-center">Gravedad</th>
                                        <th class="text-center" style="width: 10%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accidentes as $accidente)
                                        <tr>
                                            <td class="text-center align-middle">{{ $accidente->id }}</td>
                                            <td class="text-center align-middle">{{ $accidente->fecha_hora }}</td>
                                            <td class="text-center align-middle">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="text-center align-middle">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                            <td class="text-center align-middle">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                            <td class="text-center align-middle">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                            <td class="text-center align-middle">
                                                <span class="badge {{ $accidente->gravedad === 'leve' ? 'bg-success' : ($accidente->gravedad === 'moderada' ? 'bg-warning' : ($accidente->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                    {{ ucfirst($accidente->gravedad) }}
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">
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

        {{-- Modal Editar --}}
        @include('accidentes.partials.modal_editar', ['areas' => $areas, 'tiposLesion' => $tiposLesion, 'tiposRiesgo' => $tiposRiesgo, 'tiposAccidente' => $tiposAccidente])

        {{-- Modal Eliminar --}}
        @include('accidentes.partials.modal_eliminar')

        {{-- Modal Persona Involucrada --}}
        @include('accidentes.partials.modal_persona_involucrada', ['cargos' => $cargos, 'accidentes' => $accidentes])
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function () {
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
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/accidentes/${id}`;
            });
        });
    });
</script>

<style>
    .table {
        width: 100%;
        background-color: #fff;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border: 1px solid #dee2e6;
    }

    .table th {
        font-weight: 600;
        white-space: normal;
        text-transform: uppercase;
    }

    .table td {
        white-space: normal;
        word-break: break-word;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
    }

    .btn-sm {
        padding: 0.35rem 0.75rem;
        font-size: 0.875rem;
    }

    .card {
        border-radius: 0.5rem;
    }

    @media (max-width: 992px) {
        .table th, .table td {
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 768px) {
        .modal-content {
            font-size: 0.9rem;
        }
    }
</style>

@endsection
