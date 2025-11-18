<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-gradient-to-br from-blue-50 via-white to-blue-100">
        <!-- Decorative background elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <!-- Logo and branding -->
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-3 font-medium group" wire:navigate>
                    <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                        <x-app-logo-icon class="size-10 fill-current text-white" />
                    </span>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-700 to-blue-900 bg-clip-text text-transparent">
                        {{ config('app.name', 'RH Módulo') }}
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <!-- Main content card -->
                <div class="relative">
                    <!-- Card glow effect -->
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-blue-400 rounded-2xl blur opacity-20"></div>

                    <div class="relative rounded-2xl border border-blue-100 bg-white shadow-xl backdrop-blur-sm">
                        <div class="px-8 py-10 md:px-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center text-sm text-blue-900/60">
                    <p>&copy; {{ date('Y') }} Sistema de Recursos Humanos</p>
                </div>
            </div>
        </div>

        <!-- Custom animations -->
        <style>
            @keyframes blob {
                0%, 100% { transform: translate(0, 0) scale(1); }
                25% { transform: translate(20px, -20px) scale(1.1); }
                50% { transform: translate(-20px, 20px) scale(0.9); }
                75% { transform: translate(20px, 20px) scale(1.05); }
            }
            .animate-blob {
                animation: blob 10s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>

        @fluxScripts
    </body>
</html>
