    <?php

    use App\Http\Controllers\AssignController;
    // use App\Http\Controllers\ConsultationController;
    use App\Http\Controllers\PermissionController;
    use App\Http\Controllers\RoleController;
    use App\Livewire\ChatMessage;
    use App\Livewire\Pages\AssistantPage;
    use App\Livewire\Pages\Chat;
    use Illuminate\Support\Facades\Route;
    use App\Livewire\FormularioProgreso;
    use App\Livewire\ConsultationForm;
    use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
    use App\Http\Controllers\ConsultationController;
    use App\Http\Controllers\DietController;
    // use Illuminate\Support\Facades\Route;



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
        // Route::get('/chat/{conversation:uuid}', Chat::class)->name('chat.show');
        // Route::get('/assistant', AssistantPage::class);
        // modulo de administracon
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/roles', RoleController::class)->names('roles');
        Route::resource('/permissions', PermissionController::class)->names('permissions');
        Route::resource('/assign', AssignController::class)->names('assign');
        //modulo de consulta
        // Route::get('/hola', [ConsultationController::class, 'hola'])->name('hola');
        // Route::get('/hola', [ConsultationController::class, 'hola'])->name('hola');
        Route::post('/hola', [ConsultationController::class, 'hola'])->name('hola')->withoutMiddleware([VerifyCsrfToken::class, \Illuminate\Auth\Middleware\Authenticate::class]);

        Route::get('/recomendacionIA', [ConsultationController::class, 'recomendacionIA'])->name('recomendacionIA');
        Route::get('/generar-plan', [ConsultationController::class,'generarPlan'])->name('generarPlan');

        // Route::get('/formulario-prediccion', ConsultationForm::class)->name('formulario-prediccion');
        Route::resource('/consultation', ConsultationController::class)->names('consultation');
        Route::get('/formulario', FormularioProgreso::class)->name('formulario.inicio');

        Route::get('/diet/{id}', [DietController::class, 'getDietDetails']);


        Route::get('/diet', [DietController::class, 'index'])->name('diet');
        // Route::resource('/diet', DietController::class);

    });



    Auth::routes();

    // rutas/web.php
