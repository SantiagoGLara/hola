<x-layouts.app.sidebar title="Mi Dashboard">
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Bienvenido, {{ auth()->user()->name }}</h1>

        <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">
            {{-- Tarjeta de Perfil --}}
            <div class="bg-white p-6 rounded-lg shadow lg:col-span-1">
                <div class="text-center">
                    <div class="mx-auto h-24 w-24 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-3xl mb-4">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $personal->nombre ?? auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-600 mb-4">{{ auth()->user()->email }}</p>

                    @if($tipoPersonal)
                        <span class="inline-block px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full mb-2">
                            {{ $tipoPersonal->nombre_tipo }}
                        </span>
                    @endif

                    @if($personal)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Estado:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $personal->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($personal->estado) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Antigüedad:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $personal->antiguedad ?? 0 }} años</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Información de Empleo --}}
            <div class="bg-white p-6 rounded-lg shadow lg:col-span-2">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Información de Empleo</h2>

                @if($personal)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Nivel Académico</p>
                            <p class="font-medium text-gray-900">{{ $personal->nivel_academico }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Forma de Pago</p>
                            <p class="font-medium text-gray-900">{{ $personal->forma_pago ?? 'No especificado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Jornada Laboral</p>
                            <p class="font-medium text-gray-900">{{ $personal->jornada_laboral ?? 'No especificado' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Fecha de Ingreso</p>
                            <p class="font-medium text-gray-900">{{ $personal->fecha_ingreso ? $personal->fecha_ingreso->format('d/m/Y') : 'No especificado' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-600">No hay información de empleo disponible.</p>
                @endif
            </div>
        </div>

        {{-- Acciones Rápidas --}}
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <a href="{{ route('empleado.perfil') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                    Ver Mi Perfil
                </a>
                <button class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">
                    Mi Horario
                </button>
                <button class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">
                    Mis Documentos
                </button>
            </div>
        </div>
    </div>
</x-layouts.app.sidebar>
