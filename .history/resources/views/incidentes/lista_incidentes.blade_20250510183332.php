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

        <!-- ... (tus modales existentes permanecen igual) ... -->
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
        
        // Resto de tu código JavaScript existente...
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

    /* ... (el resto de tus estilos existentes permanecen igual) ... */
</style>
@endsection