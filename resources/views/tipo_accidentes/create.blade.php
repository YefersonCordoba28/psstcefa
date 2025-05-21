@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-center">Registrar Tipo de Accidente</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Formulario de Registro</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tipo_accidentes.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="nombre">Nombre del Tipo de Accidente</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Ej: Caída, Cortadura, etc.">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Ajustes para pantallas pequeñas */
        @media (max-width: 768px) {
            .card {
                margin: 0 0.5rem;
            }
            .form-group label {
                font-size: 0.9rem;
            }
            .form-control {
                font-size: 0.9rem;
            }
            .btn-sm {
                font-size: 0.85rem;
                padding: 0.25rem 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .card-header h5 {
                font-size: 1.1rem;
            }
            .form-group label {
                font-size: 0.85rem;
            }
            .form-control {
                font-size: 0.85rem;
            }
            .btn-sm {
                font-size: 0.75rem;
                padding: 0.2rem 0.4rem;
            }
            .d-flex {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
@endsection