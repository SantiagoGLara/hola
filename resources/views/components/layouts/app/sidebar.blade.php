<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                <!-- Logo -->
                <div class="flex items-center h-16 px-6 border-b border-gray-200">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-app-logo />
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    @if(auth()->user()->isRhAdmin())
                    {{-- Menú para RH Admin --}}
                    <div class="mb-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Administración RH
                        </h3>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('personal.index') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('personal.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Gestión de Personal
                        </a>
                    </div>
                    @elseif(auth()->user()->isEmpleado())
                    {{-- Menú para Empleado --}}
                    <div class="mb-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Mi Espacio
                        </h3>
                        <a href="{{ route('empleado.dashboard') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('empleado.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Mi Dashboard
                        </a>
                        <a href="{{ route('empleado.perfil') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('empleado.perfil') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Mi Perfil
                        </a>
                    </div>
                    @else
                    {{-- Fallback --}}
                    <div class="mb-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Platform
                        </h3>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </div>
                    @endif
                </nav>

                <!-- User Menu (Desktop) -->
                <div class="flex-shrink-0 border-t border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                {{ auth()->user()->initials() }}
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile menu button -->
        <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between px-4 py-3">
                <button type="button" id="mobile-menu-button" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <x-app-logo />
                <div class="w-6"></div>
            </div>
        </div>

        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 z-40 bg-white">
            <div class="flex flex-col h-full">
                <!-- Close button -->
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                    <x-app-logo />
                    <button type="button" id="mobile-menu-close" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    @if(auth()->user()->isRhAdmin())
                    <div class="mb-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Administración RH
                        </h3>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('personal.index') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('personal.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Gestión de Personal
                        </a>
                    </div>
                    @elseif(auth()->user()->isEmpleado())
                    <div class="mb-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Mi Espacio
                        </h3>
                        <a href="{{ route('empleado.dashboard') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('empleado.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Mi Dashboard
                        </a>
                        <a href="{{ route('empleado.perfil') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('empleado.perfil') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Mi Perfil
                        </a>
                    </div>
                    @else
                    <div class="mb-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Platform
                        </h3>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </div>
                    @endif
                </nav>

                <!-- Mobile User Menu -->
                <div class="flex-shrink-0 border-t border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                {{ auth()->user()->initials() }}
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            Configuración
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <main class="flex-1 overflow-y-auto bg-gray-100 lg:mt-0 mt-16">
            {{ $slot }}
        </main>
    </div>

    <!-- Mobile menu toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuClose = document.getElementById('mobile-menu-close');

            if (menuButton && mobileMenu && menuClose) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.remove('hidden');
                });

                menuClose.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            }
        });
    </script>
</body>

</html>