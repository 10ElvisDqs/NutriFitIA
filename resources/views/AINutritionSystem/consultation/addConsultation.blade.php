

@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')

<livewire:formulario-progreso />
<livewire:pages.assistant-page/>

{{-- <livewire:components.chatbot :$conversation/> --}}

@stop
@section('js')

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

@stop
