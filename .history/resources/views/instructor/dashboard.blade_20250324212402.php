<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-shield-alt"></i> <!-- Icono de escudo para SST -->
            <p>
                Reportes de SST
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('eventos.create') }}" class="nav-link">
                    <i class="fas fa-calendar-check nav-icon"></i> <!-- Eventos -->
                    <p>Registrar Evento</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('accidentes.create') }}" class="nav-link">
                    <i class="fas fa-user-injured nav-icon"></i> <!-- Accidentes -->
                    <p>Registrar Accidente</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('incidentes.create') }}" class="nav-link">
                    <i class="fas fa-exclamation-triangle nav-icon"></i> <!-- Incidentes -->
                    <p>Registrar Incidente</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('emergencias.create') }}" class="nav-link">
                    <i class="fas fa-ambulance nav-icon"></i> <!-- Emergencias -->
                    <p>Registrar Emergencia</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('inseguridades.create') }}" class="nav-link">
                    <i class="fas fa-hard-hat nav-icon"></i> <!-- Inseguridades (EPP) -->
                    <p>Registrar Inseguridad</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('eventos.index') }}" class="nav-link">
                    <i class="fas fa-clipboard-list nav-icon"></i> <!-- Listado -->
                    <p>Lista de Eventos</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-lock"></i> <!-- Seguridad -->
            <p>Roles de Seguridad</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i> <!-- Análisis -->
            <p>Análisis de Riesgos</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-map-marked-alt"></i> <!-- Mapeo -->
            <p>Geo Referencias</p>
        </a>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-contract"></i> <!-- Reportes -->
            <p>Reportes
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-clipboard-check nav-icon"></i> <!-- Actividades -->
                    <p>Actividades</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-calculator nav-icon"></i> <!-- Contabilidad -->
                    <p>Contable</p>
                </a>
            </li>
        </ul>
    </li>
</ul>