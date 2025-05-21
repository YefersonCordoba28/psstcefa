@extends('instructor.dashboard')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <!-- Encabezado opcional -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                            <h5 class="card-title m-0"><i class="fas fa-exclamation-circle me-2"></i>Actos Inseguros Registrados</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('actos_inseguros.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus-circle me-1"></i>Registrar Nuevo
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <!-- Filtro de búsqueda -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <form id="searchForm">
                                        <div class="input-group">
                                            <select name="gravedad" id="gravedadFilter" class="form-control form-control-sm">
                                                <option value="">Filtrar por gravedad</option>
                                                <option value="leve">Leve</option>
                                                <option value="moderada">Moderada</option>
                                                <option value="grave">Grave</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-search"></i> Filtrar
                                            </button>
                                            <button type="button" id="resetFilter" class="btn btn-secondary btn-sm">
                                                <i class="fas fa-undo"></i> Limpiar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Tabla de actos inseguros -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle" id="actosInsegurosTable">
                                    <thead class="thead-dark bg-dark text-white">
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Fecha y Hora</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Tipo de Acto</th>
                                            <th class="text-center">Tipo de Riesgo</th>
                                            <th class="text-center">Gravedad</th>
                                            <th class="text-center">Evidencia</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($inseguridades as $acto)
                                            <tr class="acto-row" data-gravedad="{{ $acto->gravedad }}">
                                                <td class="text-center align-middle">{{ $acto->id }}</td>
                                                <td class="align-middle text-center">{{ $acto->fecha_hora }}</td>
                                                <td class="align-middle text-center">{{ $acto->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center">{{ $acto->tipoActoInseguro->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center">{{ $acto->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center">
                                                    <span class="badge {{ $acto->gravedad === 'leve' ? 'bg-success' : ($acto->gravedad === 'moderada' ? 'bg-warning' : 'bg-danger') }}">
                                                        {{ ucfirst($acto->gravedad) }}
                                                    </span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if($acto->evidencia)
                                                        <img src="{{ asset('img_actos_inseguros/' . basename($acto->evidencia)) }}" 
                                                             alt="Evidencia" 
                                                             class="img-thumbnail evidence-img"
                                                             style="max-width: 100px; max-height: 100px;">
                                                    @else
                                                        <span class="text-muted">Sin evidencia</span>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button class="btn btn-success btn-sm editbtn"
                                                            data-id="{{ $acto->id }}"
                                                            data-fecha_hora="{{ $acto->fecha_hora }}"
                                                            data-area_unidad_productiva_id="{{ $acto->area_unidad_productiva_id }}"
                                                            data-tipo_acto_inseguro_id="{{ $acto->tipo_acto_inseguro_id }}"
                                                            data-tipo_riesgo_id="{{ $acto->tipo_riesgo_id }}"
                                                            data-descripcion="{{ $acto->descripcion }}"
                                                            data-evidencia="{{ $acto->evidencia }}"
                                                            data-gravedad="{{ $acto->gravedad }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editarModal">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deletebtn"
                                                            data-id="{{ $acto->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#eliminarModal">
                                                        <i class="fas fa-trash-alt"></i> Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-3">No hay actos inseguros registrados.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar -->
            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <form id="editarForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
                                <h5 class="modal-title" id="editarModalLabel">
                                    <i class="fas fa-edit me-2"></i>Editar Acto Inseguro
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            
                            <div class="modal-body py-4 px-4">
                                <div class="row g-3">
                                    <!-- Fecha y Hora -->
                                    <div class="col-md-6">
                                        <label for="fecha_hora_edit" class="form-label">Fecha y Hora</label>
                                        <input type="datetime-local" class="form-control" id="fecha_hora_edit" name="fecha_hora" required>
                                    </div>
                                    
                                    <!-- Área/Unidad Productiva -->
                                    <div class="col-md-6">
                                        <label for="area_unidad_productiva_id_edit" class="form-label">Área/Unidad Productiva</label>
                                        <select class="form-select" id="area_unidad_productiva_id_edit" name="area_unidad_productiva_id" required>
                                            <option value="">Seleccione un área</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Tipo de Acto Inseguro -->
                                    <div class="col-md-6">
                                        <label for="tipo_acto_inseguro_id_edit" class="form-label">Tipo de Acto Inseguro</label>
                                        <select class="form-select" id="tipo_acto_inseguro_id_edit" name="tipo_acto_inseguro_id" required>
                                            <option value="">Seleccione tipo de acto</option>
                                            @foreach($tiposActoInseguros as $tipo)
                                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Tipo de Riesgo -->
                                    <div class="col-md-6">
                                        <label for="tipo_riesgo_id_edit" class="form-label">Tipo de Riesgo</label>
                                        <select class="form-select" id="tipo_riesgo_id_edit" name="tipo_riesgo_id" required>
                                            <option value="">Seleccione tipo de riesgo</option>
                                            @foreach($tiposRiesgos as $riesgo)
                                                <option value="{{ $riesgo->id }}">{{ $riesgo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Descripción -->
                                    <div class="col-12">
                                        <label for="descripcion_edit" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion_edit" name="descripcion" rows="3" required></textarea>
                                    </div>
                                    
                                    <!-- Gravedad -->
                                    <div class="col-md-6">
                                        <label for="gravedad_edit" class="form-label">Gravedad</label>
                                        <select class="form-select" id="gravedad_edit" name="gravedad" required>
                                            <option value="">Seleccione la gravedad</option>
                                            <option value="leve">Leve</option>
                                            <option value="moderada">Moderada</option>
                                            <option value="grave">Grave</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Evidencia -->
                                    <div class="col-md-6">
                                        <label for="evidencia_edit" class="form-label">Evidencia (Archivo)</label>
                                        <input type="file" class="form-control" id="evidencia_edit" name="evidencia">
                                        <small class="text-muted">Dejar en blanco para mantener el archivo actual</small>
                                    </div>
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

            <!-- Modal Eliminar -->
            <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <form id="eliminarForm" method="POST">
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
                                    <h5>¿Estás seguro de eliminar este acto inseguro?</h5>
                                    <p class="text-muted">Esta acción no se puede deshacer. Se eliminarán todos los datos asociados.</p>
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
            // Filtrado por gravedad
            const searchForm = document.getElementById('searchForm');
            const gravedadFilter = document.getElementById('gravedadFilter');
            const resetFilter = document.getElementById('resetFilter');
            const actoRows = document.querySelectorAll('.acto-row');
            
            function filterTable() {
                const selectedGravedad = gravedadFilter.value.toLowerCase();
                
                actoRows.forEach(row => {
                    const rowGravedad = row.getAttribute('data-gravedad').toLowerCase();
                    
                    if (selectedGravedad === '' || rowGravedad === selectedGravedad) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                filterTable();
            });
            
            resetFilter.addEventListener('click', function() {
                gravedadFilter.value = '';
                filterTable();
            });
            
            // Modal Editar
            document.querySelectorAll('.editbtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const fecha_hora = this.getAttribute('data-fecha_hora');
                    const area_unidad_productiva_id = this.getAttribute('data-area_unidad_productiva_id');
                    const tipo_acto_inseguro_id = this.getAttribute('data-tipo_acto_inseguro_id');
                    const tipo_riesgo_id = this.getAttribute('data-tipo_riesgo_id');
                    const descripcion = this.getAttribute('data-descripcion');
                    const gravedad = this.getAttribute('data-gravedad');
                    
                    // Formatear fecha para input datetime-local
                    const fechaFormateada = new Date(fecha_hora).toISOString().slice(0, 16);
                    
                    // Actualizar formulario
                    document.getElementById('editarForm').action = `/actos_inseguros/${id}`;
                    document.getElementById('fecha_hora_edit').value = fechaFormateada;
                    document.getElementById('area_unidad_productiva_id_edit').value = area_unidad_productiva_id;
                    document.getElementById('tipo_acto_inseguro_id_edit').value = tipo_acto_inseguro_id;
                    document.getElementById('tipo_riesgo_id_edit').value = tipo_riesgo_id;
                    document.getElementById('descripcion_edit').value = descripcion;
                    document.getElementById('gravedad_edit').value = gravedad;
                });
            });

            // Modal Eliminar
            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('eliminarForm').action = `/actos_inseguros/${id}`;
                });
            });

            // Efecto zoom en imágenes
            document.querySelectorAll('.evidence-img').forEach(img => {
                let isZoomed = false;
                
                img.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    if (isZoomed) {
                        this.style.transform = 'scale(1)';
                        this.style.zIndex = 'auto';
                        this.style.position = 'relative';
                        this.style.boxShadow = 'none';
                    } else {
                        document.querySelectorAll('.evidence-img').forEach(otherImg => {
                            if (otherImg !== img) {
                                otherImg.style.transform = 'scale(1)';
                                otherImg.style.zIndex = 'auto';
                                otherImg.style.position = 'relative';
                                otherImg.style.boxShadow = 'none';
                            }
                        });
                        
                        this.style.transform = 'scale(1.8)';
                        this.style.zIndex = '1000';
                        this.style.position = 'relative';
                        this.style.boxShadow = '0 0 15px rgba(0,0,0,0.5)';
                    }
                    
                    isZoomed = !isZoomed;
                });
            });

            // Cerrar zoom al hacer clic fuera
            document.addEventListener('click', function() {
                document.querySelectorAll('.evidence-img').forEach(img => {
                    img.style.transform = 'scale(1)';
                    img.style.zIndex = 'auto';
                    img.style.position = 'relative';
                    img.style.boxShadow = 'none';
                });
            });
        });
    </script>

    <style>
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-header {
            border-bottom: none;
        }
        .table th {
            white-space: nowrap;
        }
        .evidence-img {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .evidence-img:hover {
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }
        .badge {
            font-size: 0.85em;
            padding: 0.35em 0.65em;
        }
        @media (max-width: 768px) {
            .input-group {
                flex-wrap: nowrap;
            }
            .input-group > .form-control,
            .input-group > .btn {
                flex: 1 1 auto;
            }
        }
    </style>

@endsection