<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
Use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para obtener los métodos de ProductosController
Route::resource('productos', ProductosController::class);

// Ruta para obtener la información de un solo producto
Route::get('/productos/{id}/edit', [
    ProductosController::class, 'edit'
])->name('productos.edit');

// Ruta para actualizar el producto
Route::put('/productos/{id}', [
    ProductosController::class, 'update'
])->name('productos.update');

// Ruta para mostrar el formulario de registro
Route::get('/registro', [
    AuthController::class, 'registerForm'
])->name('registro');

// Ruta para manejar el registro del usuario
Route::post('/registro', [
    AuthController::class, 'register'
])->name('registro.store');


// Ruta para mostrar el formulario de inicio de sesión
Route::get('/acceso', [
    AuthController::class, 'loginForm'
])->name('acceso');

// Ruta para verificar el inicio de sesión
Route::post('/acceso', [
    AuthController::class, 'login'
])->name('acceso.store');

// Ruta para cerrar sesión
Route::post('/cerrar', [
    AuthController::class, 'logout'
])->name('cerrar'); 

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', [
        AuthController::class, 'adminDashboard'
    ])->name('admin-dashboard');
});

