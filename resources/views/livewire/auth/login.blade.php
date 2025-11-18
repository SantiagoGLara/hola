<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <!-- Header with icon -->
        <div class="text-center space-y-2">
            <div class="flex justify-center mb-3">
                <div class="p-3 bg-blue-50 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-blue-900">{{ __('Bienvenido') }}</h1>
            <p class="text-sm text-gray-600">{{ __('Ingresa tus credenciales para acceder al sistema') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="tu.correo@empresa.com"
            />

            <!-- Password -->
            <div class="relative space-y-2">
                <flux:input
                    name="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Ingresa tu contraseña')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <div class="text-right">
                        <flux:link class="text-sm text-blue-600 hover:text-blue-800" :href="route('password.request')" wire:navigate>
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </flux:link>
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Mantener sesión iniciada')" :checked="old('remember')" />

            <div class="flex items-center justify-end pt-2">
                <flux:button variant="primary" type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200" data-test="login-button">
                    {{ __('Iniciar sesión') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">o</span>
                </div>
            </div>

            <div class="text-center text-sm text-gray-600">
                <span>{{ __('¿No tienes una cuenta?') }}</span>
                <flux:link class="text-blue-600 hover:text-blue-800 font-semibold ml-1" :href="route('register')" wire:navigate>
                    {{ __('Regístrate aquí') }}
                </flux:link>
            </div>
        @endif
    </div>
</x-layouts.auth>
