<div class="container mt-5">
    <h1 class="mb-4">Tipos de Condición</h1>

    <!-- Botón Agregar -->
    <button class="btn btn-primary mb-3" wire:click="openForm">Agregar Nueva Condición</button>

    <!-- Tabla -->
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($conditionTypes as $conditionType)
                <tr>
                    <td>{{ $conditionType->id }}</td>
                    <td>{{ $conditionType->name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" wire:click="openForm({{ $conditionType->id }})">Editar</button>
                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $conditionType->id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade {{ $isOpen ? 'show' : '' }}" tabindex="-1" role="dialog" style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $conditionTypeId ? 'Editar' : 'Agregar' }} Condición</h5>
                    <button type="button" class="close" wire:click="closeForm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Nombre de la condición">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeForm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">{{ $conditionTypeId ? 'Actualizar' : 'Agregar' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
