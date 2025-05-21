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
                            <!-- Filtro por Gravedad -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <form action="{{ route('accidentes.index') }}" method="GET">
                                        <div class="input-group">
                                            <select name="gravedad" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">Todas las gravedades</option>
                                                <option value="leve" {{ request('gravedad') == 'leve' ? 'selected' : '' }}>Leve</option>
                                                <option value="moderada" {{ request('gravedad') == 'moderada' ? 'selected' : '' }}>Moderada</option>
                                                <option value="grave" {{ request('gravedad') == 'grave' ? 'selected' : '' }}>Grave</option>
                                                <option value="fatal" {{ request('gravedad') == 'fatal' ? 'selected' : '' }}>Fatal</option>
                                            </select>
                                            @if(request('gravedad'))
                                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.location='{{ route('accidentes.index') }}'">
                                                    Limpiar
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle">
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
                                            <tr>
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
                            
                            <!-- Paginación -->
                            @if($accidentes->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $accidentes->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Los modales (editar, eliminar, personalizado) se mantienen igual que en tu código original -->
            {{-- Modal Editar --}}
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                <!-- ... contenido del modal editar ... -->
            </div>

            {{-- Modal Eliminar --}}
            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                <!-- ... contenido del modal eliminar ... -->
            </div>

            {{-- Modal Personalizado --}}
            <div class="modal fade" id="modalPersonalizado" tabindex="-1" aria-labelledby="modalPersonalizadoLabel" aria-hidden="true">
                <!-- ... contenido del modal personalizado ... -->
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            text-align: center;
        }

        .table th {
            font-weight: 600;
            white-space: nowrap;
            text-transform: uppercase;
        }

        .table td {
            white-space: normal;
            word-break: break-word;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.4em 0.8em;
            white-space: nowrap;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size:0.875rem;
            line-height: 1.5;
        }

        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem;
        }

        .modal-dialog-scrollable .modal-content {
            max-height: 90vh;
            overflow-y: auto;
        }

        /* Responsive Table for Small Screens */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.85rem;
            }

            .table {
                display: block;
                overflow-x: auto;
            }

            .table thead {
                display: none;
            }

            .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }

            .table tr {
                margin-bottom: 1rem;
                border: 10px solid #dee2e6;
                border-radius: 0.25rem;
            }

            .table td {
                position: relative;
                padding-left: 50%;
                text-align: left;
                border: none;
                border-bottom: 1px solid #dee2e6;
            }

            .table td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                text-align: left;
                background-color: #f8f9fa;
            }

            .table td:last-child {
                border-bottom: none;
            }

            .btn-sm {
                padding: 0.3rem 0.6rem;
                font-size: 0.8rem;
            }

            .badge {
                font-size: 0.75rem;
            }
        }

        /* Further Adjustments for Very Small Screens */
        @media (max-width: 576px) {
            .table td {
                padding-left: 40%;
                font-size: 0.8rem;
            }

            .table td:before {
                width: 35%;
            }

            .btn-sm {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .card-header .d-flex {
                flex-direction: column;
                width: 100%;
            }

            .card-header .btn-sm {
                width: 100%;
                text-align: center;
            }

            .modal-content {
                font-size: 0.85rem;
            }

            .modal-dialog {
                margin: 0.5rem;
            }

            .modal-body {
                padding: 1rem;
            }
        }
    </style>
@endsection