<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\OpenAiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    protected $openAiService;

    public function __construct(OpenAiService $openAiService)
    {
        $this->openAiService = $openAiService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Auth::user();
        // Llamar al servicio para obtener la corrección ortográfica
        // $response = $this->openAiService->checkOrthography("Escribe tu texto aquí");

        return view('AINutritionSystem.consultation.addConsultation', [
            'messages' => [
                [
                    'isGpt' => true,
                    'text' => 'message',
                    'info' => "holas"
                ]
            ],
            'isLoading' => true // Aquí puedes gestionar si está cargando o no
        ],compact('pacientes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
