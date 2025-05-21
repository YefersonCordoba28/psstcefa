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
                        <!-- Formulario de búsqueda por fecha -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <form id="searchForm" class="form-inline">
                                    <div class="input-group">
                                        <input type="date" name="fecha" id="fechaFilter" class="form-control form-control-sm">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        <button type="button" id="resetFilter" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-undo"></i> Mostrar Todos
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle" id="incidentesTable">
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
                                        <tr class="incidente-row" data-fecha="{{ \Carbon\Carbon::parse($incidente->fecha_hora)->format('Y-m-d') }}">
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
                                                        data-bs-target="#editarModal">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-danger btn-sm deletebtn"
                                                        data-id="{{ $incidente->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#eliminarModal">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
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

        <!-- Modal: Editar Incidente -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <form id="formEditar" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
                            <h5 class="modal-title" id="editarModalLabel">
                                <i class="fas fa-edit me-2"></i>Editar Incidente
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        
                        <div class="modal-body py-4 px-4">
                            <div class="row g-3">
                                <!-- Fecha y Hora -->
                                <div class="col-md-6">
                                    <label for="edit-fecha_hora" class="form-label">Fecha y Hora</label>
                                    <input type="datetime-local" class="form-control" id="edit-fecha_hora" name="fecha_hora" required>
                                </div>
                                
                                <!-- Área/Unidad Productiva -->
                                <div class="col-md-6">
                                    <label for="edit-area_unidad_productiva_id" class="form-label">Área/Unidad Productiva</label>
                                    <select class="form-select" id="edit-area_unidad_productiva_id" name="area_unidad_productiva_id" required>
                                        <option value="">Seleccione un área</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Tipo de Riesgo -->
                                <div class="col-md-6">
                                    <label for="edit-tipo_riesgo_id" class="form-label">Tipo de Riesgo</label>
                                    <select class="form-select" id="edit-tipo_riesgo_id" name="tipo_riesgo_id" required>
                                        <option value="">Seleccione tipo de riesgo</option>
                                        @foreach($tiposRiesgo as $tipoRiesgo)
                                            <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Tipo de Incidente -->
                                <div class="col-md-6">
                                    <label for="edit-tipo_incidente_id" class="form-label">Tipo de Incidente</label>
                                    <select class="form-select" id="edit-tipo_incidente_id" name="tipo_incidente_id" required>
                                        <option value="">Seleccione tipo de incidente</option>
                                        @foreach($tiposIncidente as $tipoIncidente)
                                            <option value="{{ $tipoIncidente->id }}">{{ $tipoIncidente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Descripción -->
                                <div class="col-12">
                                    <label for="edit-descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="edit-descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                
                                <!-- Nivel de Riesgo -->
                                <div class="col-md-6">
                                    <label for="edit-nivel_riesgo" class="form-label">Nivel de Riesgo</label>
                                    <select class="form-select" id="edit-nivel_riesgo" name="nivel_riesgo" required>
                                        <option value="">Seleccione el nivel de riesgo</option>
                                        <option value="Bajo">Bajo</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Alto">Alto</option>
                                    </select>
                                </div>
                                
                                <!-- Evidencia -->
                                <div class="col-md-6">
                                    <label for="edit-evidencia" class="form-label">Evidencia (Archivo)</label>
                                    <input type="file" class="form-control" id="edit-evidencia" name="evidencia">
                                    <small class="text-muted">Dejar en blanco para mantener el archivo actual</small>
                                </div>
                                
                                <!-- Campo oculto para creado_por -->
                                <input type="hidden" id="edit-creado_por" name="creado_por">
                            </div>
                        </div>
                        
                        <div class="modal-footer bg-light rounded-bottom-4 d-flex justify-content-between px-4 py-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal: Eliminar Incidente -->
        <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <form id="formEliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header bg-gradient bg-danger text-white rounded-top-4">
                            <h5 class="modal-title" id="eliminarModalLabel">
                                <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        
                        <div class="modal-body py-4 px-4 text-center">
                            <div class="mb-4">
                                <i class="fas fa-trash-alt fa-4x text-danger mb-3"></i>
                                <h5>¿Estás seguro de eliminar este incidente?</h5>
                                <p class="text-muted">Esta acción no se puede deshacer. Se eliminarán todos los datos asociados al incidente.</p>
                            </div>
                        </div>
                        
                        <div class="modal-footer bg-light rounded-bottom-4 d-flex justify-content-center px-4 py-3">
                            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-danger mx-2">
                                <i class="fas fa-trash-alt me-1"></i>Sí, Eliminar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el filtrado por fecha
        const searchForm = document.getElementById('searchForm');
        const fechaFilter = document.getElementById('fechaFilter');
        const resetFilter = document.getElementById('resetFilter');
        const incidenteRows = document.querySelectorAll('.incidente-row');
        
        // Función para filtrar la tabla por fecha
        function filterTable() {
            const selectedFecha = fechaFilter.value;
            
            incidenteRows.forEach(row => {
                const rowFecha = row.getAttribute('data-fecha');
                
                if (!selectedFecha || rowFecha === selectedFecha) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        // Evento para el formulario de búsqueda
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            filterTable();
        });
        
        // Evento para el botón de resetear
        resetFilter.addEventListener('click', function() {
            fechaFilter.value = '';
            filterTable();
        });
        
        // Manejar el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/incidentes/${id}`;

                document.getElementById('edit-fecha_hora').value = this.getAttribute('data-fecha_hora').replace(' ', 'T');
                document.getElementById('edit-area_unidad_productiva_id').value = this.getAttribute('data-area_unidad_productiva_id');
                document.getElementById('edit-tipo_riesgo_id').value = this.getAttribute('data-tipo_riesgo_id');
                document.getElementById('edit-tipo_incidente_id').value = this.getAttribute('data-tipo_incidente_id');
                document.getElementById('edit-descripcion').value = this.getAttribute('data-descripcion') || '';
                document.getElementById('edit-nivel_riesgo').value = this.getAttribute('data-nivel_riesgo');
                document.getElementById('edit-creado_por').value = this.getAttribute('data-creado_por');
            });
        });

        // Manejar el modal de eliminación
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

    /* Estilos para el buscador */
    #searchForm {
        margin-bottom: 1rem;
    }
    
    .input-group {
        max-width: 500px;
    }
    
    #fechaFilter {
        max-width: 150px;
    }
    
    @media (max-width: 768px) {
        .input-group {
            flex-wrap: nowrap;
        }
        
        #fechaFilter {
            max-width: 120px;
        }
    }
    
    @media (max-width: 576px) {
        .input-group {
            flex-wrap: wrap;
        }
        
        #fechaFilter {
            max-width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .input-group > .btn {
            flex: 1;
        }
    }

    /* Estilos para los modales */
    .modal-content {
        border: none;
    }
    
    .modal-header {
        border-bottom: none;
    }
    
    .modal-footer {
        border-top: none;
    }
    
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    /* Estilos específicos para el modal de eliminación */
    #eliminarModal .modal-body {
        padding: 2rem;
    }
    
    #eliminarModal .fa-trash-alt {
        opacity: 0.8;
    }
    
    /* Estilos para los botones de acción */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }
    
    .btn-success, .btn-danger {
        color: white;
    }
</style>
@endsection