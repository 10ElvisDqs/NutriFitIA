<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::all();
        return view('AINutritionSystem.equipo.index',compact('equipos'));
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
        $equipo = new Equipo();
        $equipo->nombre=$request->name;
        $equipo->save();
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
        $equipo = Equipo::find($id);
        return view('AINutritionSystem.equipo.update',compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipo = Equipo::find($id);
        $equipo->nombre=$request->name;
        $equipo->save();
        return redirect()->route('equipo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipo = Equipo::find($id);
        $equipo->delete();
        return redirect()->back();
    }
}
