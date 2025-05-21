@extends('layouts.master')

@section('content')
    <br><br>
    <center>
        <div class="card" style="width: 60rem;">
            <h5 class="card-header">Lista de Tipos de Incidentes</h5>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crear">Registrar Nuevo</a>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Tipo</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>
                                        <button class="btn btn-success editbtn"
                                            data-id="{{ $item->id }}"
                                            data-nombre="{{ $item->nombre }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editar">Editar</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger deletebtn"
                                            data-id="{{ $item->id }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#eliminar">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Modal Crear --}}
                <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('tipo_incidentes.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registrar Tipo de Incidente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" required>
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
                <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="formEditar" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Tipo de Incidente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="edit-nombre">Nombre:</label>
                                    <input type="text" name="nombre" id="edit-nombre" class="form-control" required>
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
                <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="formEliminar" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar Tipo de Incidente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar este tipo de incidente?
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
                    const id = this.getAttribute('data-id');
                    const nombre = this.getAttribute('data-nombre');
                    document.getElementById('formEditar').action = `/tipo_incidentes/${id}`;
                    document.getElementById('edit-nombre').value = nombre;
                });
            });

            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEliminar').action = `/tipo_incidentes/${id}`;
                });
            });
        });
    </script>
@endsection
