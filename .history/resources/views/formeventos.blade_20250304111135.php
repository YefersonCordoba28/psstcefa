@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Evento')

@section('content') <!-- Aquí empieza la sección de contenido -->

<center><h1>Listado de Eventos</h1>
<br>
<div class="card" style="width: 65rem">
    <h5 class="card-header">Lista de Eventos</h5>
    <div class="card-body">
        <div class="row"></div>
    </div>
    <div class="table table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <th><center>Id</center></th>
                <th><center>Fecha</center></th>
                <th><center>Hora</center></th>
                <th><center>Ubicación</center></th>
                <th><center>Tipo de Evento</center></th>
                <th><center>Descripción</center></th>
                <th><center>personas_involucradas</center></th>
                <th><center>testigos</center></th>
                <th><center>evidencias</center></th>
                
                <th>Editar</th>
                <th>Eliminar</th>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                    <tr>
                        <td><center>{{ $item->id }}</center></td>
                        <td><center>{{ $item->fecha }}</center></td>
                        <td><center>{{ $item->hora }}</center></td>
                        <td><center>{{ $item->ubicación }}</center></td>
                        <td><center>{{ $item->tipo_evento }}</center></td>
                        <td><center>{{ $item->descripción_evento }}</center></td>
                        <td><center>{{ $item->personas_involucradas }}</center></td>
                        <td><center>{{ $item->testigos }}</center></td>
                        <td><center>{{ $item->evidencias }}</center></td>
                        <td>
                            <center><button type="button" class="btn btn-success editbtn" data-id="{{ $item->id }}" data-fecha="{{ $item->fecha }}" data-hora="{{ $item->hora }}" data-ubicación="{{ $item->ubicación }}" data-tipo_evento="{{ $item->tipo_evento }}" data-descripción_evento="{{ $item->descripción_evento }}" data-fecha="{{ $item->personas_involucradas }}" data-bs-toggle="modal" data-bs-target="#editar">Editar</button></center>
                        </td>
                        <td>
                            <center><button type="button" class="btn btn-danger deletebtn" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#eliminar">Eliminar</button></center>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Editar -->
        <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditar" action="{{ route('eventos.update', 0) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarLabel">Editar Evento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="mb-3">
                                <label for="edit-fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="edit-fecha" name="fecha">
                            </div>
                            <div class="mb-3">
                                <label for="edit-hora" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="edit-hora" name="hora">
                            </div>
                            <div class="mb-3">
                                <label for="edit-ubicación" class="form-label">Ubicación</label>
                                <input type="text" class="form-control" id="edit-ubicación" name="ubicación">
                            </div>
                            <div class="mb-3">
                                <label for="edit-tipo_evento" class="form-label">Tipo de Evento</label>
                                <input type="text" class="form-control" id="edit-tipo_evento" name="tipo_evento">
                            </div>
                            <div class="mb-3">
                                <label for="edit-descripción_evento" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="edit-descripción_evento" name="descripción_evento">
                            </div>
                            <div class="mb-3">
                                <label for="edit-personas_involucradas" class="form-label">Personas involucradas</label>
                                <input type="text" class="form-control" id="edit-personas_involucradas" name="personas_involucradas">
                            </div>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar -->
        <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEliminar" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar este evento?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</center>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/eventos/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-fecha').value = this.getAttribute('data-fecha');
                document.getElementById('edit-hora').value = this.getAttribute('data-hora');
                document.getElementById('edit-ubicación').value = this.getAttribute('data-ubicación');
                document.getElementById('edit-tipo_evento').value = this.getAttribute('data-tipo_evento');
                document.getElementById('edit-descripción_evento').value = this.getAttribute('data-descripción_evento');
                document.getElementById('edit-personas_involucradas').value = this.getAttribute('data-personas_involucradas');
            });
        });

        document.querySelectorAll('.deletebtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/eventos/${id}`;
            });
        });
    });
</script>

@endsection <!-- Aquí termina la sección de contenido -->
arreglame esta lista segun el siguiente formulario para que me deje editar @extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Evento')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrar Evento</h4>
            </div>
            <div class="card-body bg-light p-4">
                <form id="eventoForm" action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="fecha" id="fecha" class="form-control" required>
                        </div>
                    </div>

                    <!-- Hora -->
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            <input type="time" name="hora" id="hora" class="form-control" required>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="mb-3">
                        <label for="ubicación" class="form-label">Ubicación:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="ubicación" id="ubicación" class="form-control" required>
                        </div>
                    </div>

                    <!-- Tipo de Evento -->
                    <div class="mb-3">
                        <label for="tipo_evento" class="form-label">Tipo de Evento:</label>
                        <select name="tipo_evento" id="tipo_evento" class="form-select" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="Accidente">Accidente</option>
                            <option value="Incidente">Incidente</option>
                            <option value="Emergencia">Emergencia</option>
                        </select>
                    </div>

                    <!-- Descripción del Evento -->
                    <div class="mb-3">
                        <label for="descripción_evento" class="form-label">Descripción del Evento:</label>
                        <textarea name="descripción_evento" id="descripción_evento" rows="3" class="form-control" required></textarea>
                    </div>

                    <!-- Personas Involucradas -->
                    <div class="mb-3">
                        <label for="personas_involucradas" class="form-label">Personas Involucradas:</label>
                        <textarea name="personas_involucradas" id="personas_involucradas" rows="2" class="form-control"></textarea>
                    </div>

                    <!-- Testigos -->
                    <div class="mb-3">
                        <label for="testigos" class="form-label">Testigos:</label>
                        <textarea name="testigos" id="testigos" rows="2" class="form-control"></textarea>
                    </div>

                    <!-- Evidencias -->
                    <div class="mb-3">
                        <label for="evidencias" class="form-label">Subir Evidencias (imagen):</label>
                        <input type="file" name="evidencias" id="evidencias" class="form-control" accept="image/*">
                    </div>

                    <!-- Creado por (autenticado) -->
                    <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                    <!-- Botón -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Registrar Evento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('eventoForm').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¡Evento registrado con éxito!',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endsection