<?php

namespace App\Http\Controllers;

use App\Models\User;
// use App\Services\OpenAiService;
// use OpenAI\Laravel\Facades\OpenAI;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function generarPlan(Request $request)
    {
        // generarPlan
        $data=$request->all();
        return view('AINutritionSystem.diet.generarPlan',compact('data'));
    }
    public function recomendacionIA(Request $request)
    {
        // Aquí recibes los datos enviados
        $data = $request->all();
        // dd($data);
        // Pasa los datos a la vista
        return view('AINutritionSystem.RecomendacionIA.recomendacionIA', compact('data'));

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
