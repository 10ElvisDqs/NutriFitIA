
<div>
    <h1>Generar Plan de Dieta</h1>

    <!-- Mostrar el mensaje de estado -->
    <p>{{ $statusMessage }}</p>

    <!-- Formulario o botón para iniciar el proceso -->
    <button wire:click="generarPlanDeDieta({{ $dietData }})">Generar Dieta</button>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
