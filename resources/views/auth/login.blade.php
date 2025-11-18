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

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" />

        <!-- Session Status -->
        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" value="{{ __('Correo electrónico') }}" class="text-gray-700 font-medium" />
                <x-input id="email" class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tu.correo@empresa.com" />
            </div>

            <!-- Password -->
            <div>
                <x-label for="password" value="{{ __('Contraseña') }}" class="text-gray-700 font-medium" />
                <x-input id="password" class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="password" name="password" required autocomplete="current-password" placeholder="{{ __('Ingresa tu contraseña') }}" />

                @if (Route::has('password.request'))
                    <div class="text-right mt-2">
                        <a class="text-sm text-blue-600 hover:text-blue-800 font-medium" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="block">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Mantener sesión iniciada') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end pt-2">
                <x-button class="w-full justify-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                    {{ __('Iniciar sesión') }}
                </x-button>
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
                <a class="text-blue-600 hover:text-blue-800 font-semibold ml-1" href="{{ route('register') }}">
                    {{ __('Regístrate aquí') }}
                </a>
            </div>
        @endif
    </div>
</x-layouts.auth>
