
@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Users Management</h1>
@stop

@section('content')
    <p>Users Management</p>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-center">
                <form action="{{route('muscle.update',$muscle)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <x-adminlte-input name="name" label="Name" placeholder="here your role..."
                         value="{{$muscle->nombre}}"
                            fgroup-class="" disable-feedback/>
                    </div>
                    <div class="row">
                        <x-adminlte-input-file name="image" label="image"  />
                    </div>
                    <x-adminlte-button type="submit" label="save" theme="primary"/>
                </form> 
            </div>

    
    </div>
@stop
@section('js')

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

@stop