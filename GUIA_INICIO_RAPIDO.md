# 🚀 Guía de Inicio Rápido - Sistema RH

## ¿Qué se implementó?

✅ Sistema completo de roles (RH Admin + Empleado)
✅ Dashboard personalizado para cada rol
✅ CRUD completo de gestión de personal
✅ Middlewares de autorización
✅ Redirección automática post-login
✅ Menú dinámico según rol
✅ 7 vistas completamente funcionales

---

## Cómo Empezar a Usar el Sistema

### 1. Crear Primer Usuario RH Admin

**Opción A: Registro Web (Recomendado)**
1. Inicia tu servidor: `php artisan serve`
2. Ve a: `http://localhost:8000/register`
3. Completa el formulario de registro
4. **Automáticamente serás RH Admin** ✅
5. Serás redirigido a `/admin/dashboard`

**Opción B: Desde Tinker**
```bash
php artisan tinker

use App\Models\User;

User::create([
    'name' => 'Admin RH',
    'email' => 'admin@rh.com',
    'password' => bcrypt('password123'),
    'role' => 'rh_admin'
]);
```

### 2. Crear Tipos de Personal (Importante)

Antes de crear empleados, necesitas crear los tipos de personal:

```bash
php artisan tinker

use App\Models\TipoPersonal;

// Ejemplo: Tipos comunes
TipoPersonal::create(['nombre_tipo' => 'Docente']);
TipoPersonal::create(['nombre_tipo' => 'Administrativo']);
TipoPersonal::create(['nombre_tipo' => 'Directivo']);
TipoPersonal::create(['nombre_tipo' => 'Personal de Apoyo']);
```

O crear un seeder (recomendado para producción):

```bash
php artisan make:seeder TipoPersonalSeeder
```

Edita `database/seeders/TipoPersonalSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\TipoPersonal;
use Illuminate\Database\Seeder;

class TipoPersonalSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            [
                'nombre_tipo' => 'Docente',
                'caracteristicas_especiales' => [
                    'puede_calificar' => true,
                    'tiene_grupos' => true
                ]
            ],
            [
                'nombre_tipo' => 'Administrativo',
                'caracteristicas_especiales' => [
                    'acceso_oficina' => true
                ]
            ],
            [
                'nombre_tipo' => 'Directivo',
                'caracteristicas_especiales' => [
                    'nivel_autorizacion' => 'alto'
                ]
            ],
            [
                'nombre_tipo' => 'Personal de Apoyo',
                'caracteristicas_especiales' => []
            ],
        ];

        foreach ($tipos as $tipo) {
            TipoPersonal::create($tipo);
        }
    }
}
```

Ejecutar el seeder:
```bash
php artisan db:seed --class=TipoPersonalSeeder
```

### 3. Registrar Tu Primer Empleado

1. Inicia sesión como RH Admin
2. Ve a `/admin/dashboard`
3. Click en "Registrar Nuevo Empleado"
4. Completa el formulario:
   - **Información de Cuenta:**
     - Nombre: Juan Pérez
     - Email: juan@empresa.com
     - Contraseña: password123
     - Confirmar contraseña: password123
   - **Información Laboral:**
     - Tipo de Personal: Docente (selecciona uno)
     - Nivel Académico: Licenciatura
     - Antigüedad: 0
     - Forma de Pago: Transferencia
     - Jornada: Tiempo completo
     - Fecha de Ingreso: (fecha actual)
5. Click "Registrar Empleado"
6. Serás redirigido a la lista de personal

### 4. Probar Login como Empleado

1. Cierra sesión (botón "Log Out" en el menú)
2. Inicia sesión con las credenciales del empleado:
   - Email: juan@empresa.com
   - Password: password123
3. Serás redirigido a `/empleado/dashboard`
4. Observa el menú lateral - ahora muestra "Mi Espacio" en lugar de "Administración RH"

---

## Flujo de Trabajo Típico

### Como RH Admin

1. **Dashboard** (`/admin/dashboard`)
   - Ver estadísticas generales
   - Empleados recientes
   - Distribución por tipo

2. **Gestión de Personal** (`/admin/personal`)
   - Ver lista completa
   - Crear nuevo empleado
   - Editar empleado existente
   - Ver detalles
   - Eliminar empleado

### Como Empleado

1. **Mi Dashboard** (`/empleado/dashboard`)
   - Ver información personal
   - Ver información laboral
   - Resumen mensual

2. **Mi Perfil** (`/empleado/perfil`)
   - Ver todos los detalles
   - Acceder a configuración de cuenta

---

## Rutas Disponibles

### Para RH Admin
```
http://localhost:8000/admin/dashboard
http://localhost:8000/admin/personal
http://localhost:8000/admin/personal/create
http://localhost:8000/admin/personal/{id}
http://localhost:8000/admin/personal/{id}/edit
```

