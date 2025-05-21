@extends('layouts.master')

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
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Accidentes Registrados</h5>
                            <div class="card-tools">
                                <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                    Registrar Nuevo
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Fecha y Hora</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Tipo de Lesión</th>
                                            <th class="text-center">Tipo de Riesgo</th>
                                            <th class="text-center">Tipo de Accidente</th>
                                            <th class="text-center">Gravedad</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($accidentes as $accidente)
                                            <tr>
                                                <td class="text-center align-middle">{{ $accidente->id }}</td>
                                                <td class="align-middle">{{ $accidente->fecha_hora }}</td>
                                                <td class="align-middle">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle">{{ ucfirst($accidente->gravedad) }}</td>
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
                                                <td colspan="8" class="text-center">No hay accidentes registrados.</td>
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
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <form id="formEditar" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarLabel">Editar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="fecha_hora">Fecha y Hora</label>
                                        <input type="datetime-local" name="fecha_hora" id="edit-fecha_hora" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="area_unidad_productiva_id">Área/Unidad Productiva</label>
                                        <select name="area_unidad_productiva_id" id="edit-area_unidad_productiva_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="tipo_lesion_id">Tipo de Lesión</label>
                                        <select name="tipo_lesion_id" id="edit-tipo_lesion_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposLesion as $tipoLesion)
                                                <option value="{{ $tipoLesion->id }}">{{ $tipoLesion->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="tipo_riesgo_id">Tipo de Riesgo</label>
                                        <select name="tipo_riesgo_id" id="edit-tipo_riesgo_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tipoRiesgo as $tipoRiesgo)
                                                <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="tipo_accidente_id">Tipo de Accidente</label>
                                        <select name="tipo_accidente_id" id="edit-tipo_accidente_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($datos as $tipoAccidente)
                                                <option value="{{ $tipoAccidente->id }}">{{ $tipoAccidente->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="gravedad">Gravedad</label>
                                        <select name="gravedad" id="edit-gravedad" class="form-control" required>
                                            <option value="leve">Leve</option>
                                            <option value="moderada">Moderada</option>
                                            <option value="grave">Grave</option>
                                            <option value="fatal">Fatal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="descripcion">Descripción</label>
                                        <textarea name="descripcion" id="edit-descripcion" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="evidencia">Evidencia</label>
                                        <textarea name="evidencia" id="edit-evidencia" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="creado_por">Creado Por</label>
                                        <input type="text" name="creado_por" id="edit-creado_por" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Eliminar (opcional) --}}
            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="formEliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eliminarLabel">Eliminar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este accidente?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración para el modal de edición
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

            // Configuración para el modal de eliminación
            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEliminar').action = `/accidentes/${id}`;
                });
            });
        });
    </script>

    <style>
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }
            .table th, .table td {
                padding: 0.5rem;
                white-space: nowrap;
            }
            .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            .modal-dialog {
                margin: 1rem;
            }
        }

        @media (max-width: 576px) {
            .table th, .table td {
                font-size: 0.75rem;
                padding: 0.3rem;
            }
            .btn-sm {
                font-size: 0.7rem;
                padding: 0.2rem 0.4rem;
            }
            .modal-content {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection