@extends('layouts/master')

@section('tituloPagina', 'Registro de Cultivo')

@section('content')
    <br><br>
    <center>
        <div class="card shadow-lg" style="width: 40rem;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrar Cultivo Rentable</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('cultivos.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha Registro:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="fecha" id="fecha" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Cultivo:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-leaf"></i></span>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre Cultivo" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo del Cultivo:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-tags"></i></span>
                            <input type="text" name="tipo" id="tipo" placeholder="Tipo Cultivo" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="area" class="form-label">Área Cultivada (m²):</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-rulers"></i></span>
                            <input type="number" name="area" id="area" placeholder="Área Sembrada" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="presupuesto" class="form-label">Presupuesto ($):</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                            <input type="number" name="presupuesto" id="presupuesto" placeholder="Presupuesto" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-plus-circle"></i> Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </center>
@endsection
