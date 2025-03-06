@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Dashboard de Recursos Humanos
            </h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <span class="ml-3">
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Descargar Reporte
                </button>
            </span>
        </div>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Tarjeta de Salario Actual -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary rounded-md p-3">
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Salario Actual
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    S/. 3,500.00
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-red-800">
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Horas Extras -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary rounded-md p-3">
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Horas Extras (Mes)
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    12 horas
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-red-800">
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Bonificaciones -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary rounded-md p-3">
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Bonificaciones
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    S/. 500.00
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-red-800">
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Total a Recibir -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary rounded-md p-3">
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total a Recibir
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    S/. 4,000.00
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-red-800">
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Salario Anual -->
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Historial de Salario Anual
                </h3>
            </div>
            <div class="p-6">
                <div class="h-64">
                    <!-- Gráfico de barras simple con HTML/CSS -->
                    <div class="flex h-full items-end space-x-2">
                        <?php
                        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                        $valores = [3200, 3200, 3200, 3500, 3500, 3500, 3500, 3500, 3500, 4000, 4000, 4000];
                        $max_valor = max($valores);
                        
                        foreach ($meses as $index => $mes) {
                            $altura = ($valores[$index] / $max_valor) * 100;
                            echo '<div class="flex flex-col items-center flex-1">';
                            echo '<div class="w-full bg-primary rounded-t" style="height: ' . $altura . '%"></div>';
                            echo '<div class="text-xs text-gray-500 mt-2">' . $mes . '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Desglose de Pagos -->
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Desglose de Pagos (Último Mes)
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Concepto
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Monto
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Salario Base
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Ingreso
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                S/. 3,500.00
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Horas Extras
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Ingreso
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                S/. 300.00
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Bonificación por Desempeño
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Ingreso
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                S/. 200.00
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                AFP
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Descuento
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">
                                - S/. 350.00
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Seguro de Salud
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Descuento
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">
                                - S/. 150.00
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                Total Neto
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                S/. 3,500.00
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Próximos Pagos -->
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Próximos Pagos
                </h3>
                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    Programado
                </span>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">Pago de Salario - Noviembre 2023</h4>
                        <p class="text-sm text-gray-500 mt-1">Transferencia Bancaria</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-semibold text-gray-900">S/. 3,500.00</p>
                        <p class="text-sm text-gray-500 mt-1">30 de Noviembre, 2023</p>
                    </div>
                </div>
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Gratificación - Diciembre 2023</h4>
                            <p class="text-sm text-gray-500 mt-1">Transferencia Bancaria</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-gray-900">S/. 3,500.00</p>
                            <p class="text-sm text-gray-500 mt-1">15 de Diciembre, 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection