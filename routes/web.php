<?php
//Jose Abian Diaz Santana
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Ruta GET que muestra el formulario de inscripcion de asistentes
// El nombre de la ruta es 'inscription.create'
// Esta ruta llama al método 'create' del controlador InscriptionController
Route::get('/inscription/create', [InscriptionController::class, 'create'])->name('inscription.create');
// Ruta POST que procesa los datos enviados desde el formulario de creación de productos
// El nombre de la ruta es 'inscription.store'
// Esta ruta llama al método 'store' del controlador InscriptionController
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');