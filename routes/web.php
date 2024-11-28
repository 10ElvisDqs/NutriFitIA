    <?php

use App\Http\Controllers\AssignController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Livewire\ChatMessage;
use App\Livewire\Pages\AssistantPage;
use App\Livewire\Pages\Chat;
use Illuminate\Support\Facades\Route;
use App\Livewire\FormularioProgreso;

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
    Route::get('/chat/{conversation:uuid}', Chat::class)->name('chat.show');
    Route::get('/assistant', AssistantPage::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/roles', RoleController::class)->names('roles');
    Route::resource('/permissions', PermissionController::class)->names('permissions');
    Route::resource('/assign', AssignController::class)->names('assign');
    Route::resource('/consultation', ConsultationController::class)->names('consultation');

    Route::get('/formulario', FormularioProgreso::class)->name('formulario.inicio');
});



    Auth::routes();

    // rutas/web.php
