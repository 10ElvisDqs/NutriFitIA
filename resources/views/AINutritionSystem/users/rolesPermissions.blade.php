@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Roles has Permissions</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <p>{{ $role->name }}</p>
        </div>
        <div class="card-body">
            <h5>Lista de Permisos</h5>
            {!! Form::model($role, ['route' => ['roles.update', $role], 'method'=>'put']) !!}
                @foreach ( $permissions as $permission )
                    <div>
                        <label>
                            {!! Form::checkbox('permissions[]', $permission->id, null,['class'=>'mr-1'])!!}
                            {{ $permission->name}}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit('assign permissions',['class'=>'btn btn-primary']) !!}
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
