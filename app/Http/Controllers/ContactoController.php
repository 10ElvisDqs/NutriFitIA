<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asunto' => 'required',
            'nombre' => 'required',
            'correo_remitente' => 'required|email',
            'correo_destino' => 'required|email',
            'mensaje' => 'required',
        ]);

        $correo = new ContactoMailable($request->all());
        Mail::to($request->correo_destino)->send($correo);
        return redirect()->route('contacto.index')->with('info', 'tu mensaje se ha enviado correctamente.');
    }
}
