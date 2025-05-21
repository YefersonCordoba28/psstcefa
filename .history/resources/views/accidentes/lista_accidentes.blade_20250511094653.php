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
                            <h5 class="card-title m-0">Accidentes Registrados</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                    Registrar Nuevo
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
                                <table class="table table-bordered table-hover table-striped align-middle" id="accidentesTable">
                                    <thead class="thead-dark bg-dark text-white">
                                        <tr>
                                            <th class="text-center" data-label="Identificación">IDENTIFICACIÓN</th>
                                            <th class="text-center" data-label="Fecha y hora">Fecha y hora</th>
                                            <th class="text-center" data-label="Área">Área</th>
                                            <th class="text-center" data-label="Tipo de lesión">Tipo de lesión</th>
                                            <th class="text-center" data-label="Tipo de riesgo">Tipo de riesgo</th>
                                            <th class="text-center" data-label="Tipo de accidente">Tipo de accidente</th>
                                            <th class="text-center" data-label="Gravedad">Gravedad</th>
                                            <th class="text-center" data-label="Evidencias">Evidencias</th>
                                            <th class="text-center" data-label="Acciones">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($accidentes as $accidente)
                                            <tr class="accidente-row" data-gravedad="{{ $accidente->gravedad }}">
                                                <td class="text-center align-" data-label="Identificación">{{ $accidente->id }}</td>
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
                                                     style="max-width: 100px; max-height: 100px;">
                                            @else
                                                <span class="text-muted">Sin evidencia</span>
                                            @endif
</td>

                                                <td class="text-center align-middle" data-label="Acciones">
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
                                                            data-bs-target="#editarModal">
                                                        Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deletebtn"
                                                            data-id="{{ $accidente->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#eliminarModal">
                                                        Eliminar
                                                    </button>
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

                                    <!-- Accidente -->
                                    <div class="col-12">
                                        <label for="accidente_id" class="form-label">Accidente Asociado</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-exclamation-triangle"></i></span>
                                            <select name="accidente_id" class="form-select" required>
                                                <option value="">Seleccione un accidente</option>
                                                @foreach($accidentes as $accidente)
                                                    <option value="{{ $accidente->id }}">
                                                        Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 30) }}
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

            <!-- Modal: Editar Accidente -->
            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <form id="editarForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
                                <h5 class="modal-title" id="editarModalLabel">
                                    <i class="fas fa-edit me-2"></i>Editar Accidente
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
                                    
                                    <!-- Tipo de Lesión -->
                                    <div class="col-md-4">
                                        <label for="tipo_lesion_id_edit" class="form-label">Tipo de Lesión</label>
                                        <select class="form-select" id="tipo_lesion_id_edit" name="tipo_lesion_id" required>
                                            <option value="">Seleccione tipo de lesión</option>
                                            @foreach($tiposLesion as $tipoLesion)
                                                <option value="{{ $tipoLesion->id }}">{{ $tipoLesion->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Tipo de Riesgo -->
                                    <div class="col-md-4">
                                        <label for="tipo_riesgo_id_edit" class="form-label">Tipo de Riesgo</label>
                                        <select class="form-select" id="tipo_riesgo_id_edit" name="tipo_riesgo_id" required>
                                            <option value="">Seleccione tipo de riesgo</option>
                                            @foreach($tiposRiesgo as $tipoRiesgo)
                                                <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Tipo de Accidente -->
                                    <div class="col-md-4">
                                        <label for="tipo_accidente_id_edit" class="form-label">Tipo de Accidente</label>
                                        <select class="form-select" id="tipo_accidente_id_edit" name="tipo_accidente_id" required>
                                            <option value="">Seleccione tipo de accidente</option>
                                            @foreach($tiposAccidente as $tipoAccidente)
                                                <option value="{{ $tipoAccidente->id }}">{{ $tipoAccidente->nombre }}</option>
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

            <!-- Modal: Eliminar Accidente -->
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
                                    <h5>¿Estás seguro de eliminar este accidente?</h5>
                                    <p class="text-muted">Esta acción no se puede deshacer. Se eliminarán todos los datos asociados al accidente.</p>
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
            const accidenteRows = document.querySelectorAll('.accidente-row');
            
            // Función para filtrar la tabla
            function filterTable() {
                const selectedGravedad = gravedadFilter.value.toLowerCase();
                
                accidenteRows.forEach(row => {
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
                    const tipo_lesion_id = this.getAttribute('data-tipo_lesion_id');
                    const tipo_riesgo_id = this.getAttribute('data-tipo_riesgo_id');
                    const tipo_accidente_id = this.getAttribute('data-tipo_accidente_id');
                    const descripcion = this.getAttribute('data-descripcion');
                    const gravedad = this.getAttribute('data-gravedad');
                    const creado_por = this.getAttribute('data-creado_por');
                    
                    // Formatear la fecha para el input datetime-local
                    const fechaFormateada = new Date(fecha_hora).toISOString().slice(0, 16);
                    
                    // Actualizar el formulario
                    document.getElementById('editarForm').action = `/accidentes/${id}`;
                    document.getElementById('fecha_hora_edit').value = fechaFormateada;
                    document.getElementById('area_unidad_productiva_id_edit').value = area_unidad_productiva_id;
                    document.getElementById('tipo_lesion_id_edit').value = tipo_lesion_id;
                    document.getElementById('tipo_riesgo_id_edit').value = tipo_riesgo_id;
                    document.getElementById('tipo_accidente_id_edit').value = tipo_accidente_id;
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
                    document.getElementById('eliminarForm').action = `/accidentes/${id}`;
                });
            });

            // Efecto de agrandar imagen al hacer clic
            document.querySelectorAll('.evidence-img').forEach(img => {
                let isZoomed = false;
                
                img.addEventListener('click', function(e) {
                    e.stopPropagation(); // Evitar que el evento se propague
                    
                    if (isZoomed) {
                        this.style.transform = 'scale(1)';
                        this.style.zIndex = 'auto';
                        this.style.position = 'relative';
                        this.style.boxShadow = 'none';
                    } else {
                        // Primero resetear todas las demás imágenes
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

            // Cerrar zoom al hacer clic en cualquier parte del documento
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
        
        /* Estilos para las imágenes de evidencia */
        .evidence-img {
            transition: all 0.3s ease;
        }
        
        .evidence-img:hover {
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }
    </style>

@endsection