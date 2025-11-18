<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white">
        <header class="border-b border-gray-200 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <!-- Mobile menu button -->
                    <button type="button" id="mobile-menu-toggle" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-app-logo />
                    </a>

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex space-x-4">
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-700 border-b-2 border-blue-700' : 'text-gray-700 hover:text-gray-900' }}">
                            Dashboard
                        </a>
                    </nav>

                    <div class="flex-1"></div>

                    <!-- User Menu -->
                    <div class="relative">
                        <button type="button" id="user-menu-button" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                            <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold text-sm">
                                {{ auth()->user()->initials() }}
                            </div>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="user-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-50">
                            <div class="p-3 border-b border-gray-200">
                                <div class="flex items-center space-x-2">
                                    <div class="h-8 w-8 rounded-lg bg-blue-500 flex items-center justify-center text-white font-semibold text-sm">
                                        {{ auth()->user()->initials() }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Configuración
                                </a>
                            </div>
                            <div class="py-1 border-t border-gray-200">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Sidebar (hidden by default) -->
        <div id="mobile-sidebar" class="hidden lg:hidden fixed inset-0 z-50 bg-white">
            <div class="flex flex-col h-full">
                <!-- Header -->
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                    <x-app-logo />
                    <button type="button" id="mobile-sidebar-close" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Platform
                    </h3>
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        Dashboard
                    </a>
                </nav>
            </div>
        </div>

        {{ $slot }}

        <!-- Scripts -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // User menu dropdown
                const userMenuButton = document.getElementById('user-menu-button');
                const userMenu = document.getElementById('user-menu');

                if (userMenuButton && userMenu) {
                    userMenuButton.addEventListener('click', function(e) {
                        e.stopPropagation();
                        userMenu.classList.toggle('hidden');
                    });

                    document.addEventListener('click', function() {
                        userMenu.classList.add('hidden');
                    });

                    userMenu.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                }

                // Mobile sidebar
                const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
                const mobileSidebar = document.getElementById('mobile-sidebar');
                const mobileSidebarClose = document.getElementById('mobile-sidebar-close');

                if (mobileMenuToggle && mobileSidebar && mobileSidebarClose) {
                    mobileMenuToggle.addEventListener('click', function() {
                        mobileSidebar.classList.remove('hidden');
                    });

                    mobileSidebarClose.addEventListener('click', function() {
                        mobileSidebar.classList.add('hidden');
                    });
                }
            });
        </script>
    </body>
</html>
