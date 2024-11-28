<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;
use App\Models\EjercicioEquipo;
use App\Models\Equipo;

class EjercicioEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ejercicios = Ejercicio::all();
        $equipos = Equipo::all();
        $ejercicioEquipos = EjercicioEquipo::all();
        return view('AINutritionSystem.ejercicioEquipo.index',compact('ejercicios','equipos','ejercicioEquipos'));
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
        $ejercicioEquipo = new EjercicioEquipo();
        $ejercicioEquipo->ejercicioId = $request->ejercicio;
        $ejercicioEquipo->equipoId = $request->equipo;
        $ejercicioEquipo->save();
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
        $equipos = Equipo::all();
        $ejercicioEquipo = EjercicioEquipo::find($id);
        return view('AINutritionSystem.ejercicioEquipo.update',compact('ejercicios','equipos','ejercicioEquipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ejercicioEquipo = EjercicioEquipo::find($id);
        $ejercicioEquipo->ejercicioId = $request->ejercicio;
        $ejercicioEquipo->equipoId = $request->equipo;
        $ejercicioEquipo->save();
        return redirect()->route('ejercicioEquipo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ejercicioEquipo = EjercicioEquipo::find($id);
        $ejercicioEquipo->delete();
        return redirect()->back();
    }
}
