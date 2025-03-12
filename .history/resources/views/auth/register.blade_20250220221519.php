@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="background: #f4f6f9;">
    <div class="card shadow-lg border-0" style="width: 480px; border-radius: 12px;"> <!-- Aumenté el ancho a 480px -->
        <!-- Encabezado con Logo y Mensaje de Seguridad -->
        <div class="card-header text-center bg-dark text-white" style="border-top-left-radius: 12px; border-top-right-radius: 12px; padding: 20px;">
            <!-- Imagen centrada con márgenes -->
            <div class="d-flex justify-content-center mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logotipo SST" style="width: 40px; height: 40px; object-fit: contain;">
            </div>
            <h4 class="mt-2"><i class="fas fa-hard-hat"></i> Registrarse</h4>
            <p class="small mb-0">Tu seguridad es nuestra prioridad</p>
        </div>

        <div class="card-body px-4 py-3">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="form-group mb-3">
                    <label for="name" class="fw-bold"><i class="fas fa-user"></i> Nombre</label>
                    <input id="name" type="text" class="form-control rounded-pill shadow-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ingrese su nombre">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group mb-3">
                    <label for="email" class="fw-bold"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                    <input id="email" type="email" class="form-control rounded-pill shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ingrese su correo">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="form-group mb-3">
                    <label for="password" class="fw-bold"><i class="fas fa-lock"></i> Contraseña</label>
                    <input id="password" type="password" class="form-control rounded-pill shadow-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Ingrese su contraseña">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group mb-3">
                    <label for="password-confirm" class="fw-bold"><i class="fas fa-lock"></i> Confirmar Contraseña</label>
                    <input id="password-confirm" type="password" class="form-control rounded-pill shadow-sm" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme su contraseña">
                </div>

                <!-- Botón de Registro -->
                <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill shadow-sm" style="transition: 0.3s;">
                    <i class="fas fa-user-plus"></i> Registrarse
                </button>
            </form>
        </div>

        <!-- Pie de Página -->
        <div class="card-footer text-center bg-light small text-muted">
            <p class="mb-1"><i class="fas fa-exclamation-triangle text-warning"></i> Recuerda: La seguridad es responsabilidad de todos</p>
            <a href="{{ route('login') }}" class="text-primary">¿Ya tienes una cuenta? Inicia sesión</a>
        </div>
    </div>
</div>
@endsection