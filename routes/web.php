<?php

use App\Http\Controllers\Auth\DemoLoginController;
use Illuminate\Support\Facades\Route;

/*
 * Each operational screen has a real Laravel route.  They share the demo
 * shell, while the Blade view receives the screen it should render first.
 */
Route::get('/login', [DemoLoginController::class, 'create'])->name('login');
Route::post('/login', [DemoLoginController::class, 'store'])->name('login.store');
Route::post('/salir', [DemoLoginController::class, 'destroy'])->name('logout');

Route::middleware('demo.access')->group(function (): void {
    Route::view('/', 'demo', ['view' => 'home'])->name('dashboard');
    Route::view('/solicitudes', 'demo', ['view' => 'requests'])->name('requests.index');
    Route::view('/solicitudes/nueva', 'demo', ['view' => 'form'])->name('requests.create');
    Route::view('/cajas', 'demo', ['view' => 'boxes'])->name('boxes.index');
    Route::view('/arrendatarios', 'demo', ['view' => 'tenants'])->name('tenants.index');
    Route::view('/arrendatarios/ficha', 'demo', ['view' => 'tenant'])->name('tenants.show');
    Route::view('/contratos', 'demo', ['view' => 'contracts'])->name('contracts.index');
    Route::view('/contratos/nuevo', 'demo', ['view' => 'contract'])->name('contracts.create');
    Route::view('/renovaciones', 'demo', ['view' => 'renewals'])->name('renewals.index');
    Route::view('/cancelaciones', 'demo', ['view' => 'cancellations'])->name('cancellations.index');
    Route::view('/accesos', 'demo', ['view' => 'access'])->name('access.index');
    Route::view('/documentos', 'demo', ['view' => 'documents'])->name('documents.index');
    Route::view('/reportes', 'demo', ['view' => 'reports'])->name('reports.index');
    Route::view('/finanzas', 'demo', ['view' => 'finance'])->name('finance.index');
    Route::view('/configuracion', 'demo', ['view' => 'settings'])->name('settings.index');
    Route::view('/usuarios', 'demo', ['view' => 'users'])->name('users.index');
});
