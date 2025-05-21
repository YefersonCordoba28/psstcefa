<div class="card shadow-sm mt-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title m-0">
            <i class="fas fa-chart-line me-2"></i>Emergencias Registradas por Mes
        </h5>
        <select id="yearSelector" class="form-select form-select-sm" style="width: 120px;">
            @foreach($estadisticas['años'] as $year)
                <option value="{{ $year }}" {{ $year == $estadisticas['añoSeleccionado'] ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="card-body">
        <canvas id="emergenciasChart" height="300"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('emergenciasChart').getContext('2d');
        const estadisticas = @json($estadisticas);
        
        // Configuración de la gráfica
        const chartConfig = {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Emergencias',
                    data: estadisticas.datos[estadisticas.añoSeleccionado],
                    backgroundColor: 'rgba(58, 159, 241, 0.2)',
                    borderColor: 'rgba(58, 159, 241, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgba(58, 159, 241, 1)',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Emergencias: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        title: {
                            display: true,
                            text: 'Cantidad de Emergencias'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Meses del Año'
                        }
                    }
                }
            }
        };

        // Crear gráfica inicial
        const emergenciasChart = new Chart(ctx, chartConfig);

        // Manejar cambio de año
        document.getElementById('yearSelector').addEventListener('change', function() {
            const selectedYear = this.value;
            chartConfig.data.datasets[0].data = estadisticas.datos[selectedYear];
            emergenciasChart.update();
        });
    });
</script>
@endpush