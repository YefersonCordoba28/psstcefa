@extends('instructor.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                        <h5 class="card-title m-0">Incidentes Registrados</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('incidentes.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nuevo
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center" data-label="Identificación">ID</th>
                                        <th class="text-center" data-label="Fecha y hora">Fecha y Hora</th>
                                        <th class="text-center" data-label="Área">Área</th>
                                        <th class="text-center" data-label="Tipo de riesgo">Tipo de Riesgo</th>
                                        <th class="text-center" data-label="Tipo de incidente">Tipo de Incidente</th>
                                        <th class="text-center" data-label="Nivel de riesgo">Nivel de Riesgo</th>
                                        <th class="text-center" data-label="Creado por">Creado por</th>
                                        <th class="text-center" data-label="Acciones">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($incidentes as $incidente)
                                        <tr>
                                            <td class="text-center align-middle" data-label="Identificación">{{ $incidente->id }}</td>
                                            <td class="align-middle text-center" data-label="Fecha y hora">{{ $incidente->fecha_hora }}</td>
                                            <td class="align-middle text-center" data-label="Área">{{ $incidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="align-middle text-center" data-label="Tipo de riesgo">{{ $incidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                            <td class="align-middle text-center" data-label="Tipo de incidente">{{ $incidente->tipoIncidente->nombre ?? 'N/A' }}</td>
                                            <td class="align-middle text-center" data-label="Nivel de riesgo">
                                                <span class="badge {{ $incidente->nivel_riesgo === 'Bajo' ? 'bg-success' : ($incidente->nivel_riesgo === 'Medio' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ ucfirst($incidente->nivel_riesgo) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center" data-label="Creado por">{{ $incidente->creado_por }}</td>
                                            <td class="text-center align-middle" data-label="Acciones">
                                                <button class="btn btn-success btn-sm editbtn"
                                                        data-id="{{ $incidente->id }}"
                                                        data-fecha_hora="{{ $incidente->fecha_hora }}"
                                                        data-area_unidad_productiva_id="{{ $incidente->area_unidad_productiva_id }}"
                                                        data-tipo_riesgo_id="{{ $incidente->tipo_riesgo_id }}"
                                                        data-tipo_incidente_id="{{ $incidente->tipo_incidente_id }}"
                                                        data-descripcion="{{ $incidente->descripcion }}"
                                                        data-evidencia="{{ $incidente->evidencia }}"
                                                        data-nivel_riesgo="{{ $incidente->nivel_riesgo }}"
                                                        data-creado_por="{{ $incidente->creado_por }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editar">
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger btn-sm deletebtn"
                                                        data-id="{{ $incidente->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#eliminar">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-3">No hay incidentes registrados.</td>
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
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-lg">
                <form id="formEditar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Incidente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cols-1 row-cols-md-2 g-3">
                                <div class="col">
                                    <label for="fecha_hora">Fecha y Hora</label>
                                    <input type="datetime-local" name="fecha_hora" id="edit-fecha_hora" class="form-control form-control-sm" required>
                                </div>
                                <div class="col">
                                    <label for="area_unidad_productiva_id">Área/Unidad Productiva</label>
                                    <select name="area_unidad_productiva_id" id="edit-area_unidad_productiva_id" class="form-control form-control-sm" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="tipo_riesgo_id">Tipo de Riesgo</label>
                                    <select name="tipo_riesgo_id" id="edit-tipo_riesgo_id" class="form-control form-control-sm" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($tiposRiesgo as $tipoRiesgo)
                                            <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="tipo_incidente_id">Tipo de Incidente</label>
                                    <select name="tipo_incidente_id" id="edit-tipo_incidente_id" class="form-control form-control-sm" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($tiposIncidente as $tipoIncidente)
                                            <option value="{{ $tipoIncidente->id }}">{{ $tipoIncidente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="nivel_riesgo">Nivel de Riesgo</label>
                                    <select name="nivel_riesgo" id="edit-nivel_riesgo" class="form-control form-control-sm" required>
                                        <option value="Bajo">Bajo</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Alto">Alto</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="creado_por">Creado Por</label>
                                    <input type="text" name="creado_por" id="edit-creado_por" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-12">
                                    <label for="descripcion">Descripción</label>
                                    <textarea name="descripcion" id="edit-descripcion" class="form-control form-control-sm" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="evidencia">Evidencia</label>
                                    <textarea name="evidencia" id="edit-evidencia" class="form-control form-control-sm" rows="3"></textarea>
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

        {{-- Modal Eliminar --}}
        <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="formEliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarLabel">Eliminar Incidente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este incidente?
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
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/incidentes/${id}`;

                document.getElementById('edit-fecha_hora').value = this.getAttribute('data-fecha_hora').replace(' ', 'T');
                document.getElementById('edit-area_unidad_productiva_id').value = this.getAttribute('data-area_unidad_productiva_id');
                document.getElementById('edit-tipo_riesgo_id').value = this.getAttribute('data-tipo_riesgo_id');
                document.getElementById('edit-tipo_incidente_id').value = this.getAttribute('data-tipo_incidente_id');
                document.getElementById('edit-descripcion').value = this.getAttribute('data-descripcion') || '';
                document.getElementById('edit-evidencia').value = this.getAttribute('data-evidencia') || '';
                document.getElementById('edit-nivel_riesgo').value = this.getAttribute('data-nivel_riesgo');
                document.getElementById('edit-creado_por').value = this.getAttribute('data-creado_por');
            });
        });

        document.querySelectorAll('.deletebtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/incidentes/${id}`;
            });
        });
    });
</script>

<style>
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: #fff;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border: 1px solid #dee2e6;
        text-align: center;
    }

    .table th {
        font-weight: 600;
        white-space: nowrap;
        text-transform: uppercase;
    }

    .table td {
        white-space: normal;
        word-break: break-word;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.4em 0.8em;
        white-space: nowrap;
    }

    .btn-sm {
        padding: 0.35rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .card-header {
        padding: 1rem;
    }

    .modal-dialog-scrollable .modal-content {
        max-height: 90vh;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.85rem;
        }

        .table {
            display: block;
            overflow-x: auto;
        }

        .table thead {
            display: none;
        }

        .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }

        .table td {
            position: relative;
            padding-left: 50%;
            text-align: left;
            border: none;
            border-bottom: 1px solid #dee2e6;
        }

        .table td:before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 45%;
            padding-left: 10px;
            font-weight: bold;
            text-align: left;
            background-color: #f8f9fa;
        }

        .table td:last-child {
            border-bottom: none;
        }

        .btn-sm {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
        }

        .badge {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .table td {
            padding-left: 40%;
            font-size: 0.8rem;
        }

        .table td:before {
            width: 35%;
        }

        .btn-sm {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .card-header .d-flex {
            flex-direction: column;
            width: 100%;
        }

        .card-header .btn-sm {
            width: 100%;
            text-align: center;
        }

        .modal-content {
            font-size: 0.85rem;
        }

        .modal-dialog {
            margin: 0.5rem;
        }

        .modal-body {
            padding: 1rem;
        }
    }
</style>
@endsection