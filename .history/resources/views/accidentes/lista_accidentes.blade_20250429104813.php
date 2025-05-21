@extends('instructor')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="text-center mb-4">Lista de Accidentes</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-2 px-md-4">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-11">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Accidentes Registrados</h5>
                            <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus-circle me-1"></i>Registrar Nuevo
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle mb-0">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha y Hora</th>
                                            <th>Área</th>
                                            <th>Tipo de Lesión</th>
                                            <th>Tipo de Riesgo</th>
                                            <th>Tipo de Accidente</th>
                                            <th>Gravedad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($accidentes as $accidente)
                                            <tr>
                                                <td class="text-center">{{ $accidente->id }}</td>
                                                <td>{{ $accidente->fecha_hora }}</td>
                                                <td>{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                                <td>{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                                <td>{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                                <td>{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                                <td class="text-center text-capitalize">{{ $accidente->gravedad }}</td>
                                                <td class="text-center">
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
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deletebtn"
                                                            data-id="{{ $accidente->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No hay accidentes registrados.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Editar --}}
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <form id="formEditar" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="edit-fecha_hora">Fecha y Hora</label>
                                        <input type="datetime-local" name="fecha_hora" id="edit-fecha_hora" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-area_unidad_productiva_id">Área</label>
                                        <select name="area_unidad_productiva_id" id="edit-area_unidad_productiva_id" class="form-select form-select-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-tipo_lesion_id">Tipo de Lesión</label>
                                        <select name="tipo_lesion_id" id="edit-tipo_lesion_id" class="form-select form-select-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposLesion as $tipoLesion)
                                                <option value="{{ $tipoLesion->id }}">{{ $tipoLesion->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-tipo_riesgo_id">Tipo de Riesgo</label>
                                        <select name="tipo_riesgo_id" id="edit-tipo_riesgo_id" class="form-select form-select-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposRiesgo as $tipoRiesgo)
                                                <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-tipo_accidente_id">Tipo de Accidente</label>
                                        <select name="tipo_accidente_id" id="edit-tipo_accidente_id" class="form-select form-select-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposAccidente as $tipoAccidente)
                                                <option value="{{ $tipoAccidente->id }}">{{ $tipoAccidente->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-gravedad">Gravedad</label>
                                        <select name="gravedad" id="edit-gravedad" class="form-select form-select-sm" required>
                                            <option value="leve">Leve</option>
                                            <option value="moderada">Moderada</option>
                                            <option value="grave">Grave</option>
                                            <option value="fatal">Fatal</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="edit-descripcion">Descripción</label>
                                        <textarea name="descripcion" id="edit-descripcion" class="form-control form-control-sm" rows="2"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="edit-evidencia">Evidencia</label>
                                        <textarea name="evidencia" id="edit-evidencia" class="form-control form-control-sm" rows="2"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit-creado_por">Creado por</label>
                                        <input type="text" name="creado_por" id="edit-creado_por" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Eliminar --}}
            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="formEliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro que deseas eliminar este registro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.editbtn').forEach(button => {
                button.addEventListener('click', function () {
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
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEliminar').action = `/accidentes/${id}`;
                });
            });
        });
    </script>
@endsection
