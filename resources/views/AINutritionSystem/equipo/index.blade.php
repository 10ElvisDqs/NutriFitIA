@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>User Administration</h1>
@stop

@section('content')
    <p>Equipo Management</p>
    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="New" theme="primary" icon="fas fa-key" data-toggle="modal" data-target="#modalPurple"/>
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
            $heads = [
                'ID',
                'Name',
                ['label' => 'Actions', 'no-export' => true, 'width' => 20],
            ];

            $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';
            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>';

            $config = [
                'data' => [
                    [22, 'John Bender', '+02 (123) 123456789', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
                    [19, 'Sophia Clemens', '+99 (987) 987654321', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
                    [3, 'Peter Sousa', '+69 (555) 12367345243', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
                ],
                'order' => [[1, 'asc']],
                'columns' => [null, null, null, ['orderable' => false]],
            ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->id }}</td>
                        <td>{{ $equipo->nombre }}</td>
                        {{-- <td>
                            <img src="{{ asset($equipo->image) }}" alt="{{ $equipo->image }}" class="img-fluid img-thumbnail" width="100px">
                        </td> --}}
                        <td><a href="{{route('equipo.edit',$equipo)}}"class="btn btn-xs btn-default text-primary">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                            <form style="display: inline" action="{{ route('equipo.destroy',$equipo)}}" method="POST"
                                class="formEliminar">
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>

                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>

            {{-- Compressed with style options / fill data using the plugin config --}}
            {{-- <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config"
                striped hoverable bordered compressed/> --}}
        </div>
    </div>
    {{-- Modal --}}
    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="New equipo" theme="primary"
    icon="fas fa-bolt" size='lg' disable-animations>
        <div class="d-flex justify-content-center">
            <form action="{{route('equipo.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-adminlte-input name="name" label="Name" placeholder="here your role..."
                        fgroup-class="" disable-feedback/>
                </div>
                {{-- <div class="row">
                    <x-adminlte-input-file name="image" label="image" />
                </div> --}}
                <x-adminlte-button type="submit" label="save" theme="primary"/>
            </form>

        </div>
    </x-adminlte-modal>
    {{-- Example button to open modal --}}
    {{-- fin del Model --}}


   
@stop
@section('js')

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

@stop
