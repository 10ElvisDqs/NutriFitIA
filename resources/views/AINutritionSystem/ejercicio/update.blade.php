@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Equipo Management</h1>
@stop

@section('content')
    <p>Equipo Management</p>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-center">
                <form action="{{ route('ejercicio.update', $ejercicio) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <x-adminlte-input name="name" label="Name" placeholder="here your role..."
                            value="{{ $ejercicio->nombre }}" fgroup-class="" disable-feedback />
                    </div>
                    <div class="row">
                        <x-adminlte-input name="description" label="description" placeholder="here your role..."
                           value="{{$ejercicio->descripcion}}"  fgroup-class="" disable-feedback />
                    </div>
                    <div class="row">
                        <x-adminlte-input name="dificultad" label="dificultad" placeholder="here your role..."
                           value="{{$ejercicio->dificultad}}" fgroup-class="" disable-feedback />
                    </div>
                    <div class="row">
                        <x-adminlte-input-file name="image" label="image" />
                    </div>
                    <div class="row">
                        {{-- With prepend slot, label, and data-placeholder config --}}
                        <x-adminlte-select2 name="tipoEjercicio" label="Tipo Ejercicio" label-class="text-lightblue"
                            igroup-size="lg" data-placeholder="Select an option..."> <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info"> <i class="fas fa-dumbbell"></i> </div>
                            </x-slot>
                            <option />
                            @foreach ($tiposEjercicios as $tipo)
                                <option value="{{ $tipo->id }}" {{ $ejercicio->tipoEjercicioId == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                            @endforeach
                        </x-adminlte-select2>
                    </div>
                    <x-adminlte-button type="submit" label="save" theme="primary" />
                </form>
            </div>
        </div>
    @stop
    @section('js')

        <script>
            console.log("Hi, I'm using the Laravel-AdminLTE package!");
        </script>

    @stop
