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

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" value="{{ __('Nombre completo') }}" class="text-gray-700 font-medium" />
                <x-input id="name" class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Ingresa tu nombre completo') }}" />
            </div>

            <!-- Email Address -->
            <div>
                <x-label for="email" value="{{ __('Correo electrónico') }}" class="text-gray-700 font-medium" />
                <x-input id="email" class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="tu.correo@empresa.com" />
            </div>

            <!-- Password -->
            <div>
                <x-label for="password" value="{{ __('Contraseña') }}" class="text-gray-700 font-medium" />
                <x-input id="password" class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Crea una contraseña segura') }}" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" class="text-gray-700 font-medium" />
                <x-input id="password_confirmation" class="block mt-2 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Repite tu contraseña') }}" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div>
                    <x-label for="terms">
                        <div class="flex items-start">
                            <x-checkbox name="terms" id="terms" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-0.5" required />

                            <div class="ms-2 text-sm text-gray-600">
                                {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-blue-600 hover:text-blue-800 font-medium">'.__('Términos de Servicio').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-blue-600 hover:text-blue-800 font-medium">'.__('Política de Privacidad').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @else
                <!-- Terms and conditions note -->
                <div class="text-xs text-gray-500 bg-blue-50 p-3 rounded-lg border border-blue-100">
                    <p>{{ __('Al registrarte, aceptas los términos y condiciones del sistema de Recursos Humanos.') }}</p>
                </div>
            @endif

            <div class="flex items-center justify-end pt-2">
                <x-button class="w-full justify-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                    {{ __('Crear cuenta') }}
                </x-button>
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
            <a class="text-blue-600 hover:text-blue-800 font-semibold ml-1" href="{{ route('login') }}">
                {{ __('Inicia sesión') }}
            </a>
        </div>
    </div>
</x-layouts.auth>
