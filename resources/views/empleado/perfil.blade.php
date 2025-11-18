<x-layouts.app.sidebar title="Mi Perfil">
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Mi Perfil</h1>

        @php
            $personal = auth()->user()->personal;
            $tipoPersonal = auth()->user()->getTipoPersonal();
        @endphp

        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Información Personal</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Nombre Completo</p>
                    <p class="font-medium text-gray-900">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Correo Electrónico</p>
                    <p class="font-medium text-gray-900">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        @if($personal)
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Información Laboral</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Tipo de Personal</p>
                        <p class="font-medium text-gray-900">{{ $tipoPersonal->nombre_tipo ?? 'No asignado' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Nivel Académico</p>
                        <p class="font-medium text-gray-900">{{ $personal->nivel_academico }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Antigüedad</p>
                        <p class="font-medium text-gray-900">{{ $personal->antiguedad ?? 0 }} años</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Estado</p>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $personal->estado === 'activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($personal->estado) }}
                        </span>
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
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <div class="text-center py-8">
                    <svg class="h-12 w-12 text-yellow-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Información no disponible</h2>
                    <p class="text-gray-600">No se encontró información de personal asociada a tu cuenta.</p>
                </div>
            </div>
        @endif

        <div class="flex gap-4">
            <a href="{{ route('empleado.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50">
                Volver al Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                Configuración de Cuenta
            </a>
        </div>
    </div>
</x-layouts.app.sidebar>
