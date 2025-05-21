```blade
@extends('instructor.dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <!-- Header content if needed -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap py-3">
                            <h5 class="card-title m-0">Accidentes Registrados</h5>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                    Registrar Nuevo
                                </a>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
                                    Registrar Persona Involucrada
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3 p-md-4">
                            <!-- Search form by severity -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <form id="searchForm">
                                        <div class="input-group input-group-sm flex-nowrap">
                                            <select name="gravedad" id="gravedadFilter" class="form-select">
                                                <option value="">Busca por gravedad</option>
                                                <option value="leve">Leve</option>
                                                <option value="moderada">Moderada</option>
                                                <option value="grave">Grave</option>
                                                <option value="fatal">Fatal</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            <button type="button" id="resetFilter" class="btn btn-secondary">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle" id="accidentesTable">
                                    <thead class="thead-dark bg-dark text-white">
                                        <tr>
                                            <th class="text-center" data-label="Identificación">ID</th>
                                            <th class="text-center" data-label="Fecha y hora">Fecha/Hora</th>
                                            <th class="text-center" data-label="Área">Área</th>
                                            <th class="text-center" data-label="Tipo de lesión">Lesión</th>
                                            <th class="text-center" data-label="Tipo de riesgo">Riesgo</th>
                                            <th class="text-center" data-label="Tipo de accidente">Accidente</th>
                                            <th class="text-center" data-label="Gravedad">Gravedad</th>
                                            <th class="text-center" data-label="Evidencias">Evidencia</th>
                                            <th class="text-center" data-label="Acciones">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($accidentes as $accidente)
                                            <tr class="accidente-row" data-gravedad="{{ $accidente->gravedad }}">
                                                <td class="text-center align-middle" data-label="Identificación">{{ $accidente->id }}</td>
                                                <td class="align-middle text-center" data-label="Fecha y hora">{{ $accidente->fecha_hora }}</td>
                                                <td class="align-middle text-center" data-label="Área">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center" data-label="Tipo de lesión">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center" data-label="Tipo de riesgo">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center" data-label="Tipo de accidente">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center" data-label="Gravedad">
                                                    <span class="badge {{ $accidente->gravedad === 'leve' ? 'bg-success' : ($accidente->gravedad === 'moderada' ? 'bg-warning' : ($accidente->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                        {{ ucfirst($accidente->gravedad) }}
                                                    </span>
                                                </td>
                                                <td class="text-center align-middle" data-label="Evidencia">
                                                    @if($accidente->evidencia)
                                                        <img src="{{ asset('img_accidentes/' . basename($accidente->evidencia)) }}"
                                                             alt="Evidencia"
                                                             class="img-thumbnail evidence-img"
                                                             style="max-width: 80px; max-height: 80px;">
                                                    @else
                                                        <span class="text-muted">Sin evidencia</span>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle" data-label="Acciones">
                                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                        <button class="btn btn-success btn-sm editbtn action-btn"
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
                                                                data-bs-target="#editarModal">
                                                            Editar
                                                        </button>
                                                        <button class="btn btn-danger btn-sm deletebtn action-btn"
                                                                data-id="{{ $accidente->id }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#eliminarModal">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-3">No hay accidentes registrados.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal: Registrar Persona Involucrada -->
            <div class="modal fade" id="modalPersonalizado" tabindex="-1" aria-labelledby="modalPersonalizadoLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-3">
                        <form action="{{ route('personas_involucradas.store') }}" method="POST">
                            @csrf
                            <div class="modal-header bg-gradient bg-primary text-white rounded-top-3">
                                <h5 class="modal-title" id="modalPersonalizadoLabel">
                                    <i class="fas fa-user-plus me-2"></i>Registrar Persona
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body py-3 py-md-4 px-3 px-md-4">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user-tag"></i></span>
                                            <input type="text" name="apellido" class="form-control" placeholder="Ingrese el apellido" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="cargo_id" class="form-label">Cargo</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-briefcase"></i></span>
                                            <select name="cargo_id" class="form-select" required>
                                                <option value="">Seleccione un cargo</option>
                                                @foreach($cargos as $cargo)
                                                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="accidente_id" class="form-label">Accidente Asociado</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-exclamation-triangle"></i></span>
                                            <select name="accidente_id" class="form-select" required>
                                                <option value="">Seleccione un accidente</option>
                                                @foreach($accidentes as $accidente)
                                                    <option value="{{ $accidente->id }}">
                                                        Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 20) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light rounded-bottom-3 d-flex justify-content-between px-3 py-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-save me-1"></i>Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal: Editar Accidente -->
            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-3">
                        <form id="editarForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-gradient bg-primary text-white rounded-top-3">
                                <h5 class="modal-title" id="editarModalLabel">
                                    <i class="fas fa-edit me-2"></i>Editar Accidente
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body py-3 py-md-4 px-3 px-md-4">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label for="fecha_hora_edit" class="form-label">Fecha y Hora</label>
                                        <input type="datetime-local" class="form-control" id="fecha_hora_edit" name="fecha_hora" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="area_unidad_productiva_id_edit" class="form-label">Área</label>
                                        <select class="form-select" id="area_unidad_productiva_id_edit" name="area_unidad_productiva_id" required>
                                            <option value="">Seleccione un área</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="tipo_lesion_id_edit" class="form-label">Tipo de Lesión</label>
                                        <select class="form-select" id="tipo_lesion_id_edit" name="tipo_lesion_id" required>
                                            <option value="">Seleccione tipo</option>
                                            @foreach($tiposLesion as $tipoLesion)
                                                <option value="{{ $tipoLesion->id }}">{{ $tipoLesion->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="tipo_riesgo_id_edit" class="form-label">Tipo de Riesgo</label>
                                        <select class="form-select" id="tipo_riesgo_id_edit" name="tipo_riesgo_id Milton Friedman once said: "The Great Depression, like most other periods of severe unemployment, was produced by government mismanagement rather than by any inherent instability of the private economy." What do you think about this statement?