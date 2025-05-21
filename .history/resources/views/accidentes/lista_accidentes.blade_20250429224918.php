@extends('instructor.dashboard')

@section('content')

<div class="card-body">
    <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
        <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
            Registrar Nuevo
        </a>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
            Registrar Persona Involucrada
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th>ID</th>
                    <th>Fecha y hora</th>
                    <th>Área</th>
                    <th>Tipo de lesión</th>
                    <th>Tipo de riesgo</th>
                    <th>Tipo de accidente</th>
                    <th>Gravedad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accidentes as $accidente)
                    <tr class="text-center">
                        <td>{{ $accidente->id }}</td>
                        <td>{{ $accidente->fecha_hora }}</td>
                        <td>{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                        <td>{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                        <td>{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                        <td>{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $accidente->gravedad === 'leve' ? 'bg-success' : ($accidente->gravedad === 'moderada' ? 'bg-warning' : ($accidente->gravedad === 'grave' ? 'bg-danger' : 'bg-secondary')) }}">
                                {{ ucfirst($accidente->gravedad) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap justify-content-center gap-1">
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
                            </div>
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

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editarLabel">Editar Accidente</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí van tus campos de formulario como inputs/selects -->
                    <!-- Puedes adaptar tus campos actuales aquí según tus necesidades -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_fecha_hora" class="form-label">Fecha y Hora</label>
                            <input type="datetime-local" class="form-control" name="fecha_hora" id="edit_fecha_hora">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_gravedad" class="form-label">Gravedad</label>
                            <select class="form-select" name="gravedad" id="edit_gravedad">
                                <option value="leve">Leve</option>
                                <option value="moderada">Moderada</option>
                                <option value="grave">Grave</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="edit_descripcion" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_evidencia" class="form-label">Evidencia</label>
                            <input type="file" class="form-control" name="evidencia" id="edit_evidencia">
                        </div>
                        <!-- Otros campos según tu lógica -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="eliminarLabel">Eliminar Accidente</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este accidente?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


            {{-- Modal Personalizado (contenido desde otro archivo Blade) --}}
            <div class="modal fade" id="modalPersonalizado" tabindex="-1" aria-labelledby="modalPersonalizadoLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                    <div class="container">
    <h2 class="mb-4">Registrar Persona Involucrada</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('personas_involucradas.store') }}" method="POST">
        @csrf

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        {{-- Apellido --}}
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
        </div>

        {{-- Cargo --}}
        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargo</label>
            <select name="cargo_id" class="form-control">
                <option value="">Seleccione un cargo</option>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Accidente --}}
        <div class="mb-3">
            <label for="accidente_id" class="form-label">Accidente</label>
            <select name="accidente_id" class="form-control">
                <option value="">Seleccione un accidente</option>
                @foreach($accidentes as $accidente)
                    <option value="{{ $accidente->id }}" {{ old('accidente_id') == $accidente->id ? 'selected' : '' }}>
                        Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 30) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Persona</button>
    </form>
</div>
                    </div>
                </div>
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
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
        }

        .table th, .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }

        .table th {
            font-weight: 600;
            white-space: normal;
            text-transform: uppercase;
        }

        .table td {
            white-space: normal;
            word-break: break-word;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.4em 0.8em;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
        }

        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        @media (max-width: 992px) {
            .table-responsive {
                font-size: 0.9rem;
            }
            .table th, .table td {
                padding: 0.5rem;
            }
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 768px) {
            .modal-content {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection
