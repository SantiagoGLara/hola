# Sistema de Roles y Middlewares - Guía de Uso

## Estructura implementada

### 1. Roles de Usuario
- **rh_admin**: Usuario de Recursos Humanos con permisos completos (asignado automáticamente al registrarse)
- **empleado**: Personal registrado por RH con acceso limitado (asignado manualmente al crear empleados)

### 2. Modelos Creados

#### User (app/Models/User.php)
- Campo `role`: Define si es 'rh_admin' o 'empleado'
- Relación 1:1 con `Personal`
- Métodos helper:
  - `isRhAdmin()`: Verifica si es admin RH
  - `isEmpleado()`: Verifica si es empleado
  - `getTipoPersonal()`: Obtiene el tipo de personal
  - `hasTipoPersonal($tipoId)`: Verifica tipo específico

#### Personal (app/Models/Personal.php)
- Tabla: `personal`
- Primary Key: `id_personal`
- Relaciones:
  - `user()`: Relación con User
  - `tipoPersonal()`: Relación con TipoPersonal
- Scopes:
  - `activo()`: Solo personal activo
  - `porTipo($tipoId)`: Filtrar por tipo

#### TipoPersonal (app/Models/TipoPersonal.php)
- Tabla: `tipo_personal`
- Primary Key: `id_tipo_personal`
- Relaciones:
  - `personal()`: Todos los empleados de este tipo
  - `personalActivo()`: Solo empleados activos

### 3. Middlewares

#### CheckRole
Verifica que el usuario tenga un rol específico.

**Uso en rutas:**
```php
// Solo RH Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:rh_admin']);

// Solo Empleados
Route::get('/empleado/perfil', function () {
    return view('empleado.perfil');
})->middleware(['auth', 'role:empleado']);
```

**Uso en grupos:**
```php
Route::middleware(['auth', 'role:rh_admin'])->group(function () {
    Route::get('/admin/personal', [PersonalController::class, 'index']);
    Route::post('/admin/personal/crear', [PersonalController::class, 'store']);
    Route::get('/admin/reportes', [ReporteController::class, 'index']);
});
```

#### CheckTipoPersonal
Verifica que el empleado tenga un tipo de personal específico.

**Uso básico (cualquier empleado):**
```php
Route::get('/empleado/horario', function () {
    return view('empleado.horario');
})->middleware(['auth', 'tipo.personal']);
```

**Uso con tipos específicos:**
```php
// Solo tipo_personal con ID 1
Route::get('/docente/clases', function () {
    return view('docente.clases');
})->middleware(['auth', 'tipo.personal:1']);

// Múltiples tipos permitidos (ID 1 o 2)
Route::get('/academico/recursos', function () {
    return view('academico.recursos');
})->middleware(['auth', 'tipo.personal:1,2']);
```

**Grupos con tipo específico:**
```php
Route::middleware(['auth', 'tipo.personal:3'])->group(function () {
    Route::get('/administrativo/documentos', [DocumentoController::class, 'index']);
    Route::get('/administrativo/tramites', [TramiteController::class, 'index']);
});
```

## Ejemplos de Uso

### Registro Público (Automáticamente RH Admin)
Cuando un usuario se registra a través del formulario de registro público, **automáticamente** se le asigna el rol `rh_admin`.

Esto está configurado en:
- `app/Actions/Fortify/CreateNewUser.php` - Asigna `role => 'rh_admin'`
- La migración tiene como default `rh_admin`

**No necesitas hacer nada especial**, solo usa el formulario de registro normal y el usuario será RH Admin.

### Crear un usuario RH Admin manualmente (si es necesario)
```php
use App\Models\User;

$user = User::create([
    'name' => 'Admin RH',
    'email' => 'admin@rh.com',
    'password' => bcrypt('password'),
    'role' => 'rh_admin', // Opcional, es el default
]);
```

### Registrar un empleado (hecho por RH Admin)
```php

use App\Models\User;
use App\Models\Personal;

// Crear usuario
$user = User::create([
    'name' => 'Juan Pérez',
    'email' => 'juan@empresa.com',
    'password' => bcrypt('temporal123'),
    'role' => 'empleado',
]);

// Crear registro de personal
Personal::create([
    'user_id' => $user->id,
    'nombre' => 'Juan Pérez',
    'tipo_personal' => 1, // ID del tipo de personal
    'nivel_academico' => 'Licenciatura',
    'antiguedad' => 0,
    'estado' => 'activo',
    'forma_pago' => 'Transferencia',
    'jornada_laboral' => 'Tiempo completo',
    'fecha_ingreso' => now(),
]);
```

