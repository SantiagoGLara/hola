<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Redirección inteligente del dashboard según el rol del usuario
Route::get('dashboard', function () {
    $user = auth()->user();

    if ($user->isRhAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isEmpleado()) {
        return redirect()->route('empleado.dashboard');
    }

    // Fallback por si acaso
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});


// Rutas solo para RH Admin
Route::middleware(['auth', 'role:rh_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Gestión de personal (CRUD completo)
    Route::resource('personal', \App\Http\Controllers\PersonalController::class);
});

// Rutas para todos los empleados
Route::middleware(['auth', 'tipo.personal'])->prefix('empleado')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $personal = $user->personal;
        $tipoPersonal = $user->getTipoPersonal();

        return view('empleado.dashboard', compact('personal', 'tipoPersonal'));
    })->name('empleado.dashboard');

    Route::get('/perfil', function () {
        return view('empleado.perfil');
    })->name('empleado.perfil');
});

// Ejemplo: Rutas solo para un tipo específico de personal (ej. tipo 1 = Docente)
// Route::middleware(['auth', 'tipo.personal:1'])->prefix('docente')->group(function () {
//     Route::get('/clases', function () {
//         return view('docente.clases');
//     })->name('docente.clases');
// });
