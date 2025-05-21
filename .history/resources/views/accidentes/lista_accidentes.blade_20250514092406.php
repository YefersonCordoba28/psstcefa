<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafetyX Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #050A30;
            --secondary: #233dff;
            --accent: #00C4FF;
            --success: #00A3B4;
            --warning: #FFB830;
            --danger: #FF304F;
            --fatal: #121212;
            --light: #F8F9FA;
            --dark: #212529;
            --gray: #6c757d;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,0.08);
            --radius: 12px;
            --transition: all 0.3s ease;
            --font-primary: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-primary);
        }

        body {
            background-color: #f0f2f5;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 1.5rem 2rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .dashboard-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dashboard-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .dashboard-logo {
            height: 40px;
            width: auto;
        }

        /* Main Content */
        .dashboard-content {
            flex: 1;
            padding: 2rem;
            max-width: 1440px;
            margin: 0 auto;
            width: 100%;
        }

        /* Card Styles */
        .card {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            border: none;
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            background-color: var(--white);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
        }

        .btn-primary {
            background-color: var(--primary);
        }

        .btn-secondary {
            background-color: var(--secondary);
        }

        .btn-success {
            background-color: var(--success);
        }

        .btn-danger {
            background-color: var(--danger);
        }

        .btn-warning {
            background-color: var(--warning);
            color: var(--dark);
        }

        .btn-outline-primary {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: var(--white);
        }

        /* Badge Styles */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35em 0.65em;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background-color: rgba(0, 163, 180, 0.1);
            color: var(--success);
        }

        .badge-warning {
            background-color: rgba(255, 184, 48, 0.1);
            color: var(--warning);
        }

        .badge-danger {
            background-color: rgba(255, 48, 79, 0.1);
            color: var(--danger);
        }

        .badge-dark {
            background-color: rgba(18, 18, 18, 0.1);
            color: var(--fatal);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            border-radius: var(--radius);
            border: 1px solid rgba(0,0,0,0.1);
            background-color: var(--white);
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--secondary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(35, 61, 255, 0.1);
        }

        .input-group {
            display: flex;
            position: relative;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: var(--radius) 0 0 var(--radius);
            border: 1px solid rgba(0,0,0,0.1);
            border-right: none;
            background-color: var(--light);
        }

        .input-group .form-control {
            border-radius: 0 var(--radius) var(--radius) 0;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--white);
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .table th {
            background-color: var(--light);
            font-weight: 600;
            color: var(--primary);
            white-space: nowrap;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background-color: rgba(0,0,0,0.01);
        }

        .table td {
            vertical-align: middle;
        }

        /* Search and Filter Bar */
        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            gap: 0.5rem;
            flex: 1;
            min-width: 200px;
        }

        .search-input {
            flex: 1;
            position: relative;
        }

        .search-input i {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .search-input .form-control {
            padding-left: 2.5rem;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .stat-icon {
            height: 48px;
            width: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            background-color: rgba(35, 61, 255, 0.1);
            color: var(--secondary);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
            font-weight: 500;
        }

        /* Mobile Card View */
        .accident-card {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 0;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .accident-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .accident-card-header {
            padding: 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            background-color: var(--light);
        }

        .accident-card-title {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: var(--primary);
        }

        .accident-card-body {
            padding: 1rem;
        }

        .accident-card-item {
            display: flex;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .accident-card-item:last-child {
            border-bottom: none;
        }

        .accident-card-label {
            font-weight: 500;
            width: 40%;
            color: var(--dark);
        }

        .accident-card-value {
            width: 60%;
        }

        .accident-card-footer {
            padding: 1rem;
            background-color: var(--light);
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            border-radius: var(--radius) var(--radius) 0 0;
            position: relative;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.25rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .modal-close:hover {
            transform: scale(1.1);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1.5rem;
            background-color: var(--light);
            border-radius: 0 0 var(--radius) var(--radius);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-content {
                padding: 1rem;
            }

            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-group {
                width: 100%;
            }
        }

        /* Utilities */
        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .text-center {
            text-align: center;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
        }

        .text-muted {
            color: var(--gray);
        }

        .img-thumbnail {
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

        /* Accent colors for areas */
        .badge-physics {
            background-color: rgba(74, 169, 255, 0.1);
            color: #4AA9FF;
        }

        .badge-chemistry {
            background-color: rgba(162, 93, 220, 0.1);
            color: #A25DDC;
        }

        .badge-biology {
            background-color: rgba(46, 204, 113, 0.1);
            color: #2ECC71;
        }

        .badge-engineering {
            background-color: rgba(253, 150, 68, 0.1);
            color: #FD9644;
        }

        /* Progress bar styling */
        .safety-progress {
            height: 8px;
            background-color: rgba(0,0,0,0.05);
            border-radius: 4px;
            overflow: hidden;
        }

        .safety-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--success), var(--secondary));
            border-radius: 4px;
        }

        /* Chart container */
        .chart-container {
            width: 100%;
            height: 300px;
            background-color: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        /* Action buttons with hover effects */
        .action-btn {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            color: var(--white);
        }

        .action-btn:hover {
            transform: translateY(-3px);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="dashboard-title">
            <svg class="dashboard-logo" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h1>SafetyX - Gestión Inteligente de Seguridad</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="dashboard-content">
        <!-- Stats Overview -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value">158</div>
                <div class="stat-label">Total incidentes registrados</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(0, 163, 180, 0.1); color: var(--success);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">92%</div>
                <div class="stat-label">Resolución de incidentes</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(255, 48, 79, 0.1); color: var(--danger);">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="stat-value">18</div>
                <div class="stat-label">Incidentes críticos</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(255, 184, 48, 0.1); color: var(--warning);">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="stat-value">85%</div>
                <div class="stat-label">Índice de seguridad</div>
                <div class="safety-progress mt-2">
                    <div class="safety-progress-bar" style="width: 85%;"></div>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Incidentes de Seguridad</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Registrar Nuevo
                    </button>
                    <button class="btn btn-sm btn-secondary">
                        <i class="fas fa-user-plus"></i> Registrar Persona
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Bar -->
                <div class="filter-bar">
                    <div class="filter-group">
                        <div class="search-input">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="Buscar incidente...">
                        </div>
                    </div>
                    <div class="filter-group">
                        <select class="form-control">
                            <option value="">Filtrar por gravedad</option>
                            <option value="leve">Leve</option>
                            <option value="moderada">Moderada</option>
                            <option value="grave">Grave</option>
                            <option value="fatal">Fatal</option>
                        </select>
                        <button class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </div>

                <!-- Desktop Table View -->
                <div class="table-container d-none d-md-block">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha/Hora</th>
                                <th>Área</th>
                                <th>Tipo de Lesión</th>
                                <th>Nivel de Riesgo</th>
                                <th>Tipo de Accidente</th>
                                <th>Gravedad</th>
                                <th>Evidencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>10/05/2025</span>
                                        <small class="text-muted">09:30 AM</small>
                                    </div>
                                </td>
                                <td><span class="badge badge-physics">Física Cuántica</span></td>
                                <td>Contusión</td>
                                <td>Físico</td>
                                <td>Caída</td>
                                <td><span class="badge badge-warning">Moderada</span></td>
                                <td>
                                    <img src="/api/placeholder/60/60" alt="Evidencia" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-success btn-sm action-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm action-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>05/05/2025</span>
                                        <small class="text-muted">14:15 PM</small>
                                    </div>
                                </td>
                                <td><span class="badge badge-chemistry">Química Avanzada</span></td>
                                <td>Quemadura</td>
                                <td>Químico</td>
                                <td>Exposición</td>
                                <td><span class="badge badge-danger">Grave</span></td>
                                <td>
                                    <img src="/api/placeholder/60/60" alt="Evidencia" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-success btn-sm action-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm action-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>12/05/2025</span>
                                        <small class="text-muted">11:45 AM</small>
                                    </div>
                                </td>
                                <td><span class="badge badge-biology">Biología Molecular</span></td>
                                <td>Corte</td>
                                <td>Biológico</td>
                                <td>Manipulación</td>
                                <td><span class="badge badge-success">Leve</span></td>
                                <td>
                                    <img src="/api/placeholder/60/60" alt="Evidencia" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-success btn-sm action-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm action-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>08/05/2025</span>
                                        <small class="text-muted">16:20 PM</small>
                                    </div>
                                </td>
                                <td><span class="badge badge-engineering">Ingeniería Robótica</span></td>
                                <td>Traumatismo</td>
                                <td>Mecánico</td>
                                <td>Impacto</td>
                                <td><span class="badge badge-dark">Fatal</span></td>
                                <td>
                                    <img src="/api/placeholder/60/60" alt="Evidencia" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-success btn-sm action-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm action-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="d-md-none">
                    <div class="accident-card">
                        <div class="accident-card-header">
                            <h3 class="accident-card-title">Incidente #001</h3>
                        </div>
                        <div class="accident-card-body">
                            <div class="accident-card-item">
                                <div class="accident-card-label">Fecha/Hora:</div>
                                <div class="accident-card-value">10/05/2025 - 09:30 AM</div>
                            </div>
                            <div class="accident-card-item">
                                <div class="accident-card-label">Área:</div>
                                <div class="accident-card-value"><span class="badge badge-physics">Física Cuántica</span></div>
                            </div>
                            <div class="accident-card-item">
                                <div class="accident-card-label">Lesión:</div>
                                <div class="accident-card-value">Contusión</div>
                            </div>
                            <div class="accident-card-item">
                                <div class="accident-card-label">Riesgo:</div>
                                <div class="accident-card-value">Físico</div>
                            </div>
                            <div class="accident-card-item">
                                <div class="