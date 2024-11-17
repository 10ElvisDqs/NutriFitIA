<?php

namespace App\Http\Controllers;

use App\Services\SamAssistant\SamAssistantService;
use Illuminate\Http\Request;

class SamAssistantController extends Controller
{
    protected $samAssistantService;

    public function __construct(SamAssistantService $samAssistantService)
    {
        $this->samAssistantService = $samAssistantService;
    }

    /**
     * Crea un hilo en el asistente.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createThread()
    {
        // Llamar al servicio para crear un hilo
        // $thread = $this->samAssistantService->createThread();

        // return response()->json($thread);
        return 'createThread';
    }

    /**
     * Procesa la pregunta del usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userQuestion(Request $request)
    {
        // Validar la entrada
        $validated = $request->validate([
            'threadId' => 'required|string',
            'question' => 'required|string',
        ]);

        // Llamar al servicio para procesar la pregunta
        // $response = $this->samAssistantService->userQuestion($validated);

        return response()->json($response);
    }
}
