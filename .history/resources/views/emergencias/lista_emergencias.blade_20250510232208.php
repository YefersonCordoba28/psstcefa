<!-- Reemplaza la tabla actual por esta versión -->
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped align-middle" id="emergenciasTable">
        <thead class="thead-dark bg-dark text-white">
            <tr>
                <th class="text-center" data-label="Identificación">ID</th>
                <th class="text-center" data-label="Fecha y hora">Fecha y hora</th>
                <th class="text-center" data-label="Área">Área</th>
                <th class="text-center" data-label="Tipo de emergencia">Tipo de emergencia</th>
                <th class="text-center" data-label="Evidencia">Evidencia</th>
                <th class="text-center" data-label="Gravedad">Gravedad</th>
                <th class="text-center" data-label="Acciones">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($emergencias as $emergencia)
                <tr class="emergencia-row" data-gravedad="{{ $emergencia->gravedad }}">
                    <td class="text-center align-middle" data-label="Identificación">{{ $emergencia->id }}</td>
                    <td class="align-middle text-center" data-label="Fecha y hora">{{ $emergencia->fecha_hora }}</td>
                    <td class="align-middle text-center" data-label="Área">{{ $emergencia->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                    <td class="align-middle text-center" data-label="Tipo de emergencia">{{ $emergencia->tipoEmergencia->nombre ?? 'N/A' }}</td>
                    <td class="align-middle text-center" data-label="Evidencia">
                        @if($emergencia->evidencia)
                            <button class="btn btn-sm btn-outline-primary preview-evidence" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#evidenceModal"
                                    data-image="{{ asset('storage/' . $emergencia->evidencia) }}">
                                <i class="fas fa-eye"></i> Ver
                            </button>
                        @else
                            <span class="text-muted">Sin evidencia</span>
                        @endif
                    </td>
                    <td class="align-middle text-center" data-label="Gravedad">
                        <span class="badge {{ $emergencia->gravedad === 'leve' ? 'bg-success' : ($emergencia->gravedad === 'moderada' ? 'bg-warning' : ($emergencia->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                            {{ ucfirst($emergencia->gravedad) }}
                        </span>
                    </td>
                    <td class="text-center align-middle" data-label="Acciones">
                        <button class="btn btn-success btn-sm editbtn"
                                data-id="{{ $emergencia->id }}"
                                data-fecha_hora="{{ $emergencia->fecha_hora }}"
                                data-area_unidad_productiva_id="{{ $emergencia->area_unidad_productiva_id }}"
                                data-tipo_emergencia_id="{{ $emergencia->tipo_emergencia_id }}"
                                data-tipo_riesgo_id="{{ $emergencia->tipo_riesgo_id }}"
                                data-descripcion="{{ $emergencia->descripcion }}"
                                data-evidencia="{{ $emergencia->evidencia }}"
                                data-gravedad="{{ $emergencia->gravedad }}"
                                data-creado_por="{{ $emergencia->creado_por }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editarModal">
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm deletebtn"
                                data-id="{{ $emergencia->id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#eliminarModal">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-3">No hay emergencias registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal para visualizar la evidencia -->
<div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="evidenceModalLabel">Evidencia de la Emergencia</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="evidenceImage" src="" class="img-fluid" alt="Evidencia" style="max-height: 70vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a id="downloadEvidence" href="#" class="btn btn-primary" download>
                    <i class="fas fa-download"></i> Descargar
                </a>
            </div>
        </div>
    </div>
</div>