<?php

namespace App\Http\Controllers;

use App\Models\Muscle;
use Illuminate\Http\Request;

class MuscleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $muscles = Muscle::all();
        return view('AINutritionSystem.muscle.muscle',compact('muscles'));
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
        $muscle = new Muscle();

        //ver si viene la imagen
        //dd($request->hasFile('image'));
        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath = 'img/muscles/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('image')->move($destinationPath,$filename);
            $muscle->image = $destinationPath . $filename;
        }

        $muscle->nombre = $request->name;
        $muscle->save();
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
        $muscle = Muscle::find($id);
        return view('AINutritionSystem.muscle.update',compact('muscle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $muscle = Muscle::find($id);
        $muscle->nombre = $request->name;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $destinationPath = 'img/muscles/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('image')->move($destinationPath,$filename);
            $muscle->image = $destinationPath . $filename;
        }


        $muscle->save();
       return redirect()->route('muscle.index');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $muscle = Muscle::find($id);
        if($muscle){
            $muscle->delete();
        }
        return back();

    }
}
