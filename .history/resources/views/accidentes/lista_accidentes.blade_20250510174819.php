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
        
        .
@endsection