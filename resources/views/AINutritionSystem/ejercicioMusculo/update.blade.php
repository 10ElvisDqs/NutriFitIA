
@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Ejercicio Management</h1>
@stop

@section('content')
    <p>Ejercicio Musculo Management</p>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-center">
                <form action="{{route('ejercicioMuscle.update',$ejercicioMuscles)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')  
                    <div class="row">
                        {{-- With prepend slot, label, and data-placeholder config --}}
                            {{-- With prepend slot, label, and data-placeholder config --}}
                            <x-adminlte-select2 name="ejercicio" label="Ejercicio" label-class="text-lightblue" igroup-size="lg" data-placeholder="Select an option...">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i class="fas fa-dumbbell"></i>
                                    </div>
                                </x-slot>
                                @foreach ($ejercicios as $ejercicio)
                                    <option value="{{ $ejercicio->id }}" {{ isset($selectedEjercicio) && $selectedEjercicio->id == $ejercicio->id ? 'selected' : '' }}>
                                        {{ $ejercicio->nombre }}
                                    </option>
                                @endforeach
                            </x-adminlte-select2>
                            {{-- With prepend slot, label, and data-placeholder config --}}
                            <x-adminlte-select2 name="muscle" label="Músculo" label-class="text-lightblue" igroup-size="lg" data-placeholder="Select an option...">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i class="fas fa-dumbbell"></i>
                                    </div>
                                </x-slot>
                                @foreach ($muscles as $muscle)
                                    <option value="{{ $muscle->id }}" {{ isset($selectedMuscle) && $selectedMuscle->id == $muscle->id ? 'selected' : '' }}>
                                        {{ $muscle->nombre }}
                                    </option>
                                @endforeach
                            </x-adminlte-select2>                       
                    </div>
                    {{-- <div class="row">
                        <x-adminlte-input-file name="image" label="image"  />
                    </div> --}}
                    <x-adminlte-button type="submit" label="save" theme="primary"/>
                </form> 
            </div>    
    </div>
@stop
@section('js')

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

@stop
