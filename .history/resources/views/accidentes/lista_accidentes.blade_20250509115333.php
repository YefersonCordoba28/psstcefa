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
                                                <option value="">Busca por gravedades</option>
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

            <!-- ... (resto de tus modales permanecen igual) ... -->

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
            
            // Evento para cambios en el select (opcional: filtrar al cambiar sin necesidad de submit)
            // gravedadFilter.addEventListener('change', filterTable);
            
            // Resto de tu código JavaScript existente...
            document.querySelectorAll('.editbtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEditar').action = `/accidentes/${id}`;

                    document.getElementById('edit-fecha_hora').value = this.getAttribute('data-fecha_hora').replace(' ', 'T');
                    document.getElementById('edit-area_unidad_productiva_id').value = this.getAttribute('data-area_unidad_productiva_id');
                    document.getElementById('edit-tipo_lesion_id').value = this.getAttribute('data-tipo_lesion_id');
                    document.getElementById('edit-tipo_riesgo_id').value = this.getAttribute('data-tipo_riesgo_id');
                    document.getElementById('edit-tipo_accidente_id').value = this.getAttribute('data-tipo_accidente_id');
                    document.getElementById('edit-descripcion').value = this.getAttribute('data-descripcion') || '';
                    document.getElementById('edit-evidencia').value = this.getAttribute('data-evidencia') || '';
                    document.getElementById('edit-gravedad').value = this.getAttribute('data-gravedad');
                    document.getElementById('edit-creado_por').value = this.getAttribute('data-creado_por');
                });
            });

            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEliminar').action = `/accidentes/${id}`;
                });
            });
        });
    </script>

    <style>
        /* ... (tus estilos existentes permanecen igual) ... */

        /* Estilos adicionales para el buscador */
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