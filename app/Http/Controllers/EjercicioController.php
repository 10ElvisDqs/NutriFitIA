<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\EjercicioMusculo;
use App\Models\tipo_ejercicio;
use Illuminate\Http\Request;

class EjercicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ejercicios = Ejercicio::all();
        $tiposEjercicios = tipo_ejercicio::all();
        return view('AINutritionSystem.ejercicio.index',compact('ejercicios','tiposEjercicios'));
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
        $ejercicios = new Ejercicio();
        $ejercicios->nombre = $request->name;
        $ejercicios->descripcion = $request->description;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath = 'img/Ejercicios/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('image')->move($destinationPath,$filename);
            $ejercicios->videoPath = $destinationPath . $filename;
        }
        $ejercicios->dificultad = $request->dificultad;
        $ejercicios->tipoEjercicioId = $request->tipoEjercicio;
        $ejercicios->save();

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
        $tiposEjercicios = tipo_ejercicio::all();
        $ejercicio = Ejercicio::find($id);
        return view('AINutritionSystem.ejercicio.update',compact('ejercicio','tiposEjercicios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ejercicio = Ejercicio::find($id);
        $ejercicio->nombre = $request->name;
        $ejercicio->descripcion = $request->description;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath = 'img/Ejercicios/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('image')->move($destinationPath,$filename);
            $ejercicio->videoPath = $destinationPath . $filename;
        }
        $ejercicio->dificultad = $request->dificultad;
        $ejercicio->tipoEjercicioId = $request->tipoEjercicio;
        $ejercicio->save();

        return redirect()->route('ejercicio.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ejercicio = Ejercicio::find($id);
        $ejercicio->delete();
    }
}
