<div class="card shadow-sm rounded-3 p-3" style="background-color: #c7f3d3;">
    <!-- Título y resumen -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">
            <i class="bi bi-sun text-warning"></i> {{ $title }}
        </h5>
        <div class="d-flex">




            <span class="text-danger fw-bold me-2">
                <img
                class="text-danger"
                src="https://img.icons8.com/?size=100&id=htXOOvtj6HxI&format=png&color=000000"
                alt="Chicken Icon"
                style="width: 20px; height: 20px;"
                />
                {{ $calories }}
            </span>
            <span class="text-primary fw-bold me-2">
                <img
                src="https://img.icons8.com/?size=100&id=tgHA6dZtH0B5&format=png&color=000000"
                alt="Chicken Icon"
                style="width: 20px; height: 20px;"
                />

                {{ $protein }}
            </span>
            <span class="text-warning fw-bold me-2"><i class="bi bi-droplet-fill"></i> {{ $fat }}</span>
            <span class="text-success fw-bold">

                <img
                class="text-success"
                src="https://img.icons8.com/?size=100&id=Q7ynu0X65C2y&format=png&color=000000"
                alt="Chicken Icon"
                style="width: 20px; height: 20px;"
                />
                class="text-succ
                {{ $carbs }}
            </span>
        </div>
    </div>

    <!-- Detalles del alimento -->
    <div>
        <h6 class="fw-bold"><i class="bi bi-camera-fill"></i> {{ $dishName }}</h6>
        <ul class="list-unstyled">
            @foreach ($ingredients as $ingredient)
                <li>{{ $ingredient }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Cómo preparar -->
    <div class="mt-3">
        <h6 class="fw-bold"><i class="bi bi-gear-fill"></i> Cómo preparar</h6>
        <p class="text-muted mb-0">
            {{ $preparation }}
        </p>
    </div>

    <!-- Beneficios -->
    <div class="mt-3">
        <h6 class="fw-bold"><i class="bi bi-heart-fill text-danger"></i> Beneficios para la salud</h6>
        <p class="text-muted mb-0">
            {{ $healthBenefits }}
        </p>
    </div>
</div>
