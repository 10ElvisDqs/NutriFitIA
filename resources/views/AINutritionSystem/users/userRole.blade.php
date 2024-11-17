@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Users has Permissions</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <p>{{ $user->name }}</p>
        </div>
        <div class="card-body">
            <h5>Lista de Permisos</h5>
            {!! Form::model($user, ['route' => ['assign.update', $user], 'method'=>'put']) !!}
                @foreach ( $roles as $role )
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null,['class'=>'mr-1'])!!}
                            {{ $role->name}}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit('assign roles',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