### Verificar rol en controladores
```php
public function index()
{
    $user = auth()->user();

    if ($user->isRhAdmin()) {
        // Mostrar vista de admin
        return view('admin.dashboard');
    }

    if ($user->isEmpleado()) {
        // Mostrar vista de empleado
        return view('empleado.dashboard');
    }
}
```

### Obtener tipo de personal
```php
$user = auth()->user();

if ($user->isEmpleado()) {
    $tipoPersonal = $user->getTipoPersonal();

    if ($tipoPersonal) {
        echo "Tipo: " . $tipoPersonal->nombre_tipo;
    }

    // O verificar un tipo específico
    if ($user->hasTipoPersonal(1)) {
        // Este usuario es del tipo 1
    }
}
```

### Consultas con relaciones
```php
// Obtener todos los empleados con su tipo
$empleados = Personal::with(['user', 'tipoPersonal'])
    ->activo()
    ->get();

// Obtener empleados de un tipo específico
$docentes = Personal::with('user')
    ->porTipo(1)
    ->activo()
    ->get();

// Obtener todos los empleados de un tipo desde TipoPersonal
$tipo = TipoPersonal::find(1);
$empleadosActivos = $tipo->personalActivo;
```

## Protección de Rutas - Ejemplo Completo

```php
// routes/web.php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PersonalController;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación (Fortify/Jetstream)
// Ya están configuradas automáticamente

// Rutas solo para RH Admin
Route::middleware(['auth', 'role:rh_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Gestión de personal
    Route::resource('personal', PersonalController::class);

    // Reportes
    Route::get('/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');
    Route::get('/nomina', [AdminController::class, 'nomina'])->name('admin.nomina');
});

// Rutas para todos los empleados
Route::middleware(['auth', 'tipo.personal'])->prefix('empleado')->group(function () {
    Route::get('/dashboard', [EmpleadoController::class, 'dashboard'])->name('empleado.dashboard');
    Route::get('/perfil', [EmpleadoController::class, 'perfil'])->name('empleado.perfil');
    Route::get('/horario', [EmpleadoController::class, 'horario'])->name('empleado.horario');
});

// Rutas solo para tipo de personal específico (ejemplo: tipo 1 = Docente)
Route::middleware(['auth', 'tipo.personal:1'])->prefix('docente')->group(function () {
    Route::get('/clases', [EmpleadoController::class, 'clases'])->name('docente.clases');
    Route::get('/calificaciones', [EmpleadoController::class, 'calificaciones'])->name('docente.calificaciones');
});

// Rutas para múltiples tipos (ejemplo: tipo 1 y 2)
Route::middleware(['auth', 'tipo.personal:1,2'])->prefix('academico')->group(function () {
    Route::get('/recursos', [EmpleadoController::class, 'recursos'])->name('academico.recursos');
});
```

## Redirección después del login

Puedes personalizar la redirección en `app/Providers/FortifyServiceProvider.php`:

```php
use Laravel\Fortify\Fortify;

public function boot(): void
{
    Fortify::loginView(function () {
        return view('auth.login');
    });

    // Personalizar redirección después del login
    Fortify::redirects('login', function () {
        $user = auth()->user();

        if ($user->isRhAdmin()) {
            return route('admin.dashboard');
        }

        if ($user->isEmpleado()) {
            return route('empleado.dashboard');
        }

        return '/';
    });
}
```

## Notas Importantes

1. **Migración ejecutada**: El campo `role` ya fue agregado a la tabla `users`
2. **Middlewares registrados**: Ya están disponibles como `role` y `tipo.personal`
3. **Relaciones configuradas**: Los modelos ya tienen las relaciones definidas
4. **Default role**: El campo `role` tiene como default `rh_admin`
5. **Registro automático**: Los usuarios que se registran públicamente son automáticamente `rh_admin`
6. **Empleados creados por RH**: Solo RH puede crear usuarios con rol `empleado`

## Próximos pasos recomendados

1. Crear controladores para admin y empleado
2. Crear vistas separadas para cada rol
3. Implementar formulario para que RH registre empleados
4. Personalizar redirección post-login
5. Agregar validaciones en formularios
6. Crear seeders para tipos de personal
