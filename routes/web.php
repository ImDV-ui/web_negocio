<?php

use App\Http\Controllers\PaginaController;
use Illuminate\Support\Facades\Route;

// Rutas principales del sitio web de negocio
Route::get('/', [PaginaController::class, 'inicio'])->name('inicio');
Route::get('/catalogo', [PaginaController::class, 'catalogo'])->name('catalogo');
Route::get('/contacto', [PaginaController::class, 'contacto'])->name('contacto');
