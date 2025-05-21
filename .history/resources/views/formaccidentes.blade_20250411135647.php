@extends('layouts.app') {{-- Asegúrate de que tu layout principal se llame así --}}

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 text-center">
                <h1 class="m-0 font-weight-bold text-primary">Registro de Accidente</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-lg-10">
            <div class="card card-primary card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">📝 Complete los siguientes campos</h3>
                </div>

                <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="fecha_hora">📅 Fecha y Hora</label>
                            <input type="datetime-local" name="fecha_hora" id="fecha_hora" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="ubicacion">📍 Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="descripcion_accidente">📝 Descripción del Accidente</label>
                            <textarea name="descripcion_accidente" id="descripcion_accidente" rows="4" required class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="personas_involucradas">👥 Personas Involucradas</label>
                            <textarea name="personas_involucradas" id="personas_involucradas" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="gravedad">🚨 Nivel de Gravedad</label>
                            <select name="gravedad" id="gravedad" required class="form-control">
                                <option value="" disabled selected>Selecciona la gravedad</option>
                                <option value="Leve">Leve</option>
                                <option value="Moderado">Moderado</option>
                                <option value="Grave">Grave</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="evidencias">📷 Subir Evidencias (imagen)</label>
                            <input type="file" name="evidencias" id="evidencias" accept="image/*" class="form-control-file">
                        </div>

                        <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-save mr-2"></i>Registrar Accidente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Alerta de éxito con SweetAlert2 --}}
<script>
    document.getElementById('accidenteForm').addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: '¡Accidente registrado con éxito!',
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
