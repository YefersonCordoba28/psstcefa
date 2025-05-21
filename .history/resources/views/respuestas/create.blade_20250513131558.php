function mostrarDetalles() {
    const tipo = document.getElementById('tipo_evento').value;
    const id = parseInt(document.getElementById('evento_id').value);
    const evento = eventos[tipo]?.find(e => e.id === id);

    const tbody = document.getElementById('detalle_evento_body');
    const tabla = document.getElementById('tabla_detalles');
    tbody.innerHTML = '';

    if (evento) {
        tabla.style.display = 'block';

        // Mapeo de campos a mostrar con sus etiquetas
        const camposAMostrar = {
            'area_unidad_productiva_id': 'Área Unidad Productiva',
            'tipo_lesion_id': 'Tipo de Lesión', // Cambiado a tipo_lesion_id
            'tipo_identificacion_lesion_id': 'Identificación Lesión', // Alternativa
            'tipo_riesgo_id': 'Tipo de Riesgo',
            'tipo_accidente_id': 'Tipo de Accidente',
            'tipo_incidente_id': 'Tipo de Incidente',
            'tipo_emergencia_id': 'Tipo de Emergencia',
            'tipo_acto_inseguro_id': 'Tipo Acto Inseguro',
            'descripcion': 'Descripción',
            'fecha': 'Fecha',
            'hora': 'Hora'
        };

        for (let key in camposAMostrar) {
            if (evento.hasOwnProperty(key)) {
                const row = document.createElement('tr');
                const campo = document.createElement('th');
                campo.textContent = camposAMostrar[key];
                const valor = document.createElement('td');
                
                // Convertir IDs a nombres
                if (key.endsWith('_id')) {
                    const tipoMapa = key.replace('_id', 's').replace('tipo_', 'tipos_');
                    const items = mapeoDatos[tipoMapa];
                    if (items) {
                        const item = items.find(i => i.id === evento[key]);
                        valor.textContent = item ? item.nombre : `ID ${evento[key]}`;
                    } else {
                        valor.textContent = evento[key];
                    }
                } else {
                    valor.textContent = evento[key] ?? 'N/A';
                }
                
                row.appendChild(campo);
                row.appendChild(valor);
                tbody.appendChild(row);
            }
        }
    } else {
        tabla.style.display = 'none';
    }
}