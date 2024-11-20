
@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Equipo Management</h1>
@stop

@section('content')
    <p>Tipo Ejercicio Management</p>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-center">
                <form action="{{route('tipoEjercicio.update',$tipoEjercicio)}}" method="post" >
                    @csrf
                    @method('put')  
                    <div class="row">
                        <x-adminlte-input name="name" label="Name" placeholder="here your role..."
                         value="{{$tipoEjercicio->nombre}}"
                            fgroup-class="" disable-feedback/>
                    </div>
                    <x-adminlte-button type="submit" label="save" theme="primary"/>
                </form> 
            </div>    
    </div>
@stop
@section('js')

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

@stop
