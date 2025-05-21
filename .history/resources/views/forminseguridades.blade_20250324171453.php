@extends('instructor/dashboard')

@section('tituloPagina', 'Registrar de  Inseguridad')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrar Inseguridad</h4>
            </div>
            <div class="card-body bg-light p-4">
                <form id="inseguridadForm" action="{{ route('inseguridades.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Fecha y Hora -->
                    <div class="mb-3">
                        <label for="fecha_hora" class="form-label">Fecha y Hora:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
                        </div>
                    </div>

                    <!-- Área Productiva -->
                    <div class="mb-3">
                        <label for="area_productiva" class="form-label">Área Productiva:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                            <input type="text" name="area_productiva" id="area_productiva" class="form-control" placeholder="Ej: Taller de mecánica" required>
                        </div>
                    </div>

                    <!-- Tipo de Inseguridad -->
                    <div class="mb-3">
                        <label for="tipo_inseguridad" class="form-label">Tipo de Inseguridad:</label>
                        <select name="tipo_inseguridad" id="tipo_inseguridad" class="form-select" required>
                            <option value="">Selecciona el tipo</option>
                            <option value="acto_inseguro">Acto Inseguro</option>
                            <option value="condicion_insegura">Condición Insegura</option>
                        </select>
                    </div>

                    <!-- Lugar de Inseguridad -->
                    <div class="mb-3">
                        <label for="lugar_inseguridad" class="form-label">Lugar de Inseguridad:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="lugar_inseguridad" id="lugar_inseguridad" class="form-control" placeholder="Ej: Máquina CNC #2" required>
                        </div>
                    </div>

                    <!-- Descripción de Inseguridad -->
                    <div class="mb-3">
                        <label for="descripcion_inseguridad" class="form-label">Descripción de Inseguridad:</label>
                        <textarea name="descripcion_inseguridad" id="descripcion_inseguridad" rows="3" class="form-control" placeholder="Describe la inseguridad observada" required></textarea>
                    </div>

                    <!-- Evidencia -->
                    <div class="mb-3">
                        <label for="evidencia" class="form-label">Subir Evidencia (imagen):</label>
                        <input type="file" name="evidencia" id="evidencia" class="form-control" accept="image/*">
                    </div>

                    <!-- Creado por (autenticado) -->
                    <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                    <!-- Botón -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Registrar Inseguridad
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('inseguridadForm').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¡Inseguridad registrada con éxito!',
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