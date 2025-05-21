@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Registrar Tipo de Lesión</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tipo_lesion.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nombre">Nombre del Tipo de Lesión</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Ej: Fractura, Cortadura, Contusión, etc.">
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