### Para Empleados
```
http://localhost:8000/empleado/dashboard
http://localhost:8000/empleado/perfil
```

### Generales
```
http://localhost:8000/
http://localhost:8000/login
http://localhost:8000/register
http://localhost:8000/dashboard (redirección automática)
```

---

## Testing Rápido

### Verificar que todo funciona:

```bash
# 1. Ver migraciones ejecutadas
php artisan migrate:status

# 2. Verificar que existen tipos de personal
php artisan tinker
>>> \App\Models\TipoPersonal::all();

# 3. Ver usuarios registrados
>>> \App\Models\User::all();

# 4. Ver personal registrado
>>> \App\Models\Personal::with(['user', 'tipoPersonal'])->get();

# 5. Verificar middlewares registrados
php artisan route:list --columns=uri,name,middleware
```

---

## Troubleshooting

### Error: "No hay tipos de personal"
**Solución:** Crea los tipos de personal siguiendo el paso 2

### Error: "No tienes un registro de personal asignado"
**Solución:** El empleado fue creado incorrectamente. Elimínalo y créalo de nuevo desde `/admin/personal/create`

### Error 403: "No tienes permisos"
**Solución:** Estás intentando acceder a una ruta que no corresponde a tu rol
- RH Admin → Usa rutas `/admin/*`
- Empleado → Usa rutas `/empleado/*`

### No se muestra el menú lateral correctamente
**Solución:** Limpia la cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Los estilos no se ven bien
**Solución:** Compila los assets
```bash
npm run dev
# o para producción
npm run build
```

---

## Próximos Pasos Recomendados

### 1. Personalizar la Aplicación
- [ ] Cambiar el nombre de la app en `.env` (`APP_NAME`)
- [ ] Configurar el logo en `resources/views/components/app-logo.blade.php`
- [ ] Personalizar colores en `tailwind.config.js`

### 2. Agregar Más Funcionalidad
- [ ] Crear seeder para tipos de personal
- [ ] Implementar búsqueda en la lista de personal
- [ ] Agregar filtros por tipo/estado
- [ ] Implementar exportación a Excel/PDF

### 3. Seguridad
- [ ] Cambiar las contraseñas de ejemplo
- [ ] Configurar rate limiting para login
- [ ] Implementar logs de auditoría

### 4. Testing
- [ ] Crear tests para los middlewares
- [ ] Crear tests para el CRUD de personal
- [ ] Crear tests para las redirecciones

---

## Comandos Útiles

```bash
# Ver todas las rutas
php artisan route:list

# Listar middlewares
php artisan route:list --columns=uri,name,middleware

# Ver migraciones
php artisan migrate:status

# Rollback última migración
php artisan migrate:rollback

# Fresh migrate (CUIDADO: borra todo)
php artisan migrate:fresh --seed

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Crear modelo con migración y controlador
php artisan make:model NombreModelo -mc

# Crear seeder
php artisan make:seeder NombreSeeder

# Ejecutar seeder específico
php artisan db:seed --class=NombreSeeder
```

---

## Estructura de Archivos del Sistema

```
app/
├── Http/
│   ├── Controllers/
│   │   └── PersonalController.php (CRUD completo)
│   └── Middleware/
│       ├── CheckRole.php (verifica rol)
│       └── CheckTipoPersonal.php (verifica tipo)
├── Models/
│   ├── User.php (con relaciones y helpers)
│   ├── Personal.php (modelo principal)
│   └── TipoPersonal.php (catálogo)
└── Providers/
    └── FortifyServiceProvider.php (autenticación personalizada)

database/
└── migrations/
    ├── 2025_11_16_174145_add_role_to_users_table.php
    ├── 2025_11_16_174958_change_default_role_to_rh_admin_in_users_table.php
    └── 2025_11_16_173035_create_*_table.php (15 migraciones)

resources/views/
├── admin/
│   └── dashboard.blade.php
├── empleado/
│   ├── dashboard.blade.php
│   └── perfil.blade.php
├── personal/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
└── components/
    └── layouts/
        └── app/
            └── sidebar.blade.php (menú dinámico)

routes/
└── web.php (todas las rutas configuradas)
```

---

## Contacto y Documentación

📚 **Documentación adicional:**
- `SISTEMA_ROLES_GUIA.md` - Guía completa del sistema de roles
- `RESUMEN_IMPLEMENTACION.md` - Resumen técnico de la implementación
- `VISTAS_IMPLEMENTADAS.md` - Documentación de todas las vistas

---

**¡Tu sistema está listo para usar!** 🎉

Empieza registrando tu primer usuario RH Admin y comienza a gestionar tu personal.
