@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Respuesta a Eventos</title>
    
    <!-- Estilos externos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1e3a8a;
            --secondary: #0ea5e9;
            --accent: #4f46e5;
            --success: #059669;
            --light: #f8fafc;
            --dark: #1e293b;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f0f2f5;
            color: var(--dark);
        }
        
        .navbar-brand img {
            height: 40px;
        }
        
        .card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            border-bottom: none;
            padding: 1.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
            background-color: #f8fafc;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        
        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #1e40af;
            border-color: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline-secondary {
            border-color: #94a3b8;
            color: #64748b;
        }
        
        .btn-outline-secondary:hover {
            background-color: #f1f5f9;
            color: #334155;
        }
        
        .section-card {
            margin-bottom: 2rem;
        }
        
        .section-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border-bottom: none;
        }
        
        .theme-gradient {
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }
        
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table th {
            background-color: #f8fafc;
            font-weight: 600;
        }
        
        .info-tag {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            background-color: #dbeafe;
            color: #1e40af;
            font-size: 0.875rem;
            font-weight: 500;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .status-badge {
            border-radius: 50px;
            padding: 0.35rem 0.75rem;
            font-weight: 500;
        }
        
        /* Animaciones */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stats-card {
            border-left: 4px solid var(--accent);
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-shield-check me-2" style="font-size: 1.5rem;"></i>
                <span class="fw-bold">SAFETY MANAGEMENT SYSTEM</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-house-door me-1"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-clipboard2-pulse me-1"></i> Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-bar-chart me-1"></i> Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-gear me-1"></i> Configuración</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container py-5">
        <!-- Cabecera con información resumen -->
        <div class="row mb-4 fade-in">
            <div class="col-12">
                <h1 class="fw-bold mb-4 d-flex align-items-center">
                    <span class="theme-gradient text-white px-3 py-2 rounded-3 me-3">
                        <i class="bi bi-clipboard2-pulse"></i>
                    </span>
                    Registro de Respuesta a Evento
                </h1>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase text-muted mb-1">Eventos totales</h6>
                                <h3 class="fw-bold mb-0">245</h3>
                                <div class="mt-3">
                                    <span class="badge bg-success">+15% <i class="bi bi-arrow-up"></i></span>
                                    <small class="text-muted ms-2">vs mes anterior</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase text-muted mb-1">Tiempo de respuesta</h6>
                                <h3 class="fw-bold mb-0">4.2 hrs</h3>
                                <div class="mt-3">
                                    <span class="badge bg-danger">+0.5 hrs <i class="bi bi-arrow-up"></i></span>
                                    <small class="text-muted ms-2">vs meta</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase text-muted mb-1">Respuestas pendientes</h6>
                                <h3 class="fw-bold mb-0">12</h3>
                                <div class="mt-3">
                                    <span class="badge bg-warning">-5% <i class="bi bi-arrow-down"></i></span>
                                    <small class="text-muted ms-2">vs semana anterior</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card h-100">
                            <div class="card-body">
                                <h6 class="text-uppercase text-muted mb-1">Eficacia de respuesta</h6>
                                <h3 class="fw-bold mb-0">92%</h3>
                                <div class="mt-3">
                                    <span class="badge bg-success">+3% <i class="bi bi-arrow-up"></i></span>
                                    <small class="text-muted ms-2">vs trimestre anterior</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de respuesta -->
        <form action="#" method="POST" class="needs-validation" novalidate>
            <div class="row g-4 fade-in">
                <!-- Información del evento -->
                <div class="col-lg-6">
                    <div class="card section-card">
                        <div class="card-header section-header">
                            <h4 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-exclamation-diamond me-2"></i>
                                Información del Evento
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <label for="tipo_evento" class="form-label fw-semibold">Tipo de Evento</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-filter-square"></i>
                                        </span>
                                        <select name="tipo_evento" id="tipo_evento" class="form-select" required onchange="mostrarEventos()">
                                            <option value="">Seleccione un tipo</option>
                                            <option value="accidente">Accidente</option>
                                            <option value="incidente">Incidente</option>
                                            <option value="emergencia">Emergencia</option>
                                            <option value="acto_inseguro">Acto Inseguro</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">Por favor seleccione un tipo de evento</div>
                                </div>

                                <div class="col-md-12 mb-3" id="evento_id_container" style="display: none;">
                                    <label for="evento_id" class="form-label fw-semibold">Evento específico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-list-ul"></i>
                                        </span>
                                        <select name="evento_id" id="evento_id" class="form-select" required onchange="mostrarDetalles()">
                                            <option value="">Seleccione un evento</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">Por favor seleccione un evento</div>
                                </div>
                            </div>
                            
                            <div class="mt-3" id="resumen_evento" style="display: none;">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-info-circle me-2 text-primary"></i>
                                    <h6 class="mb-0">Resumen rápido del evento</h6>
                                </div>
                                <div class="p-3 rounded-3" style="background-color: #f0f9ff;">
                                    <div class="d-flex flex-wrap mb-2">
                                        <span class="info-tag"><i class="bi bi-calendar3 me-1"></i> <span id="fecha_evento">--/--/----</span></span>
                                        <span class="info-tag"><i class="bi bi-geo-alt me-1"></i> <span id="area_evento">---</span></span>
                                        <span class="info-tag"><i class="bi bi-person me-1"></i> <span id="reportado_por">---</span></span>
                                    </div>
                                    <div class="mt-2">
                                        <p class="mb-1 text-muted"><small>Estado actual:</small></p>
                                        <span class="status-badge bg-warning text-dark">Pendiente de respuesta</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Información de la respuesta -->
                <div class="col-lg-6">
                    <div class="card section-card">
                        <div class="card-header section-header">
                            <h4 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-reply-fill me-2"></i>
                                Información de la Respuesta
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <label for="fecha_respuesta" class="form-label fw-semibold">Fecha y Hora de Respuesta</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-calendar-event"></i>
                                        </span>
                                        <input type="datetime-local" name="fecha_respuesta" id="fecha_respuesta" class="form-control" value="2025-05-03T08:09" required>
                                    </div>
                                    <div class="invalid-feedback">Por favor ingrese la fecha de respuesta</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="respondido_por" class="form-label fw-semibold">Respondido por</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-person-badge"></i>
                                        </span>
                                        <input type="text" name="respondido_por" id="respondido_por" class="form-control" value="YEFERSON" required>
                                    </div>
                                    <div class="invalid-feedback">Por favor ingrese el nombre del responsable</div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="notificar" checked>
                                        <label class="form-check-label" for="notificar">Notificar al equipo de seguridad</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Detalles del evento -->
                <div class="col-12">
                    <div class="card section-card" id="tabla_detalles" style="display: none;">
                        <div class="card-header" style="background: linear-gradient(to right, #0ea5e9, #38bdf8); color: white;">
                            <h4 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-info-circle me-2"></i>
                                Detalles del Evento Seleccionado
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody id="detalle_evento_body">
                                        <!-- Detalles cargados dinámicamente -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Respuesta y acciones -->
                <div class="col-12">
                    <div class="card section-card">
                        <div class="card-header" style="background: linear-gradient(to right, #059669, #10b981); color: white;">
                            <h4 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-chat-square-text me-2"></i>
                                Respuesta y Acciones
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="respuesta" class="form-label fw-semibold">Descripción de la Respuesta</label>
                                        <textarea name="respuesta" id="respuesta" class="form-control" rows="5" required></textarea>
                                        <div class="invalid-feedback">Por favor describa la respuesta al evento</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="acciones_tomadas" class="form-label fw-semibold">Acciones Tomadas</label>
                                        <textarea name="acciones_tomadas" id="acciones_tomadas" class="form-control" rows="5" required></textarea>
                                        <div class="invalid-feedback">Por favor describa las acciones tomadas</div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Nivel de Efectividad</label>
                                    <div class="d-flex align-items-center mb-3">
                                        <input type="range" class="form-range" min="1" max="5" step="1" id="efectividad" value="4">
                                        <span class="ms-3 badge bg-success px-3">Efectivo</span>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Archivos de Soporte</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="bi bi-paperclip"></i>
                                            </span>
                                            <input type="file" class="form-control" id="archivos" multiple>
                                        </div>
                                        <div class="form-text">Puede adjuntar evidencias fotográficas, documentos o informes relacionados.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Botones de acción -->
            <div class="d-flex justify-content-between mt-4 fade-in">
                <button type="submit" class="btn btn-primary px-5 d-flex align-items-center">
                    <i class="bi bi-save me-2"></i>
                    <span>Guardar Respuesta</span>
                </button>
                <div>
                    <button type="button" class="btn btn-outline-primary me-2">
                        <i class="bi bi-eye"></i> Vista Previa
                    </button>
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Safety Management System</h5>
                    <p class="mb-0 text-muted">Desarrollado para mejorar la seguridad y eficiencia en la gestión de eventos.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">Enlaces Rápidos</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-muted">Documentación</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Soporte Técnico</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Políticas de Seguridad</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">Contáctenos</h6>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-envelope me-2"></i> soporte@safety.com</li>
                        <li><i class="bi bi-telephone me-2"></i> +1 (800) 555-1234</li>
                    </ul>
                </div>
            </div>
            <hr class="my-3 border-secondary">
            <div class="d-flex justify-content-between">
                <p class="mb-0 text-muted">© 2025 Safety Management System. Todos los derechos reservados.</p>
                <div>
                    <a href="#" class="text-muted me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-muted me-3"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simulación de datos
        const mapeoDatos = {
            areas_unidades: [
                {id: 1, nombre: "Producción"},
                {id: 2, nombre: "Logística"},
                {id: 3, nombre: "Administración"}
            ],
            tipos_lesiones: [
                {id: 1, nombre: "Contusión"},
                {id: 2, nombre: "Fractura"},
                {id: 3, nombre: "Quemadura"}
            ],
            tipos_riesgos: [
                {id: 1, nombre: "Físico"},
                {id: 2, nombre: "Químico"},
                {id: 3, nombre: "Ergonómico"}
            ],
            tipos_accidentes: [
                {id: 1, nombre: "Caída"},
                {id: 2, nombre: "Golpe"},
                {id: 3, nombre: "Atrapamiento"}
            ],
            tipos_incidentes: [
                {id: 1, nombre: "Derrame"},
                {id: 2, nombre: "Falla de equipo"},
                {id: 3, nombre: "Casi accidente"}
            ],
            tipos_emergencias: [
                {id: 1, nombre: "Incendio"},
                {id: 2, nombre: "Sismo"},
                {id: 3, nombre: "Inundación"}
            ],
            tipos_acto_inseguro: [
                {id: 1, nombre: "No uso de EPP"},
                {id: 2, nombre: "Procedimiento incorrecto"},
                {id: 3, nombre: "Posición insegura"}
            ]
        };

        const eventos = {
            accidente: [
                {id: 1, descripcion: "Caída de trabajador en área de carga", fecha: "2025-05-01", area_unidad_productiva_id: 2, tipo_lesion_id: 1, tipo_accidente_id: 1, reportado_por: "Carlos Mendoza", gravedad: "Media"},
                {id: 2, descripcion: "Golpe con montacargas en almacén", fecha: "2025-04-28", area_unidad_productiva_id: 2, tipo_lesion_id: 1, tipo_accidente_id: 2, reportado_por: "María Sánchez", gravedad: "Alta"}
            ],
            incidente: [
                {id: 1, descripcion: "Derrame de aceite en zona de maquinaria", fecha: "2025-05-02", area_unidad_productiva_id: 1, tipo_riesgo_id: 2, tipo_incidente_id: 1, reportado_por: "Juan Pérez", potencial_daño: "Medio"},
                {id: 2, descripcion: "Falla eléctrica en tablero principal", fecha: "2025-04-30", area_unidad_productiva_id: 1, tipo_riesgo_id: 1, tipo_incidente_id: 2, reportado_por: "Roberto Gómez", potencial_daño: "Alto"}
            ],
            emergencia: [
                {id: 1, descripcion: "Conato de incendio en cafetería", fecha: "2025-04-29", area_unidad_productiva_id: 3, tipo_emergencia_id: 1, reportado_por: "Ana Luisa Cortez", impacto: "Bajo"},
                {id: 2, descripcion: "Sismo con evacuación parcial", fecha: "2025-04-25", area_unidad_productiva_id: 3, tipo_emergencia_id: 2, reportado_por: "Sistema de Emergencias", impacto: "Medio"}
            ],
            acto_inseguro: [
                {id: 1, descripcion: "Operario sin casco en zona de construcción", fecha: "2025-05-03", area_unidad_productiva_id: 1, tipo_acto_inseguro_id: 1, reportado_por: "Supervisor López", riesgo_asociado: "Alto"},
                {id: 2, descripcion: "Uso inadecuado de herramientas de corte", fecha: "2025-05-02", area_unidad_productiva_id: 1, tipo_acto_inseguro_id: 2, reportado_por: "Jorge Salinas", riesgo_asociado: "Medio"}
            ]
        };

        // Funciones 
        function mostrarEventos() {
            const tipo = document.getElementById('tipo_evento').value;
            const select = document.getElementById('evento_id');
            const container = document.getElementById('evento_id_container');
            const tabla = document.getElementById('tabla_detalles');
            const resumen = document.getElementById('resumen_evento');
            const tbody = document.getElementById('detalle_evento_body');

            select.innerHTML = '<option value="">Seleccione un evento</option>';
            tbody.innerHTML = '';
            tabla.style.display = 'none';
            resumen.style.display = 'none';

            if (tipo && eventos[tipo]) {
                container.style.display = 'block';
                eventos[tipo].forEach(evento => {
                    const option = document.createElement('option');
                    option.value = evento.id;
                    option.text = `ID ${evento.id} - ${evento.descripcion?.slice(0, 30) ?? 'sin descripción'}`;
                    select.appendChild(option);
                });
            } else {
                container.style.display = 'none';
            }
        }

        function mostrarDetalles() {
            const tipo = document.getElementById('tipo_evento').value;
            const id = parseInt(document.getElementById('evento_id').value);
            const evento = eventos[tipo]?.find(e => e.id === id);

            const tbody = document.getElementById('detalle_evento_body');
            const tabla = document.getElementById('tabla_detalles');
            const resumen = document.getElementById('resumen_evento');
            const fechaEvento = document.getElementById('fecha_evento');
            const areaEvento = document.getElementById('area_evento');
            const reportadoEvento = document.getElementById('reportado_por');
            
            tbody.innerHTML = '';

            if (evento) {
                tabla.style.display = 'block';
                resumen.style.display = 'block';
                
                // Actualizar resumen
                fechaEvento.textContent = formatearFecha(evento.fecha);
                const area = mapeoDatos.areas_unidades.find(a => a.id === evento.area_unidad_productiva_id);
                areaEvento.textContent = area ? area.nombre : `Área ${evento.area_unidad_productiva_id}`;
                reportadoEvento.textContent = evento.reportado_por;

                // Actualizar tabla de detalles
                for (let key in evento) {
                    if (evento.hasOwnProperty(key) && key !== 'id') {
                        const row = document.createElement('tr');
                        const campo = document.createElement('th');
                        campo.textContent = formatearCampo(key);
                        const valor = document.createElement('td');

                        switch (key) {
                            case 'area_unidad_productiva_id':
                                const area = mapeoDatos.areas_unidades.find(a => a.id === evento[key]);
                                valor.textContent = area ? area.nombre : `ID ${evento[key]}`;
                                break;
                            case 'tipo_lesion_id':
                                const tipoLesion = mapeoDatos.tipos_lesiones.find(t => t.id === evento[key]);
                                valor.textContent = tipoLesion ? tipoLesion.nombre : `ID ${evento[key]}`;
                                break;
                            case 'tipo_riesgo_id':
                                const tipoRiesgo = mapeoDatos.tipos_riesgos.find(r => r.id === evento[key]);
                                valor.textContent = tipoRiesgo ? tipoRiesgo.nombre : `ID ${evento[key]}`;
                                break;
                            case 'tipo_accidente_id':
                                const tipoAccidente = mapeoDatos.tipos_accidentes.find(a => a.id === evento[key]);
                                valor.textContent = tipoAccidente ? tipoAccidente.nombre : `ID ${evento[key]}`;
                                break;
                            case 'tipo_incidente_id':
                                const tipoIncidente = mapeoDatos.tipos_incidentes.find(i => i.id === evento[key]);
                                valor.textContent = tipoIncidente ? tipoIncidente.nombre : `ID ${evento[key]}`;
                                break;
                            case 'tipo_emergencia_id':
                                const tipoEmergencia = mapeoDatos.tipos_emergencias.find(e => e.id === evento[key]);
                                valor.textContent = tipoEmergencia ? tipoEmergencia.nombre : `ID ${evento[key]}`;
                                break;
                            case 'tipo_acto_inseguro_id':
                                const tipoActoInseguro = mapeoDatos.tipos_acto_inseguro.find(a => a.id === evento[key]);
                                valor.textContent = tipoActoInseguro ? tipoActoInseguro.nombre : `ID ${evento[key]}`;
                                break;
                            case 'fecha':
                                valor.textContent = formatearFecha(evento[key]);
                                break;
                            default:
                                valor.textContent = evento[key];
                        }

                        row.appendChild(campo);
                        row.appendChild(valor);
                        tbody.appendChild(row);
                    }
                }
            } else {
                tabla.style.display = 'none';
                resumen.style.display = 'none';
            }
        }

        // Función para formatear campos
        function formatearCampo(campo) {
            return campo
                .replace(/_/g, ' ')
                .replace(/\b\w/g, l => l.toUpperCase());
        }

        // Función para formatear fechas
        function formatearFecha(fecha) {
            if (!fecha) return '--/--/----';
            const date = new Date(fecha);
            return date.toLocaleDateString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        // Actualizar etiqueta de efectividad
        document.getElementById('efectividad').addEventListener('input', function() {
            const valor = parseInt(this.value);
            const badge = this.nextElementSibling;
            
            switch(valor) {
                case 1:
                    badge.className = 'ms-3 badge bg-danger px-3';
                    badge.textContent = 'No efectivo';
                    break;
                case 2:
                    badge.className = 'ms-3 badge bg-warning text-dark px-3';
                    badge.textContent = 'Poco efectivo';
                    break;
                case 3:
                    badge.className = 'ms-3 badge bg-info text-dark px-3';
                    badge.textContent = 'Moderado';
                    break;
                case 4:
                    badge.className = 'ms-3 badge bg-success px-3';
                    badge.textContent = 'Efectivo';
                    break;
                case 5:
                    badge.className = 'ms-3 badge bg-primary px-3';
                    badge.textContent = 'Muy efectivo';
                    break;
            }
        });

        // Validación de Bootstrap
        (function () {
            'use strict'
            
            var forms = document.querySelectorAll('.needs-validation')
            
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            event.preventDefault();
                            mostrarMensajeExito();
                        }
                        
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Modal de éxito simulado
        function mostrarMensajeExito() {
            // Crear modal de forma programática
            const modalDiv = document.createElement('div');
            modalDiv.className = 'modal fade';
            modalDiv.id = 'successModal';
            modalDiv.tabIndex = '-1';
            modalDiv.setAttribute('aria-hidden', 'true');
            
            modalDiv.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title"><i class="bi bi-check-circle me-2"></i>¡Operación Exitosa!</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <div class="display-1 text-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <h4 class="mt-3">Respuesta registrada correctamente</h4>
                                <p class="text-muted">La respuesta al evento ha sido guardada en el sistema.</p>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <a href="#" class="btn btn-primary me-2">Ver Respuestas</a>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modalDiv);
            
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
            
            // Eliminar el modal del DOM después de cerrarse
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
                document.body.removeChild(modalDiv);
            });
        }
    </script>
    @en
</body>
</html>