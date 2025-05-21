@extends('instructor.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg bg-gradient-dark">
        <div class="card-header bg-gradient-info">
            <h3 class="card-title text-white font-weight-bold">
                <i class="fas fa-comment-medical mr-2"></i>Registrar Respuesta a Evento
            </h3>
        </div>
        
        <div class="card-body bg-dark-soft">
            <form action="{{ route('respuestas.store') }}" method="POST" id="respuestaForm" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <!-- Sección izquierda - Selección de evento -->
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="tipo_evento" class="text-white-80 font-weight-bold">
                                <i class="fas fa-tags mr-2"></i>Tipo de Evento
                            </label>
                            <select name="tipo_evento" id="tipo_evento" class="form-control select2" required onchange="mostrarEventos()">
                                <option value="">Seleccione un tipo</option>
                                <option value="accidente">Accidente</option>
                                <option value="incidente">Incidente</option>
                                <option value="emergencia">Emergencia</option>
                                <option value="acto_inseguro">Acto Inseguro</option>
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un tipo de evento</div>
                        </div>

                        <div class="form-group mb-4" id="evento_id_container" style="display: none;">
                            <label for="evento_id" class="text-white-80 font-weight-bold">
                                <i class="fas fa-calendar-alt mr-2"></i>Evento Relacionado
                            </label>
                            <select name="evento_id" id="evento_id" class="form-control select2" required onchange="mostrarDetalles()">
                                <option value="">Seleccione un evento</option>
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un evento</div>
                        </div>

                        <!-- Tarjeta de detalles del evento -->
                        <div class="card bg-dark border-info mb-4 animate__animated animate__fadeIn" id="tabla_detalles" style="display: none;">
                            <div class="card-header bg-info py-2">
                                <h5 class="card-title mb-0 text-white">
                                    <i class="fas fa-info-circle mr-2"></i>Detalles del Evento Seleccionado
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover mb-0">
                                        <tbody id="detalle_evento_body">
                                            <!-- Filas agregadas dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección derecha - Formulario de respuesta -->
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="respuesta" class="text-white-80 font-weight-bold">
                                <i class="fas fa-comment-dots mr-2"></i>Respuesta
                            </label>
                            <textarea name="respuesta" class="form-control" rows="4" placeholder="Describa la respuesta al evento..." required>{{ old('respuesta') }}</textarea>
                            <div class="invalid-feedback">Por favor proporcione una respuesta</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="acciones_tomadas" class="text-white-80 font-weight-bold">
                                <i class="fas fa-tasks mr-2"></i>Acciones Tomadas
                            </label>
                            <textarea name="acciones_tomadas" class="form-control" rows="4" placeholder="Describa las acciones tomadas...">{{ old('acciones_tomadas') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="fecha_respuesta" class="text-white-80 font-weight-bold">
                                        <i class="fas fa-calendar-day mr-2"></i>Fecha de Respuesta
                                    </label>
                                    <input type="datetime-local" name="fecha_respuesta" class="form-control" required>
                                    <div class="invalid-feedback">Por favor ingrese la fecha de respuesta</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="respondido_por" class="text-white-80 font-weight-bold">
                                        <i class="fas fa-user-tie mr-2"></i>Respondido por
                                    </label>
                                    <input type="text" name="respondido_por" class="form-control" value="{{ old('respondido_por') ?? Auth::user()->name }}" placeholder="Nombre del responsable">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-dark border-top border-info py-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('respuestas.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save mr-2"></i>Guardar Respuesta
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark border border-info">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="confirmModalLabel">Confirmar Registro</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-white">
                ¿Está seguro que desea registrar esta respuesta al evento seleccionado?
            </div>
            <div class="modal-footer border-top border-info">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-success" id="confirmSubmit">
                    <i class="fas fa-check mr-2"></i>Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<style>
    .bg-dark-soft {
        background-color: #2d3748;
    }
    .text-white-80 {
        color: rgba(255, 255, 255, 0.8);
    }
    .select2-container--default .select2-selection--single {
        background-color: #4a5568;
        border: 1px solid #4a5568;
        color: white;
    }
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: white transparent transparent transparent;
    }
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    .form-control, .select2-selection {
        background-color: #4a5568;
        color: white;
        border: 1px solid #4a5568;
    }
    .form-control:focus {
        background-color: #4a5568;
        color: white;
        border-color: #4299e1;
        box-shadow: 0 0 0 0.2rem rgba(66, 153, 225, 0.25);
    }
    textarea.form-control {
        min-height: 120px;
    }
    .table-dark {
        background-color: #2d3748;
    }
    .table-hover tbody tr:hover {
        background-color: #3c4b64;
    }
    .invalid-feedback {
        display: none;
        color: #feb2b2;
    }
    .was-validated .form-control:invalid ~ .invalid-feedback,
    .form-control.is-invalid ~ .invalid-feedback {
        display: block;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Datos de mapeo para convertir IDs a nombres
    const mapeoDatos = {
        areas_unidades: @json($areasUnidades ?? []),
        tipos_lesiones: @json($tiposLesiones ?? []),
        tipos_riesgos: @json($tiposRiesgos ?? []),
        tipos_accidentes: @json($tiposAccidentes ?? []),
        tipos_incidentes: @json($tipoIncidentes ?? []),
        tipos_emergencias: @json($tipoEmergencias ?? []),
        tipos_acto_inseguro: @json($tiposActoInseguro ?? [])
    };

    const eventos = {
        accidente: @json($accidentes ?? []),
        incidente: @json($incidentes ?? []),
        emergencia: @json($emergencias ?? []),
        acto_inseguro: @json($actos ?? [])
    };

    $(document).ready(function() {
        // Inicializar Select2
        $('.select2').select2({
            theme: 'dark',
            width: '100%'
        });

        // Validación del formulario
        $('#respuestaForm').on('submit', function(e) {
            e.preventDefault();
            
            if (this.checkValidity() === false) {
                e.stopPropagation();
                $(this).addClass('was-validated');
                return;
            }
            
            // Mostrar modal de confirmación
            $('#confirmModal').modal('show');
        });

        // Confirmar envío del formulario
        $('#confirmSubmit').click(function() {
            $('#respuestaForm').off('submit').submit();
        });

        // Establecer fecha y hora actual por defecto
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.querySelector('input[name="fecha_respuesta"]').value = now.toISOString().slice(0, 16);
    });

    function mostrarEventos() {
        const tipo = $('#tipo_evento').val();
        const select = $('#evento_id');
        const container = $('#evento_id_container');
        const tabla = $('#tabla_detalles');
        const tbody = $('#detalle_evento_body');

        select.empty().append('<option value="">Seleccione un evento</option>');
        tbody.empty();
        tabla.hide();

        if (tipo && eventos[tipo]) {
            container.slideDown();
            eventos[tipo].forEach(evento => {
                const descripcion = evento.descripcion ? evento.descripcion.slice(0, 30) + (evento.descripcion.length > 30 ? '...' : '') : 'sin descripción';
                select.append(new Option(`ID ${evento.id} - ${descripcion}`, evento.id));
            });
            select.trigger('change');
        } else {
            container.slideUp();
        }
    }

    function mostrarDetalles() {
        const tipo = $('#tipo_evento').val();
        const id = parseInt($('#evento_id').val());
        const evento = eventos[tipo]?.find(e => e.id === id);

        const tbody = $('#detalle_evento_body');
        const tabla = $('#tabla_detalles');
        tbody.empty();

        if (evento) {
            tabla.hide().removeClass('animate__fadeIn').addClass('animate__fadeIn').slideDown();

            const camposMostrar = {
                'fecha_evento': 'Fecha del Evento',
                'descripcion': 'Descripción',
                'area_unidad_productiva_id': 'Área/Unidad',
                'gravedad': 'Gravedad',
                'tipo_lesion_id': 'Tipo de Lesión',
                'tipo_riesgo_id': 'Tipo de Riesgo',
                'tipo_accidente_id': 'Tipo de Accidente',
                'tipo_incidente_id': 'Tipo de Incidente',
                'tipo_emergencia_id': 'Tipo de Emergencia',
                'tipo_acto_inseguro_id': 'Tipo de Acto Inseguro',
                'reportado_por': 'Reportado por',
                'estado': 'Estado'
            };

            for (const [key, label] of Object.entries(camposMostrar)) {
                if (evento.hasOwnProperty(key) && evento[key] !== null) {
                    const row = $('<tr>');
                    const campo = $('<th>').text(label).css('width', '30%');
                    const valor = $('<td>');

                    switch (key) {
                        case 'area_unidad_productiva_id':
                            const area = mapeoDatos.areas_unidades.find(a => a.id === evento[key]);
                            valor.text(area ? area.nombre : `ID ${evento[key]}`);
                            break;

                        case 'tipo_lesion_id':
                            const tipoLesion = mapeoDatos.tipos_lesiones.find(t => t.id === evento[key]);
                            valor.text(tipoLesion ? tipoLesion.nombre : `ID ${evento[key]}`);
                            break;

                        case 'tipo_riesgo_id':
                            const tipoRiesgo = mapeoDatos.tipos_riesgos.find(r => r.id === evento[key]);
                            valor.text(tipoRiesgo ? tipoRiesgo.nombre : `ID ${evento[key]}`);
                            break;

                        case 'tipo_accidente_id':
                            const tipoAccidente = mapeoDatos.tipos_accidentes.find(a => a.id === evento[key]);
                            valor.text(tipoAccidente ? tipoAccidente.nombre : `ID ${evento[key]}`);
                            break;

                        case 'tipo_incidente_id':
                            const tipoIncidente = mapeoDatos.tipos_incidentes.find(i => i.id === evento[key]);
                            valor.text(tipoIncidente ? tipoIncidente.nombre : `ID ${evento[key]}`);
                            break;

                        case 'tipo_emergencia_id':
                            const tipoEmergencia = mapeoDatos.tipos_emergencias.find(e => e.id === evento[key]);
                            valor.text(tipoEmergencia ? tipoEmergencia.nombre : `ID ${evento[key]}`);
                            break;

                        case 'tipo_acto_inseguro_id':
                            const tipoActoInseguro = mapeoDatos.tipos_acto_inseguro.find(a => a.id === evento[key]);
                            valor.text(tipoActoInseguro ? tipoActoInseguro.nombre : `ID ${evento[key]}`);
                            break;

                        case 'fecha_evento':
                            valor.text(new Date(evento[key]).toLocaleString());
                            break;

                        default:
                            valor.text(evento[key]);
                    }

                    row.append(campo).append(valor);
                    tbody.append(row);
                }
            }
        } else {
            tabla.slideUp();
        }
    }
</script>
@endsection