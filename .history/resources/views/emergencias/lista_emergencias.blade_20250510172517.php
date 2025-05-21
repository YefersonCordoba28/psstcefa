@extends('instructor.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <!-- Puedes agregar encabezado aquí si lo necesitas -->
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                        <h5 class="card-title m-0">Emergencias Registradas</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('emergencias.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nueva
                            </a>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonaEmergencia">
                                Registrar Persona Involucrada
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Filtro por tipo de emergencia -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form id="filterForm">
                                    <div class="input-group">
                                        <select name="tipo_emergencia" id="tipoEmergenciaFilter" class="form-control form-control-sm">
                                            <option value="">Filtrar por tipo</option>
                                            @foreach($tipos_emergencia as $tipo)
                                                <option value="{{ strtolower($tipo->nombre) }}">{{ $tipo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        <button type="button" id="resetFiltro" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-undo"></i> Resetear
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle" id="emergenciasTable">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha y hora</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Causa</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($emergencias as $emergencia)
                                        <tr class="emergencia-row" data-tipo="{{ strtolower($emergencia->tipoEmergencia->nombre ?? '') }}">
                                            <td class="text-center">{{ $emergencia->id }}</td>
                                            <td class="text-center">{{ $emergencia->fecha_hora }}</td>
                                            <td class="text-center">{{ $emergencia->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $emergencia->tipoEmergencia->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $emergencia->causa }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarEmergencia">
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarEmergencia">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-3">No hay emergencias registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Persona Involucrada -->
        <div class="modal fade" id="modalPersonaEmergencia" tabindex="-1" aria-labelledby="modalPersonaEmergenciaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <form action="{{ route('personas_involucradas_emergencia.store') }}" method="POST">
                        @csrf
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Registrar Persona Involucrada</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body py-4 px-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                        <input type="text" name="nombre" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user-tag"></i></span>
                                        <input type="text" name="apellido" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Cargo</label>
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
                                <div class="col-md-12">
                                    <label class="form-label">Emergencia Asociada</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-exclamation-circle"></i></span>
                                        <select name="emergencia_id" class="form-select" required>
                                            <option value="">Seleccione una emergencia</option>
                                            @foreach($emergencias as $emergencia)
                                                <option value="{{ $emergencia->id }}">
                                                    Emergencia #{{ $emergencia->id }} - {{ \Illuminate\Support\Str::limit($emergencia->causa, 30) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4 d-flex justify-content-between px-4 py-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Registrar Persona
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filterForm');
        const tipoFilter = document.getElementById('tipoEmergenciaFilter');
        const resetFiltro = document.getElementById('resetFiltro');
        const rows = document.querySelectorAll('.emergencia-row');

        function filtrarTabla() {
            const valor = tipoFilter.value.toLowerCase();
            rows.forEach(row => {
                const tipo = row.getAttribute('data-tipo');
                row.style.display = (!valor || tipo === valor) ? '' : 'none';
            });
        }

        filterForm.addEventListener('submit', e => {
            e.preventDefault();
            filtrarTabla();
        });

        resetFiltro.addEventListener('click', () => {
            tipoFilter.value = '';
            filtrarTabla();
        });
    });
</script>

<style>
    .modal.fade .modal-dialog {
        transform: translateY(50px);
        transition: transform 0.4s ease-out, opacity 0.4s ease-out;
        opacity: 0;
    }
    .modal.fade.show .modal-dialog {
        transform: translateY(0);
        opacity: 1;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        transition: all 0.3s ease-in-out;
    }
    .btn:hover {
        transform: scale(1.02);
        transition: transform 0.2s ease-in-out;
    }
</style>

@endsection
