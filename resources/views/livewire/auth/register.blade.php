<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <!-- Header with icon -->
        <div class="text-center space-y-2">
            <div class="flex justify-center mb-3">
                <div class="p-3 bg-blue-50 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-blue-900">{{ __('Crear cuenta') }}</h1>
            <p class="text-sm text-gray-600">{{ __('Completa los datos para registrarte en el sistema') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nombre completo')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Ingresa tu nombre completo')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autocomplete="email"
                placeholder="tu.correo@empresa.com"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Crea una contraseña segura')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirmar contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Repite tu contraseña')"
                viewable
            />

            <!-- Terms and conditions note -->
            <div class="text-xs text-gray-500 bg-blue-50 p-3 rounded-lg border border-blue-100">
                <p>{{ __('Al registrarte, aceptas los términos y condiciones del sistema de Recursos Humanos.') }}</p>
            </div>

            <div class="flex items-center justify-end pt-2">
                <flux:button type="submit" variant="primary" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                    {{ __('Crear cuenta') }}
                </flux:button>
            </div>
        </form>

        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">o</span>
            </div>
        </div>

        <div class="text-center text-sm text-gray-600">
            <span>{{ __('¿Ya tienes una cuenta?') }}</span>
            <flux:link class="text-blue-600 hover:text-blue-800 font-semibold ml-1" :href="route('login')" wire:navigate>
                {{ __('Inicia sesión') }}
            </flux:link>
        </div>
    </div>
</x-layouts.auth>
