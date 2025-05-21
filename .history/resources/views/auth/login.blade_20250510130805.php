@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 12px;">
        <!-- Encabezado -->
        <div class="card-header text-center bg-dark text-white" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <img src="{{ asset('images/por.png') }}" alt="Logotipo SST" width="80" height="80"> 
            <h4 class="mt-2"><i class="fas fa-hard-hat"></i> Inicia Sesión</h4>
            <p class="small mb-0">Tu seguridad es nuestra prioridad</p>
        </div>

        <div class="card-body px-4 py-3">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email" class="fw-bold"><i class="fas fa-user"></i> Correo Electrónico</label>
                    <input id="email" type="email" class="form-control rounded-pill shadow-sm" name="email" required autofocus placeholder="Ingrese su correo">
                </div>

                <!-- Password -->
                <div class="form-group mb-3">
                    <label for="password" class="fw-bold"><i class="fas fa-lock"></i> Contraseña</label>
                    <input id="password" type="password" class="form-control rounded-pill shadow-sm" name="password" required placeholder="Ingrese su contraseña">
                </div>

                <!-- Recordarme -->
                <div class="form-group form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>

                <!-- Botón -->
                <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="card-footer text-center bg-light small text-muted">
            <p class="mb-1"><i class="fas fa-exclamation-triangle text-warning"></i> Recuerda: La seguridad es responsabilidad de todos</p>
            <a href="{{ route('password.request') }}" class="text-primary">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>
@endsection

