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

            <!-- Modal: Editar Accidente -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('accidentes.update', '0') }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
                    <h5 class="modal-title" id="editarLabel">
                        <i class="fas fa-edit me-2"></i>Editar Accidente
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body py-4 px-4">
                    <div class="row g-4">
                        <!-- Fecha y Hora -->
                        <div class="col-12">
                            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-clock"></i></span>
                                <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
                            </div>
                        </div>

                        <!-- Área -->
                        <div class="col-12 col-md-6">
                            <label for="area_unidad_productiva_id" class="form-label">Área</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-building"></i></span>
                                <select name="area_unidad_productiva_id" id="area_unidad_productiva_id" class="form-select" required>
                                    <option value="">Seleccione un área</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tipo de Lesión -->
                        <div class="col-12 col-md-6">
                            <label for="tipo_lesion_id" class="form-label">Tipo de Lesión</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-heartbeat"></i></span>
                                <select name="tipo_lesion_id" id="tipo_lesion_id" class="form-select" required>
                                    <option value="">Seleccione un tipo de lesión</option>
                                    @foreach($tipos_lesion as $tipo_lesion)
                                        <option value="{{ $tipo_lesion->id }}">{{ $tipo_lesion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tipo de Riesgo -->
                        <div class="col-12 col-md-6">
                            <label for="tipo_riesgo_id" class="form-label">Tipo de Riesgo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-biohazard"></i></span>
                                <select name="tipo_riesgo_id" id="tipo_riesgo_id" class="form-select" required>
                                    <option value="">Seleccione un tipo de riesgo</option>
                                    @foreach($tipos_riesgo as $tipo_riesgo)
                                        <option value="{{ $tipo_riesgo->id }}">{{ $tipo_riesgo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tipo de Accidente -->
                        <div class="col-12 col-md-6">
                            <label for="tipo_accidente_id" class="form-label">Tipo de Accidente</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-exclamation-triangle"></i></span>
                                <select name="tipo_accidente_id" id="tipo_accidente_id" class="form-select" required>
                                    <option value="">Seleccione un tipo de accidente</option>
                                    @foreach($tipos_accidente as $tipo_accidente)
                                        <option value="{{ $tipo_accidente->id }}">{{ $tipo_accidente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="col-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-pencil-alt"></i></span>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Detalles del accidente" required></textarea>
                            </div>
                        </div>

                        <!-- Evidencia -->
                        <div class="col-12">
                            <label for="evidencia" class="form-label">Evidencia</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-camera"></i></span>
                                <input type="file" name="evidencia" id="evidencia" class="form-control">
                            </div>
                        </div>

                        <!-- Gravedad -->
                        <div class="col-12 col-md-6">
                            <label for="gravedad" class="form-label">Gravedad</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-exclamation-circle"></i></span>
                                <select name="gravedad" id="gravedad" class="form-select" required>
                                    <option value="leve">Leve</option>
                                    <option value="moderada">Moderada</option>
                                    <option value="grave">Grave</option>
                                    <option value="fatal">Fatal</option>
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
                        <i class="fas fa-save me-1"></i>Actualizar Accidente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función para llenar el modal de edición con los datos del accidente seleccionado
        const editButtons = document.querySelectorAll('.editbtn');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const fechaHora = this.getAttribute('data-fecha_hora');
                const areaUnidadProductivaId = this.getAttribute('data-area_unidad_productiva_id');
                const tipoLesionId = this.getAttribute('data-tipo_lesion_id');
                const tipoRiesgoId = this.getAttribute('data-tipo_riesgo_id');
                const tipoAccidenteId = this.getAttribute('data-tipo_accidente_id');
                const descripcion = this.getAttribute('data-descripcion');
                const evidencia = this.getAttribute('data-evidencia');
                const gravedad = this.getAttribute('data-gravedad');

                // Establecer los valores en el formulario
                document.getElementById('editForm').action = `/accidentes/${id}`;
                document.getElementById('fecha_hora').value = fechaHora;
                document.getElementById('area_unidad_productiva_id').value = areaUnidadProductivaId;
                document.getElementById('tipo_lesion_id').value = tipoLesionId;
                document.getElementById('tipo_riesgo_id').value = tipoRiesgoId;
                document.getElementById('tipo_accidente_id').value = tipoAccidenteId;
                document.getElementById('descripcion').value = descripcion;
                document.getElementById('evidencia').value = evidencia;
                document.getElementById('gravedad').value = gravedad;
            });
        });
    });
</script>


            <!-- Modal: Registrar Persona Involucrada -->
          <!-- Animaciones personalizadas -->
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
    </style>

@endsection
