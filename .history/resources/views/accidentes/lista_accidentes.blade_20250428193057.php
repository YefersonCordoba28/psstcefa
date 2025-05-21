@extends('instructor.dashboard')

@section('content')
<br><br>
<center>
    <div class="card" style="width: 80rem;">
        <h5 class="card-header">Lista de Accidentes</h5>
        <div class="card-body">
            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crear">Registrar Nuevo</a>

            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y Hora</th>
                            <th>Área</th>
                            <th>Tipo Lesión</th>
                            <th>Tipo Riesgo</th>
                            <th>Tipo Accidente</th>
                            <th>Gravedad</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos     as $accidente)
                            <tr>
                                <td>{{ $accidente->id }}</td>
                                <td>{{ $accidente->fecha_hora }}</td>
                                <td>{{ $accidente->area->nombre }}</td>
                                <td>{{ $accidente->tipoLesion->nombre }}</td>
                                <td>{{ $accidente->tipoRiesgo->nombre }}</td>
                                <td>{{ $accidente->tipoAccidente->nombre }}</td>
                                <td>{{ ucfirst($accidente->gravedad) }}</td>
                                <td>
                                    <button class="btn btn-success editbtn"
                                        data-id="{{ $accidente->id }}"
                                        data-fecha_hora="{{ $accidente->fecha_hora }}"
                                        data-area="{{ $accidente->area_unidad_productiva_id }}"
                                        data-lesion="{{ $accidente->tipo_lesion_id }}"
                                        data-riesgo="{{ $accidente->tipo_riesgo_id }}"
                                        data-accidente="{{ $accidente->tipo_accidente_id }}"
                                        data-descripcion="{{ $accidente->descripcion }}"
                                        data-evidencia="{{ $accidente->evidencia }}"
                                        data-gravedad="{{ $accidente->gravedad }}"
                                        data-creado_por="{{ $accidente->creado_por }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editar">Editar</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger deletebtn"
                                        data-id="{{ $accidente->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#eliminar">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Modal Crear --}}
            <div class="modal fade" id="crear" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('accidentes.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Registrar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @include('accidentes.form', ['edit' => false])
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Editar --}}
            <div class="modal fade" id="editar" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form id="formEditar" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @include('accidentes.form', ['edit' => true])
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Eliminar --}}
            <div class="modal fade" id="eliminar" tabindex="-1">
                <div class="modal-dialog">
                    <form id="formEliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este accidente?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</center>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('formEditar').action = `/accidentes/${id}`;
                document.getElementById('edit-fecha_hora').value = this.dataset.fecha_hora;
                document.getElementById('edit-area').value = this.dataset.area;
                document.getElementById('edit-lesion').value = this.dataset.lesion;
                document.getElementById('edit-riesgo').value = this.dataset.riesgo;
                document.getElementById('edit-accidente').value = this.dataset.accidente;
                document.getElementById('edit-descripcion').value = this.dataset.descripcion;
                document.getElementById('edit-evidencia').value = this.dataset.evidencia;
                document.getElementById('edit-gravedad').value = this.dataset.gravedad;
                document.getElementById('edit-creado_por').value = this.dataset.creado_por;
            });
        });

        document.querySelectorAll('.deletebtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('formEliminar').action = `/accidentes/${id}`;
            });
        });
    });
</script>
@endsection
