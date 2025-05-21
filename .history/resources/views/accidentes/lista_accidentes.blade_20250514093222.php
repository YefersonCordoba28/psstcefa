<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Accidentes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #1abc9c;
            --accent-color: #3498db;
            --light-bg: #f8f9fa;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --success-color: #27ae60;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background-color: #f5f7fa;
            color: #444;
        }

        /* Header and Navigation */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Main Card Design */
        .main-card {
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .main-card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            padding: 1.5rem;
            border-bottom: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title-custom {
            font-weight: 600;
            margin: 0;
            font-size: 1.5rem;
        }

        .card-body-custom {
            padding: 2rem;
        }

        /* Table Styling */
        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            padding: 12px;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .table-custom tbody tr {
            transition: var(--transition);
        }

        .table-custom tbody tr:hover {
            background-color: rgba(26, 188, 156, 0.05);
        }

        .table-custom td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        /* Buttons */
        .btn-custom-primary {
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            border: none;
            color: white;
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            transition: var(--transition);
            font-weight: 500;
        }

        .btn-custom-primary:hover {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }

        .btn-custom-danger {
            background: linear-gradient(135deg, var(--danger-color), #c0392b);
            border: none;
            color: white;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .btn-custom-danger:hover {
            background: linear-gradient(135deg, #c0392b, var(--danger-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
        }

        .btn-custom-success {
            background: linear-gradient(135deg, var(--success-color), #2ecc71);
            border: none;
            color: white;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .btn-custom-success:hover {
            background: linear-gradient(135deg, #2ecc71, var(--success-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
        }

        /* Form Controls */
        .form-control-custom {
            border-radius: var(--border-radius);
            padding: 0.75rem;
            border: 1px solid #ddd;
            transition: var(--transition);
        }

        .form-control-custom:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .input-group-text-custom {
            background-color: var(--light-bg);
            border: 1px solid #ddd;
            color: #777;
        }

        /* Filter Section */
        .filter-section {
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Badges */
        .badge-leve {
            background-color: var(--success-color);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .badge-moderada {
            background-color: var(--warning-color);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .badge-grave {
            background-color: var(--danger-color);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .badge-fatal {
            background-color: #000;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 50px;
            font-weight: 500;
        }

        /* Modal Styling */
        .modal-custom {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .modal-header-custom {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-footer-custom {
            background-color: var(--light-bg);
            border-top: none;
            padding: 1.5rem;
        }

        /* Image Thumbnail */
        .evidence-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: var(--border-radius);
            transition: var(--transition);
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .evidence-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Mobile Card Styling */
        .mobile-card {
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 1rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .mobile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .mobile-card-header {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            padding: 1rem;
            font-weight: 600;
        }

        .mobile-card-body {
            padding: 1rem;
        }

        .mobile-card-row {
            display: flex;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 0.5rem;
        }

        .mobile-card-label {
            width: 40%;
            font-weight: 600;
            color: var(--primary-color);
        }

        .mobile-card-value {
            width: 60%;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-header-custom {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .filter-section {
                padding: 1rem;
            }
        }

        /* No Data Message */
        .no-data-message {
            text-align: center;
            padding: 2rem;
            color: #777;
        }

        .no-data-message i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }

        /* Zoom Effect for Evidence */
        .zoomed {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(2);
            z-index: 9999;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            max-width: 80vw;
            max-height: 80vh;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9998;
            display: none;
        }

        /* Stats Cards */
        .stats-row {
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #fff, #f8f9fa);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card i {
            font-size: 2rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-card h3 {
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .stat-card p {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
    </style>
</head>
<body>

@extends('instructor.dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <!-- Encabezado dinámico -->
            <div class="row">
                <div class="col-12 mb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Registro de Accidentes</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Tarjetas de estadísticas -->
            <div class="row stats-row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h3>{{ $accidentes->count() }}</h3>
                        <p>Total de Accidentes</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <i class="fas fa-check-circle"></i>
                        <h3>{{ $accidentes->where('gravedad', 'leve')->count() }}</h3>
                        <p>Accidentes Leves</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <i class="fas fa-exclamation-circle"></i>
                        <h3>{{ $accidentes->where('gravedad', 'moderada')->count() + $accidentes->where('gravedad', 'grave')->count() }}</h3>
                        <p>Moderados/Graves</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-card">
                        <i class="fas fa-skull-crossbones"></i>
                        <h3>{{ $accidentes->where('gravedad', 'fatal')->count() }}</h3>
                        <p>Accidentes Fatales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay" id="overlay"></div>

    <section class="content">
        <div class="container-fluid">
            <!-- Sección de filtros -->
            <div class="filter-section">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="mb-3"><i class="fas fa-filter me-2"></i>Filtros</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <a href="{{ route('accidentes.create') }}" class="btn btn-custom-primary">
                                <i class="fas fa-plus-circle me-2"></i>Registrar Nuevo
                            </a>
                            <button class="btn btn-custom-primary" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
                                <i class="fas fa-user-plus me-2"></i>Registrar Persona
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 col-12">
                        <form id="searchForm" class="d-flex gap-2">
                            <select name="gravedad" id="gravedadFilter" class="form-control form-control-custom">
                                <option value="">Todos los niveles de gravedad</option>
                                <option value="leve">Leve</option>
                                <option value="moderada">Moderada</option>
                                <option value="grave">Grave</option>
                                <option value="fatal">Fatal</option>
                            </select>
                            <button type="submit" class="btn btn-custom-primary">
                                <i class="fas fa-search me-2"></i>Buscar
                            </button>
                            <button type="button" id="resetFilter" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-2"></i>Resetear
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="main-card">
                <div class="card-header-custom">
                    <h5 class="card-title-custom"><i class="fas fa-clipboard-list me-2"></i>Registro de Accidentes</h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-light" id="viewToggle">
                                <i class="fas fa-th-list me-1"></i> Vista
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body-custom">
                    <!-- Table Layout for Desktop -->
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-custom" id="accidentesTable">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center" width="12%">Fecha/Hora</th>
                                    <th class="text-center" width="13%">Área</th>
                                    <th class="text-center" width="13%">Lesión</th>
                                    <th class="text-center" width="13%">Riesgo</th>
                                    <th class="text-center" width="13%">Accidente</th>
                                    <th class="text-center" width="10%">Gravedad</th>
                                    <th class="text-center" width="10%">Evidencia</th>
                                    <th class="text-center" width="11%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accidentes as $accidente)
                                    <tr class="accidente-row" data-gravedad="{{ $accidente->gravedad }}">
                                        <td class="text-center fw-bold">{{ $accidente->id }}</td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">{{ \Carbon\Carbon::parse($accidente->fecha_hora)->format('d/m/Y') }}</span>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($accidente->fecha_hora)->format('h:i A') }}</small>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="d-inline-block text-truncate" style="max-width: 120px;" 
                                                title="{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}">
                                                {{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="d-inline-block text-truncate" style="max-width: 120px;" 
                                                title="{{ $accidente->tipoLesion->nombre ?? 'N/A' }}">
                                                {{ $accidente->tipoLesion->nombre ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="d-inline-block text-truncate" style="max-width: 120px;" 
                                                title="{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}">
                                                {{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="d-inline-block text-truncate" style="max-width: 120px;" 
                                                title="{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}">
                                                {{ $accidente->tipoAccidente->nombre ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-{{ $accidente->gravedad }}">
                                                {{ ucfirst($accidente->gravedad) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($accidente->evidencia)
                                                <img src="{{ asset('img_accidentes/' . basename($accidente->evidencia)) }}" 
                                                    alt="Evidencia" 
                                                    class="evidence-thumbnail"
                                                    onclick="toggleZoom(this)">
                                            @else
                                                <span class="text-muted"><i class="fas fa-image-slash"></i></span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-custom-success btn-sm editbtn action-btn"
                                                        data-id="{{ $accidente->id }}"
                                                        data-fecha_hora="{{ $accidente->fecha_hora }}"
                                                        data-area_unidad_productiva_id="{{ $accidente->area_unidad_productiva_id }}"
                                                        data-tipo_lesion_id="{{ $accidente->tipo_lesion_id }}"
                                                        data-tipo_riesgo_id="{{ $accidente->tipo_riesgo_id }}"
                                                        data-tipo_accidente_id="{{ $accidente->tipo_accidente_id }}"
                                                        data-descripcion="{{ $accidente->descripcion }}"
                                                        data-evidencia="{{ $accidente->evidencia }}"
                                                        data-gravedad="{{ $accidente->gravedad }}"
                                                        data-creado_por="{{ $accidente->creado_por }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editarModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-custom-danger btn-sm deletebtn action-btn"
                                                        data-id="{{ $accidente->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#eliminarModal">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">
                                            <div class="no-data-message">
                                                <i class="fas fa-clipboard-list"></i>
                                                <h5>No hay accidentes registrados</h5>
                                                <p>Los accidentes registrados aparecerán aquí</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Card Layout for Mobile -->
                    <div class="accidente-list d-md-none">
                        @forelse ($accidentes as $accidente)
                            <div class="mobile-card accidente-item" data-gravedad="{{ $accidente->gravedad }}">
                                <div class="mobile-card-header d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-exclamation-triangle me-2"></i>Accidente #{{ $accidente->id }}</span>
                                    <span class="badge-{{ $accidente->gravedad }}">{{ ucfirst($accidente->gravedad) }}</span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-card-row">
                                        <div class="mobile-card-label"><i class="far fa-calendar-alt me-2"></i>Fecha:</div>
                                        <div class="mobile-card-value">{{ \Carbon\Carbon::parse($accidente->fecha_hora)->format('d/m/Y - h:i A') }}</div>
                                    </div>
                                    <div class="mobile-card-row">
                                        <div class="mobile-card-label"><i class="fas fa-map-marker-alt me-2"></i>Área:</div>
                                        <div class="mobile-card-value">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</div>
                                    </div>
                                    <div class="mobile-card-row">
                                        <div class="mobile-card-label"><i class="fas fa-first-aid me-2"></i>Lesión:</div>
                                        <div class="mobile-card-value">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</div>
                                    </div>
                                    <div class="mobile-card-row">
                                        <div class="mobile-card-label"><i class="fas fa-exclamation-circle me-2"></i>Riesgo:</div>
                                        <div class="mobile-card-value">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</div>
                                    </div>
                                    <div class="mobile-card-row">
                                        <div class="mobile-card-label"><i class="fas fa-shield-alt me-2"></i>Accidente:</div>
                                        <div class="mobile-card-value">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</div>
                                    </div>
                                    <div class="mobile-card-row">
                                        <div class="mobile-card-label"><i class="fas fa-image me-2"></i>Evidencia:</div>
                                        <div class="mobile-card-value">
                                            @if($accidente->evidencia)
                                                <img src="{{ asset('img_accidentes/' . basename($accidente->evidencia)) }}" 
                                                    alt="Evidencia" 
                                                    class="evidence-thumbnail"
                                                    onclick="toggleZoom(this)">
                                            @else
                                                <span class="text-muted">Sin evidencia</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button class="btn btn-custom-success btn-sm editbtn action-btn"
                                                data-id="{{ $accidente->id }}"
                                                data-fecha_hora="{{ $accidente->fecha_hora }}"
                                                data-area_unidad_productiva_id="{{ $accidente->area_unidad_productiva_id }}"
                                                data-tipo_lesion_id="{{ $accidente->tipo_lesion_id }}"
                                                data-tipo_riesgo_id="{{ $accidente->tipo_riesgo_id }}"
                                                data-tipo_accidente_id="{{ $accidente->tipo_accidente_id }}"
                                                data-descripcion="{{ $accidente->descripcion }}"
                                                data-evidencia="{{ $accidente->evidencia }}"
                                                data-gravedad="{{ $accidente->gravedad }}"
                                                data-creado_por="{{ $accidente->creado_por }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editarModal">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </button>
                                        <button class="btn btn-custom-danger btn-sm deletebtn action-btn"
                                                data-id="{{ $accidente->id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#eliminarModal">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="no-data-message">
                                <i class="fas fa-clipboard-list"></i>
                                <h5>No hay accidentes registrados</h5>
                                <p>Los accidentes registrados aparecerán aquí</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal: Registrar Persona Involucrada -->
    <div class="modal fade" id="modalPersonalizado" tabindex="-1" aria-labelledby="modalPersonalizadoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-custom">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('personas_involucradas.store') }}" method="POST">
                    @csrf
                    <div class="modal-header modal-header-custom">
                        <h5 class="modal-title" id="modalPersonalizadoLabel">
                            <i class="fas fa-user-plus me-2"></i>Registrar Persona Involucrada
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body py-4 px-4">
                        <div class="row g-4">
                            <!-- Nombre -->
                            <div class="col-12 col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-custom"><i class="fas fa-user"></i></span>
                                    <input