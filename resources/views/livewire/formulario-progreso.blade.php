<div class="container mt-5">
    <div class="progress mb-4">
        <div
            class="progress-bar"
            role="progressbar"
            style="width: {{ ($paso / 3) * 100 }}%;"
            aria-valuenow="{{ $paso }}"
            aria-valuemin="1"
            aria-valuemax="3">
            Paso {{ $paso }} de 3
        </div>
    </div>

    @if($paso === 1)
        <div class="container m-2">
            <ul class="list-group">
                @foreach ($medicalCondition as $condition)

                @endforeach
            <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="{{ $condition->name }}" id="{{ }}">
                <label class="form-check-label" for="firstCheckbox">First checkbox</label>
            </li>
            <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="" id="secondCheckbox">
                <label class="form-check-label" for="secondCheckbox">Second checkbox</label>
            </li>
            <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="" id="thirdCheckbox">
                <label class="form-check-label" for="thirdCheckbox">Third checkbox</label>
            </li>
            </ul>
        </div>
        <div class="card p-4">
            <h3 class="text-center">¿Cuál es tu objetivo?</h3>
            <select class="form-control" wire:model="target_type_id">
                <option value="">Seleccione un objetivo</option>
                @foreach($targetTypes as $type)
                    <option value="{{ $type->target_type_id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('target_type_id') <span class="text-danger">{{ $message }}</span> @enderror
            <button class="btn btn-primary mt-3" wire:click="avanzar">Siguiente</button>
        </div>
    @elseif($paso === 2)
        <div class="card p-4">
            <div class="text-center mb-4">
                <div class="icon-circle mb-3">
                    <i class="bi bi-bullseye"></i> <!-- Ícono -->
                </div>
                <h1 class="h4 fw-bold">¿Cuál es tu objetivo?</h1>
                <p class="text-muted">Calcularemos tus calorías necesarias para lograrlo</p>
            </div>

            <!-- Opciones -->
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    @foreach($targetTypes as $type)
                    {{-- <option value="{{ $type->target_type_id }}">{{ $type->name }}</option> --}}
                    <div class="card-option">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-arrow-down-circle-fill"></i>
                            <div>
                                <div class="card-title">{{ $type->name }}</div>
                                <div class="card-description">Optimiza la pérdida de peso y conserva tu masa muscular</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @error('tar get_type_id') <span class="text-danger">{{ $message }}</span> @enderror
            <button class="btn btn-primary mt-3" wire:click="avanzar">Siguiente</button>
        </div>

    @elseif($paso === 3)
        <div class="card p-4">
            <h3 class="text-center">Detalles Antropométricos</h3>
            <div class="mb-3">
                <label for="weight" class="form-label">Peso (kg)</label>
                <input type="number" id="weight" class="form-control" wire:model="weight">
                @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Altura (cm)</label>
                <input type="number" id="height" class="form-control" wire:model="height">
                @error('height') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-primary" wire:click="avanzar">Siguiente</button>
        </div>
    @elseif($paso === 4)
        <div class="card p-4">
            <h3 class="text-center">Preferencias</h3>
            <div class="mb-3">
                <label for="physical_activity_level" class="form-label">Nivel de Actividad Física</label>
                <input type="text" id="physical_activity_level" class="form-control" wire:model="physical_activity_level">
                @error('physical_activity_level') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="dietary_preference" class="form-label">Preferencia Alimenticia</label>
                <input type="text" id="dietary_preference" class="form-control" wire:model="dietary_preference">
            </div>
            <div class="mb-3">
                <label for="restrictions" class="form-label">Restricciones</label>
                <textarea id="restrictions" class="form-control" wire:model="restrictions"></textarea>
            </div>
            <button class="btn btn-success" wire:click="guardar">Finalizar</button>
        </div>
    @endif

    <div class="mt-3 d-flex justify-content-between">
        <button class="btn btn-secondary" wire:click="retroceder" {{ $paso === 1 ? 'disabled' : '' }}>Atrás</button>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
</div>
