<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HuertoController;
use App\Http\Controllers\AdminAuthController;

Route::redirect('/', '/principal')->name('home');

// Página principal.
Route::view('/principal', 'principal')
    ->name('principal');

// Catálogo público de huertos.
Route::get('/huertos', [HuertoController::class, 'catalogo'])
    ->name('huertos');

// Páginas existentes de Inertia.
Route::get('/administrador', function () {
    return redirect()->route('administracion');
})->middleware('auth:admin')->name('administrador');

Route::get('/contactos', function () {
    return Inertia::render('Contactos');
})->name('contactos');

// Panel con acceso mediante inicio de sesión.
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// Administración de huertos.
Route::prefix('administracion')
    ->middleware(['auth:admin', 'can:consultar'])
    ->group(function () {

        // Panel administrativo.
        Route::view('/', 'administracion.index')
            ->name('administracion');

        // Listado de huertos.
        Route::get('/huertos', [HuertoController::class, 'index'])
            ->name('admin.huertos.index');

        // Formulario para crear.
        Route::get('/huertos/nuevo', [HuertoController::class, 'create'])
            ->middleware('can:crear')
            ->name('admin.huertos.nuevo');

        // Consulta de registros eliminados.
        Route::get('/huertos/papelera', [HuertoController::class, 'papelera'])
            ->name('admin.huertos.papelera');

        // Guardar un nuevo huerto.
        Route::post('/huertos', [HuertoController::class, 'store'])
            ->middleware('can:crear')
            ->name('admin.huertos.store');

        // Formulario para editar.
        Route::get('/huertos/{huerto}/editar', [HuertoController::class, 'edit'])
            ->middleware('can:editar')
            ->name('admin.huertos.editar');

        // Guardar cambios.
        Route::put('/huertos/{huerto}', [HuertoController::class, 'update'])
            ->middleware('can:editar')
            ->name('admin.huertos.update');

        // Restaurar un registro.
        Route::patch(
            '/huertos/{huerto}/restaurar',
            [HuertoController::class, 'restaurar']
        )
            ->middleware('can:restaurar')
            ->name('admin.huertos.restaurar');

        // Eliminar definitivamente.
        Route::delete(
            '/huertos/{huerto}/definitivo',
            [HuertoController::class, 'eliminarDefinitivamente']
        )
            ->middleware('can:eliminar-definitivamente')
            ->name('admin.huertos.definitivo');

        // Borrado lógico.
        Route::delete('/huertos/{huerto}', [HuertoController::class, 'destroy'])
            ->middleware('can:eliminar')
            ->name('admin.huertos.destroy');

        // Consulta individual.
        Route::get('/huertos/{huerto}', [HuertoController::class, 'show'])
            ->name('admin.huertos.show');
    });

    // Mostrar el formulario administrativo.
Route::get('/administracion/login', [AdminAuthController::class, 'create'])
    ->name('admin.login');

        // Procesar las credenciales.
    Route::post('/administracion/login', [AdminAuthController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('admin.login.store');

    // Cerrar la sesión administrativa.
    Route::post('/administracion/logout', [AdminAuthController::class, 'destroy'])
        ->middleware('auth:admin')
        ->name('admin.logout');

// Rutas de configuración y autenticación.
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
