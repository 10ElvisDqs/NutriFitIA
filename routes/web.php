<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\EjercicioEquipoController;
use App\Http\Controllers\EjercicioMusculoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MuscleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\TipoEjercicioController;
use App\Livewire\ChatMessage;
use App\Livewire\Pages\AssistantPage;
use App\Livewire\Pages\Chat;
use App\Livewire\FormularioProgreso;
use App\Models\EjercicioEquipo;
use App\Models\EjercicioMusculo;




    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */
    Route::post('/consultation/submit', [ConsultationController::class, 'submitConsultation'])->name('consultation.submit');

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/chat', function () {
            $chat = auth()->user()->conversations()->create([]);

            return redirect()->route('chat.show', $chat);
        })->name('chat');
        // modulo de administracon
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/roles', RoleController::class)->names('roles');
        Route::resource('/permissions', PermissionController::class)->names('permissions');
        Route::resource('/assign', AssignController::class)->names('assign');
        Route::get('/recomendacionIA', [ConsultationController::class, 'recomendacionIA'])->name('recomendacionIA');
        Route::get('/generar-plan', [ConsultationController::class,'generarPlan'])->name('generarPlan');
        Route::resource('/consultation', ConsultationController::class)->names('consultation');
        Route::get('/formulario', FormularioProgreso::class)->name('formulario.inicio');
        Route::get('/diet/{id}', [DietController::class, 'getDietDetails']);
        Route::get('/diet', [DietController::class, 'index'])->name('diet');

        //modulo de gestion de equipo
        Route::get('/formulario', FormularioProgreso::class)->name('formulario.inicio');
        Route::resource('/muscle',MuscleController::class)->names('muscle');
        Route::resource('/equipo',EquipoController::class)->names('equipo');
        Route::resource('/tipoEjercicio',TipoEjercicioController::class)->names('tipoEjercicio');
        Route::resource('/ejercicio',EjercicioController::class)->names('ejercicio');
        Route::resource('/ejercicioMuscle',EjercicioMusculoController::class)->names('ejercicioMuscle');
        Route::resource('/ejercicioEquipo',EjercicioEquipoController::class)->names('ejercicioEquipo');
        Route::resource('/rutina',RutinaController::class)->names('rutina');
        Route::resource('/contacto',ContactoController::class)->names('contacto');

    });



    Auth::routes();

    // rutas/web.php
