@extends('layouts.master')

@section('content') 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAST - Sistema de Alertas de Seguridad en el Trabajo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .professional-bg {
            background: linear-gradient(to right, #f7fafc, #edf2f7);
        }
        .highlight-card {
            background: white;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.02), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
            border-radius: 0.75rem;
        }
    </style>
</head>
<body>
    <main class="professional-bg min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <div class="highlight-card overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Contenido principal -->
                    <div class="w-full lg:w-1/2 p-12 flex flex-col justify-center">
                        <div class="mb-6">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full uppercase font-bold tracking-wider">SOLUCIÓN CERTIFICADA</span>
                        </div>
                        
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-6">
                            Plataforma Integral de Gestión de Riesgos Laborales
                        </h1>
                        
                        <p class="text-lg text-gray-700 mb-8">
                            Nuestro sistema <span class="font-semibold text-blue-600">SAST Pro</span> permite la identificación, reporte y análisis de accidentes, incidentes, emergencias y actos inseguros con tecnología de última generación.
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                            <div class="flex items-start">
                                <div class="bg-blue-50 p-2 rounded-lg mr-4">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Reporte de Accidentes</h3>
                                    <p class="text-gray-600 text-sm">Protocolos estandarizados para registro inmediato</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-blue-50 p-2 rounded-lg mr-4">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Gestión de Incidentes</h3>
                                    <p class="text-gray-600 text-sm">Seguimiento completo desde detección hasta solución</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-blue-50 p-2 rounded-lg mr-4">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Control de Emergencias</h3>
                                    <p class="text-gray-600 text-sm">Alertas automáticas y planes de acción</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-blue-50 p-2 rounded-lg mr-4">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Actos Inseguros</h3>
                                    <p class="text-gray-600 text-sm">Identificación proactiva de comportamientos de riesgo</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                                Solicitar Demo
                            </button>
                            <button class="px-8 py-3 border border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold rounded-lg transition duration-300">
                                Ver Casos de Éxito
                            </button>
                        </div>
                    </div>
                    
                    <!-- Panel derecho -->
                    <div class="w-full lg:w-1/2 bg-gray-50 flex items-center justify-center p-12">
                        <div class="relative w-full">
                            <div class="absolute -inset-2 bg-blue-100 rounded-xl blur opacity-75"></div>
                            <div class="relative bg-white p-6 rounded-xl border border-gray-200">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="font-bold text-gray-900">Panel de Control SAST Pro</h3>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">En tiempo real</span>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                        <div class="flex justify-between">
                                            <span class="font-medium">Reportes este mes</span>
                                            <span class="text-blue-600 font-bold">24</span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-3 gap-4 text-center">
                                        <div class="p-3 bg-red-50 rounded-lg">
                                            <div class="text-red-600 font-bold text-xl">3</div>
                                            <div class="text-xs text-gray-500">Accidentes</div>
                                        </div>
                                        <div class="p-3 bg-yellow-50 rounded-lg">
                                            <div class="text-yellow-600 font-bold text-xl">11</div>
                                            <div class="text-xs text-gray-500">Incidentes</div>
                                        </div>
                                        <div class="p-3 bg-purple-50 rounded-lg">
                                            <div class="text-purple-600 font-bold text-xl">10</div>
                                            <div class="text-xs text-gray-500">Actos inseguros</div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <div class="text-sm font-medium mb-2">Indicador de Seguridad</div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 82%"></div>
                                        </div>
                                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                                            <span>0</span>
                                            <span>50</span>
                                            <span>100</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <div class="text-xs text-gray-500">Último reporte: Caída de altura - Área de producción - Hoy 10:15 AM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500">
                <p>Sistema certificado ISO 45001 | Cumplimiento normativo legal | Reportes automatizados para autoridades</p>
            </div>
        </div>
    </main>
</body>
</html>
        @endsection