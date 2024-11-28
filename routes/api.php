<?php

use Illuminate\Http\Request;
// use App\Livewire\ConsultationForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/predecir', [ConsultationController::class, 'predecir'])->name('predecir');
Route::get('/hola', [ConsultationController::class, 'hola']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
