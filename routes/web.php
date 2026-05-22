<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlquilerController; 
use App\Http\Controllers\ClienteController; 
use App\Http\Controllers\CopiaController; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController; 
use App\Http\Controllers\PeliculaController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ValoracionController; 
use Illuminate\Support\Facades\Auth;

// --- RUTAS PÚBLICAS ---
Route::get('/', [MainController::class, 'main'])->name('main');          
Route::get('about', [MainController::class, 'about'])->name('about'); 

// --- AUTENTICACIÓN ---
Auth::routes(['verify' => true]);

// --- RUTAS PROTEGIDAS (Solo usuarios registrados y verificados) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Perfil de usuario
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/edit', [HomeController::class, 'edit'])->name('home.edit');
    Route::put('/home', [HomeController::class, 'update'])->name('home.update');
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Valoraciones (Cualquier usuario verificado puede comentar)
    Route::post('valoracion', [ValoracionController::class, 'store'])->name('valoracion.store');
    Route::get('valoracion/{valoracion}/edit', [ValoracionController::class, 'edit'])->name('valoracion.edit');
    Route::put('valoracion/{valoracion}', [ValoracionController::class, 'update'])->name('valoracion.update');

    // Rutas de lectura para todos los usuarios registrados
    Route::get('pelicula', [PeliculaController::class, 'index'])->name('pelicula.index');
    Route::get('pelicula/{pelicula}', [PeliculaController::class, 'show'])->name('pelicula.show');
    Route::get('copia', [CopiaController::class, 'index'])->name('copia.index');
    Route::get('copia/{copia}', [CopiaController::class, 'show'])->name('copia.show');
    Route::get('cliente', [ClienteController::class, 'index'])->name('cliente.index');
    Route::get('cliente/{cliente}', [ClienteController::class, 'show'])->name('cliente.show');
    Route::get('alquiler', [AlquilerController::class, 'index'])->name('alquiler.index');

    // --- RUTAS ADMINISTRATIVAS (Solo ADMIN) ---
    Route::middleware(['role:admin'])->group(function () {
        
        // Películas Admin
        Route::resource('pelicula', PeliculaController::class)->except(['index', 'show']);
        
        // Copias Admin
        Route::resource('copia', CopiaController::class)->except(['index', 'show']);
        
        // Clientes Admin
        Route::resource('cliente', ClienteController::class)->except(['index', 'show']);
        
        // Alquileres Admin
        Route::resource('alquiler', AlquilerController::class)->except(['index']);
    });
});