
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-green text-white">
            <h5 class="mb-0">Condicion Medica</h5>
        </div>
        <div class="card-body">
            <!-- Formulario para crear o editar -->
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <input type="text" wire:model="name" class="form-control" placeholder="Condition Name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <select wire:model="condition_type_id" class="form-select">
                            <option value="">Select Condition Type</option>
                            @foreach(\App\Models\ConditionType::all() as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('condition_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn {{ $updateMode ? 'btn-warning' : 'btn-primary' }}">
                            {{ $updateMode ? 'Update' : 'Add' }}
                        </button>
                        @if($updateMode)
                            <button type="button" wire:click="resetInputFields" class="btn btn-secondary">Cancel</button>
                        @endif
                    </div>
                </div>
            </form>

            <!-- Tabla -->
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Tipo de Condicion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicalConditions as $condition)
                        <tr>
                            <td>{{ $condition->condition_id }}</td>
                            <td>{{ $condition->name }}</td>
                            <td>
                                <span class="badge rounded-pill bg-dark p-2">
                                    {{ $condition->conditionType->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <button wire:click="edit({{ $condition->condition_id }})" class="btn btn-warning btn-sm">Editar</button>
                                <button wire:click="delete({{ $condition->condition_id }})" class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-3">
                {{ $medicalConditions->links() }}
            </div>
        </div>
    </div>
</div>
