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
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center bg-dark text-white">
                            <h5 class="card-title m-0">Accidentes Registrados</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                    Registrar Nuevo
                                </a>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
                                    Registrar Persona Involucrada
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle">
                                    <thead class="thead-dark bg-dark text-white text-center">
                                        <tr>
                                            <th>Identificación</th>
                                            <th>Fecha y Hora</th>
                                            <th>Área</th>
                                            <th>Tipo de Lesión</th>
                                            <th>Tipo de Riesgo</th>
                                            <th>Tipo de Accidente</th>
                                            <th>Gravedad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($accidentes as $accidente)
                                            <tr>
                                                <td>{{ $accidente->id }}</td>
                                                <td>{{ $accidente->fecha_hora }}</td>
                                                <td>{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                                <td>{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                                <td>{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                                <td>{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge {{ $accidente->gravedad === 'leve' ? 'bg-success' : ($accidente->gravedad === 'moderada' ? 'bg-warning' : ($accidente->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                        {{ ucfirst($accidente->gravedad) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
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
                                                        data-bs-toggle="modal" data-bs-target="#editar">
                                                        Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deletebtn"
                                                        data-id="{{ $accidente->id }}"
                                                        data-bs-toggle="modal" data-bs-target="#eliminar">
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
            @include('accidentes.partials.modal_editar')

            {{-- Modal Eliminar --}}
            @include('accidentes.partials.modal_eliminar')

            {{-- Modal Persona Involucrada --}}
            @include('accidentes.partials.modal_persona')

        </div>
    </section>

    {{-- JS para manejo de modales --}}
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
        .table th, .table td {
            vertical-align: middle;
            white-space: nowrap;
        }

        .badge {
            font-size: 0.85rem;
        }

        @media (max-width: 992px) {
            .card-header h5 {
                font-size: 1rem;
            }
            .table-responsive {
                overflow-x: auto;
            }
            .table th, .table td {
                font-size: 0.85rem;
                white-space: normal;
            }
        }

        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 0.8rem;
            }

            .btn-sm {
                padding: 0.3rem 0.6rem;
                font-size: 0.75rem;
            }
        }
    </style>
@endsection
