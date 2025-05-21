@extends('instructor.dashboard')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <!-- Aquí puedes agregar contenido de encabezado si es necesario -->
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
                                    Registrar Nueva Emergencia
                                </a>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
                                    Registrar Persona Involucrada
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <!-- Formulario de búsqueda por gravedad -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <form id="searchForm">
                                        <div class="input-group">
                                            <select name="gravedad" id="gravedadFilter" class="form-control form-control-sm">
                                                <option value="">Busca por gravedad</option>
                                                <option value="leve">Leve</option>
                                                <option value="moderada">Moderada</option>
                                                <option value="grave">Grave</option>
                                                <option value="fatal">Fatal</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-search"></i> Buscar
                                            </button>
                                            <button type="button" id="resetFilter" class="btn btn-secondary btn-sm">
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
                                            <th class="text-center" data-label="Identificación">ID</th>
                                            <th class="text-center" data-label="Fecha y hora">Fecha y hora</th>
                                            <th class="text-center" data-label="Área">Área</th>
                                            <th class="text-center" data-label="Tipo de emergencia">Tipo de emergencia</th>
                                            <th class="text-center" data-label="Tipo de riesgo">Tipo de riesgo</th>
                                            <th class="text-center" data-label="Gravedad">Gravedad</th>
                                            <th class="text-center" data-label="Acciones">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($emergencias as $emergencia)
                                            <tr class="emergencia-row" data-gravedad="{{ $emergencia->gravedad }}">
                                                <td class="text-center align-middle" data-label="Identificación">{{ $emergencia->id }}</td>
                                                <td class="align-middle text-center" data-label="Fecha y hora">{{ $emergencia->fecha_hora }}</td>
                                                <td class="align-middle text-center" data-label="Área">{{ $emergencia->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center" data-label="Tipo de emergencia">{{ $emergencia->tipoEmergencia->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center" data-label="Tipo de riesgo">{{ $emergencia->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center" data-label="Gravedad">
                                                    <span class="badge {{ $emergencia->gravedad === 'leve' ? 'bg-success' : ($emergencia->gravedad === 'moderada' ? 'bg-warning' : ($emergencia->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                        {{ ucfirst($emergencia->gravedad) }}
                                                    </span>
                                                </td>
                                                <td class="text-center align-middle" data-label="Acciones">
                                                    <button class="btn btn-success btn-sm editbtn"
                                                            data-id="{{ $emergencia->id }}"
                                                            data-fecha_hora="{{ $emergencia->fecha_hora }}"
                                                            data-area_unidad_productiva_id="{{ $emergencia->area_unidad_productiva_id }}"
                                                            data-tipo_emergencia_id="{{ $emergencia->tipo_emergencia_id }}"
                                                            data-tipo_riesgo_id="{{ $emergencia->tipo_riesgo_id }}"
                                                            data-descripcion="{{ $emergencia->descripcion }}"
                                                            data-evidencia="{{ $emergencia->evidencia }}"
                                                            data-gravedad="{{ $emergencia->gravedad }}"
                                                            data-creado_por="{{ $emergencia->creado_por }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editarModal">
                                                        Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deletebtn"
                                                            data-id="{{ $emergencia->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#eliminarModal">
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">No hay emergencias registradas.</td>
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
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <form action="{{ route('personas_involucradas.store') }}" method="POST">
                            @csrf
                            <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
                                <h5 class="modal-title" id="modalPersonalizadoLabel">
                                    <i class="fas fa-user-plus me-2"></i>Registrar Persona Involucrada
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>

                            <div class="modal-body py-4 px-4">
                                <div class="row g-4">
                                    <!-- Nombre -->
                                    <div class="col-12 col-md-6">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                                            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>

                                    <!-- Apellido -->
                                    <div class="col-12 col-md-6">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user-tag"></i></span>
                                            <input type="text" name="apellido" class="form-control" placeholder="Ingrese el apellido" required>
                                        </div>
                                    </div>

                                    <!-- Cargo -->
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

                                    <!-- Emergencia -->
                                    <div class="col-12">
                                        <label for="emergencia_id" class="form-label">Emergencia Asociada</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-exclamation-triangle"></i></span>
                                            <select name="emergencia_id" class="form-select" required>
                                                <option value="">Seleccione una emergencia</option>
                                                @foreach($emergencias as $emergencia)
                                                    <option value="{{ $emergencia->id }}">
                                                        Emergencia #{{ $emergencia->id }} - {{ \Illuminate\Support\Str::limit($emergencia->descripcion, 30) }}
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

            <!-- Modal: Editar Emergencia -->
            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <form id="editarForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
                                <h5 class="modal-title" id="editarModalLabel">
                                    <i class="fas fa-edit me-2"></i>Editar Emergencia
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
                                    
                                    <!-- Tipo de Emergencia -->
                                    <div class="col-md-6">
                                        <label for="tipo_emergencia_id_edit" class="form-label">Tipo de Emergencia</label>
                                        <select class="form-select" id="tipo_emergencia_id_edit" name="tipo_emergencia_id" required>
                                            <option value="">Seleccione tipo de emergencia</option>
                                            @foreach($tiposEmergencia as $tipoEmergencia)
                                                <option value="{{ $tipoEmergencia->id }}">{{ $tipoEmergencia->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Tipo de Riesgo -->
                                    <div class="col-md-6">
                                        <label for="tipo_riesgo_id_edit" class="form-label">Tipo de Riesgo</label>
                                        <select class="form-select" id="tipo_riesgo_id_edit" name="tipo_riesgo_id" required>
                                            <option value="">Seleccione tipo de riesgo</option>
                                            @foreach($tiposRiesgo as $tipoRiesgo)
                                                <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
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
                                            <option value="fatal">Fatal</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Evidencia -->
                                    <div class="col-md-6">
                                        <label for="evidencia_edit" class="form-label">Evidencia (Archivo)</label>
                                        <input type="file" class="form-control" id="evidencia_edit" name="evidencia">
                                        <small class="text-muted">Dejar en blanco para mantener el archivo actual</small>
                                    </div>
                                    
                                    <!-- Campo oculto para creado_por -->
                                    <input type="hidden" id="creado_por_edit" name="creado_por">
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

            <!-- Modal: Eliminar Emergencia -->
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
                                    <h5>¿Estás seguro de eliminar esta emergencia?</h5>
                                    <p class="text-muted">Esta acción no se puede deshacer. Se eliminarán todos los datos asociados a la emergencia.</p>
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
            // Manejar el filtrado por gravedad
            const searchForm = document.getElementById('searchForm');
            const gravedadFilter = document.getElementById('gravedadFilter');
            const resetFilter = document.getElementById('resetFilter');
            const emergenciaRows = document.querySelectorAll('.emergencia-row');
            
            // Función para filtrar la tabla
            function filterTable() {
                const selectedGravedad = gravedadFilter.value.toLowerCase();
                
                emergenciaRows.forEach(row => {
                    const rowGravedad = row.getAttribute('data-gravedad').toLowerCase();
                    
                    if (selectedGravedad === '' || rowGravedad === selectedGravedad) {
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
                gravedadFilter.value = '';
                filterTable();
            });
            
            // Manejar el modal de edición
            document.querySelectorAll('.editbtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const fecha_hora = this.getAttribute('data-fecha_hora');
                    const area_unidad_productiva_id = this.getAttribute('data-area_unidad_productiva_id');
                    const tipo_emergencia_id = this.getAttribute('data-tipo_emergencia_id');
                    const tipo_riesgo_id = this.getAttribute('data-tipo_riesgo_id');
                    const descripcion = this.getAttribute('data-descripcion');
                    const gravedad = this.getAttribute('data-gravedad');
                    const creado_por = this.getAttribute('data-creado_por');
                    
                    // Formatear la fecha para el input datetime-local
                    const fechaFormateada = new Date(fecha_hora).toISOString().slice(0, 16);
                    
                    // Actualizar el formulario
                    document.getElementById('editarForm').action = `/emergencias/${id}`;
                    document.getElementById('fecha_hora_edit').value = fechaFormateada;
                    document.getElementById('area_unidad_productiva_id_edit').value = area_unidad_productiva_id;
                    document.getElementById('tipo_emergencia_id_edit').value = tipo_emergencia_id;
                    document.getElementById('tipo_riesgo_id_edit').value = tipo_riesgo_id;
                    document.getElementById('descripcion_edit').value = descripcion;
                    document.getElementById('gravedad_edit').value = gravedad;
                    document.getElementById('creado_por_edit').value = creado_por;
                });
            });

            // Manejar el modal de eliminación
            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    // Actualizar el formulario de eliminación con el ID correcto
                    document.getElementById('eliminarForm').action = `/emergencias/${id}`;
                });
            });
        });
    </script>

    <style>
        /* Estilos adicionales para el modal y el buscador */
        .input-group {
            margin-bottom: 1rem;
        }
        
        #gravedadFilter {
            max-width: 200px;
        }
        
        @media (max-width: 768px) {
            #gravedadFilter {
                max-width: 100%;
            }
            
            .input-group {
                flex-wrap: nowrap;
            }
            
            .input-group > .form-control,
            .input-group > .btn {
                flex: 1 1 auto;
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
    </style>

@endsection