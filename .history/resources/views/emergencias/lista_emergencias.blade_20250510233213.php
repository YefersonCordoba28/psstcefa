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
                                            <th class="text-center" data-label="Evidencia">Evidencia</th>
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
                                                <td class="align-middle text-center" data-label="Evidencia">
                                                    @if($emergencia->evidencia)
                                                        <div class="evidence-thumbnail" 
                                                             data-bs-toggle="modal" 
                                                             data-bs-target="#evidenceModal"
                                                             data-image="{{ asset('storage/' . $emergencia->evidencia) }}">
                                                            <img src="{{ asset('storage/' . $emergencia->evidencia) }}" 
                                                                 alt="Evidencia" 
                                                                 class="img-thumbnail">
                                                        </div>
                                                    @else
                                                        <span class="text-muted">Sin evidencia</span>
                                                    @endif
                                                </td>
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

            <!-- Modal: Visualizar Evidencia (ampliada) -->
            <div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title" id="evidenceModalLabel">Evidencia de la Emergencia</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="evidenceImage" src="" class="img-fluid" alt="Evidencia" style="max-height: 70vh;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a id="downloadEvidence" href="#" class="btn btn-primary" download>
                                <i class="fas fa-download"></i> Descargar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resto de los modales (Persona Involucrada, Editar y Eliminar) se mantienen igual -->
            <!-- ... -->

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

            // Manejar la visualización de evidencias ampliadas
            document.querySelectorAll('.evidence-thumbnail').forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const imageUrl = this.getAttribute('data-image');
                    document.getElementById('evidenceImage').src = imageUrl;
                    document.getElementById('downloadEvidence').href = imageUrl;
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

        /* Estilos para las miniaturas de evidencia */
        .evidence-thumbnail {
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            max-width: 100px;
            max-height: 100px;
        }

        .evidence-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .evidence-thumbnail img {
            width: 100%;
            height: auto;
            max-height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .evidence-thumbnail {
                max-width: 60px;
                max-height: 60px;
            }

            .evidence-thumbnail img {
                max-height: 60px;
            }
        }

        /* Estilos para la vista ampliada de evidencias */
        #evidenceImage {
            max-width: 100%;
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            #evidenceModal .modal-dialog {
                margin: 0.5rem auto;
            }
            
            #evidenceImage {
                max-height: 50vh;
            }
        }
    </style>

@endsection