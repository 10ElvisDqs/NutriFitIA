<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;
use App\Models\EjercicioMusculo;
use App\Models\Muscle;

class EjercicioMusculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ejercicios = Ejercicio::all();
        $muscles = Muscle::all();
        $ejercicioMucles = EjercicioMusculo::all();
        return view('AINutritionSystem.ejercicioMusculo.index',compact('ejercicios','muscles','ejercicioMucles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ejercicioMucles = new EjercicioMusculo();
        $ejercicioMucles->ejercicioId = $request->ejercicio;
        $ejercicioMucles->musculoId = $request->muscle;
        $ejercicioMucles->save();
        return redirect()->back();
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
        $ejercicios = Ejercicio::all();
        $muscles = Muscle::all();
        $ejercicioMuscles = EjercicioMusculo::find($id);
        return view('AINutritionSystem.ejercicioMusculo.update',compact('ejercicios','muscles','ejercicioMuscles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ejercicioMucles = EjercicioMusculo::find($id);
        $ejercicioMucles->ejercicioId = $request->ejercicio;
        $ejercicioMucles->musculoId = $request->muscle;
        $ejercicioMucles->save();
        return redirect()->route('ejercicioMuscle.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ejercicioMusculo = EjercicioMusculo::find($id);
        $ejercicioMusculo->delete();
        return redirect()->back();
    }
}
