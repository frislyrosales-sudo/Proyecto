<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PortalPacienteController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas Públicas de Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas con autenticación
Route::middleware(['auth'])->group(function () {

    // RUTAS DEL ADMINISTRADOR / MEDITURNOS (Gestión completa)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('especialidades', EspecialidadController::class);
        Route::resource('medicos', MedicoController::class);
        Route::resource('pacientes', PacienteController::class);
        Route::resource('citas', CitaController::class);
    });

    // RUTAS DEL PACIENTE (Reserva de citas y Pasarela de pago)
    Route::middleware(['role:paciente'])->group(function () {
        Route::get('/mis-citas', [PortalPacienteController::class, 'misCitas'])->name('paciente.citas.index');
        Route::get('/mis-citas/crear', [PortalPacienteController::class, 'crearCita'])->name('paciente.citas.crear');
        Route::post('/mis-citas/guardar', [PortalPacienteController::class, 'guardarCita'])->name('paciente.citas.guardar');
        Route::get('/cita/{id}/pago', [PortalPacienteController::class, 'mostrarPago'])->name('paciente.pago');
        Route::post('/cita/{id}/pago', [PortalPacienteController::class, 'procesarPago'])->name('paciente.pago.procesar');
    });

});