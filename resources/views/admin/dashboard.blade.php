<x-layouts.app.sidebar title="Dashboard RH">
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Panel de Recursos Humanos</h1>

        {{-- Tarjetas de estadísticas --}}
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Empleados</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Personal::count() }}</h3>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Empleados Activos</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Personal::where('estado', 'activo')->count() }}</h3>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Tipos de Personal</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\TipoPersonal::count() }}</h3>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Nuevos Este Mes</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Personal::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count() }}</h3>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Acciones Rápidas --}}
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <a href="{{ route('personal.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Registrar Nuevo Empleado
                </a>
                <a href="{{ route('personal.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Ver Todo el Personal
                </a>
                <button class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Generar Reporte
                </button>
            </div>
        </div>

        @php
            $recentPersonal = \App\Models\Personal::with(['user', 'tipoPersonal'])->latest()->take(5)->get();
        @endphp

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900">Empleados Registrados Recientemente</h2>
                <a href="{{ route('personal.index') }}" class="text-sm text-blue-600 hover:text-blue-700">Ver todos</a>
            </div>

            @if($recentPersonal->isEmpty())
                <p class="text-center text-gray-600 py-8">No hay empleados registrados aún.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha Ingreso</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentPersonal as $p)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($p->nombre, 0, 2)) }}
                                            </div>
                                            <div class="ml-4 text-sm font-medium text-gray-900">{{ $p->nombre }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $p->user->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $p->tipoPersonal->nombre_tipo ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $p->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($p->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $p->fecha_ingreso ? $p->fecha_ingreso->format('d/m/Y') : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app.sidebar>
