<div class="container mt-5">
    <!-- Barra de navegación con bordes redondeados -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow rounded-pill">
        <a class="navbar-brand font-weight-bold text-primary" href="#">Dieta Pro</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav text-center">
                <li class="nav-item mx-2">
                    <button
                        class="nav-link btn d-flex align-items-center justify-content-center {{ $activeSection == 'asistente' ? 'text-white bg-success' : '' }} rounded-pill px-3"
                        wire:click="setActiveSection('asistente')">
                        <i class="bi bi-person-badge mr-2"></i> Asistente Dieta
                    </button>
                </li>
                <li class="nav-item mx-2">
                    <button
                        class="nav-link btn d-flex align-items-center justify-content-center {{ $activeSection == 'dieta' ? 'text-white bg-success' : '' }} rounded-pill px-3"
                        wire:click="setActiveSection('dieta')">

                        <img
                        src="https://img.icons8.com/?size=100&id=EsELtQNC08h9&format=png&color=000000"
                        alt="Chicken Icon"
                        style="width: 20px; height: 20px;"
                        />

                        Dieta
                    </button>
                </li>
                <li class="nav-item mx-2">
                    <button
                        class="nav-link btn d-flex align-items-center justify-content-center {{ $activeSection == 'rastreador' ? 'text-white bg-success' : '' }} rounded-pill px-3"
                        wire:click="setActiveSection('rastreador')">
                        <i class="bi bi-geo-alt mr-2"></i> Rastreador
                    </button>
                </li>
                <li class="nav-item mx-2">
                    <button
                        class="nav-link btn d-flex align-items-center justify-content-center {{ $activeSection == 'registro' ? 'text-white bg-success' : '' }} rounded-pill px-3"
                        wire:click="setActiveSection('registro')">
                        <i class="bi bi-pencil-square mr-2"></i> Registro
                    </button>
                </li>
                <li class="nav-item mx-2">
                    <button
                        class="nav-link btn d-flex align-items-center justify-content-center {{ $activeSection == 'cuenta' ? 'text-white bg-success' : '' }} rounded-pill px-3"
                        wire:click="setActiveSection('cuenta')">
                        <i class="bi bi-person-circle mr-2"></i> Cuenta
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido de la sección activa -->
    <div class="mt-4">
        @if($activeSection == 'asistente')
            <h2>Asistente Dieta</h2>
            <p>Aquí va el contenido del Asistente Dieta.</p>
        @elseif($activeSection == 'dieta')
            <div class="container p-4">
                @include('livewire.diet.sections.dieta', ['PlanTitle' => "Plan de Dieta Nutricional"])

            </div>
        @elseif($activeSection == 'rastreador')
            <h2>Rastreador</h2>
            <p>Aquí va el contenido del Rastreador.</p>
        @elseif($activeSection == 'registro')
            <h2>Registro</h2>
            <p>Aquí va el contenido del Registro.</p>
        @elseif($activeSection == 'cuenta')
            <h2>Cuenta</h2>
            <p>Aquí va el contenido de la Cuenta.</p>
        @endif
    </div>
</div>
