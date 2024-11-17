<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Progreso: Grupo {{ $grupoActual }} / {{ $totalGrupos }}</h4>
        </div>
        <div class="card-body">
            <!-- Barra de progreso -->
            <div class="progress mb-4">
                <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: {{ ($grupoActual / $totalGrupos) * 100 }}%;"
                    aria-valuenow="{{ ($grupoActual / $totalGrupos) * 100 }}"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    {{ round(($grupoActual / $totalGrupos) * 100) }}%
                </div>
            </div>

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Formulario dinámico -->
            <form wire:submit.prevent="avanzarGrupo">
                @foreach($preguntas as $pregunta)
                    <div class="form-group mb-3">
                        <label for="pregunta_{{ $pregunta->id }}">{{ $pregunta->descripcion }}</label>
                        <input
                            type="text"
                            id="pregunta_{{ $pregunta->id }}"
                            wire:model.defer="respuestas.{{ $pregunta->id }}"
                            class="form-control">
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">
                    {{ $grupoActual < $totalGrupos ? 'Siguiente' : 'Finalizar' }}
                </button>
            </form>
        </div>
    </div>
</div>
