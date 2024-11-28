<?php

namespace App\Http\Controllers;

use App\Models\tipo_ejercicio;
use Illuminate\Http\Request;

class TipoEjercicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoEjercicios = tipo_ejercicio::all();
        return view('AINutritionSystem.tipoEjercicio.index',compact('tipoEjercicios'));
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
        $tipoEjercicios = new tipo_ejercicio();
        $tipoEjercicios->nombre = $request->name;
        $tipoEjercicios->save();
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
        $tipoEjercicio = tipo_ejercicio::find($id);
        return view('AINutritionSystem.tipoEjercicio.update',compact('tipoEjercicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipoEjercicio = tipo_ejercicio::find($id);
        $tipoEjercicio->nombre=$request->name;
        $tipoEjercicio->save();
        return redirect()->route('tipoEjercicio.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipoEjercicio = tipo_ejercicio::find($id);
        $tipoEjercicio->delete();
        return redirect()->back();

    }
}
