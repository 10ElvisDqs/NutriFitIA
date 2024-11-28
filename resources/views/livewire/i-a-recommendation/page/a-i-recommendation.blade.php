

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="container text-center mt-5">
                <!-- Encabezado -->
                <h2>NutriFitIA</h2>
                <p id="message">{{ $nombre }}, tu recomendación se está preparando...</p>

                <!-- Contenedor de animaciones -->
                <div id="animated-container" class="mt-5 text-center">
                    <div id="nombre" class="animated-item d-none">
                        <i class="bi bi-person-circle fs-3"></i>
                        <strong>Nombre:</strong> <span>{{ $nombre }}</span>
                        <span class="spinner" id="spinner-nombre"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-nombre"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="age" class="animated-item d-none">
                        <i class="bi bi-calendar fs-3"></i>
                        <strong>Edad:</strong> <span>{{ $age }}</span>
                        <span class="spinner" id="spinner-age"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-age"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="gender" class="animated-item d-none">
                        <i class="bi bi-gender-ambiguous fs-3"></i>
                        <strong>Género:</strong> <span>{{ $gender }}</span>
                        <span class="spinner" id="spinner-gender"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-gender"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="weight" class="animated-item d-none">
                        <i class="bi bi-weight fs-3"></i>
                        <strong>Peso:</strong> <span>{{ $weight }} kg</span>
                        <span class="spinner" id="spinner-weight"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-weight"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="height" class="animated-item d-none">
                        <i class="bi bi-rulers fs-3"></i>
                        <strong>Altura:</strong> <span>{{ $height }} cm</span>
                        <span class="spinner" id="spinner-height"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-height"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="bmi" class="animated-item d-none">
                        <i class="bi bi-bar-chart-line fs-3"></i>
                        <strong>IMC:</strong> <span>{{ $bmi }}</span>
                        <span class="spinner" id="spinner-bmi"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-bmi"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="dietary_preference" class="animated-item d-none">
                        <i class="bi bi-heart fs-3"></i>
                        <strong>Preferencia dietética:</strong> <span>{{ $dietary_preference }}</span>
                        <span class="spinner" id="spinner-dietary_preference"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-dietary_preference"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="physical_activity_level" class="animated-item d-none">
                        <i class="bi bi-lightning fs-3"></i>
                        <strong>Nivel de actividad:</strong> <span>{{ $physical_activity_level }}</span>
                        <span class="spinner" id="spinner-physical_activity_level"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-physical_activity_level"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="diseases" class="animated-item d-none">
                        <i class="bi bi-file-medical fs-3"></i>
                        <strong>Enfermedades:</strong>
                        <span>{{ is_array($diseases) ? implode(', ', $diseases) : $diseases }}</span>
                        <span class="spinner" id="spinner-diseases"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-diseases"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="allergies" class="animated-item d-none">
                        <i class="bi bi-exclamation-triangle fs-3"></i>
                        <strong>Alergias:</strong>
                        <span>{{ is_array($allergies) ? implode(', ', $allergies) : $allergies }}</span>
                        <span class="spinner" id="spinner-allergies"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-allergies"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                    <div id="physical_conditions" class="animated-item d-none">
                        <i class="bi bi-body-text fs-3"></i>
                        <strong>Condiciones físicas:</strong>
                        <span>{{ is_array($physical_conditions) ? implode(', ', $physical_conditions) : $physical_conditions }}</span>
                        <span class="spinner" id="spinner-physical_conditions"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-physical_conditions"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>

                    <div id="restrictions" class="animated-item d-none">
                        <i class="bi bi-x-circle fs-3"></i>
                        <strong>Restrinciones físicas y Alimentarias:</strong>
                        <span>{{ is_array($restrictions) ? implode(', ', $restrictions) : $restrictions }}</span>
                        <span class="spinner" id="spinner-restrictions"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-restrictions"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>

                    <div id="target_type" class="animated-item d-none">
                        <i class="bi bi-flag fs-3"></i>
                        <strong>Objetivo:</strong> <span>{{ $target_type }}</span>
                        <span class="spinner" id="spinner-target_type"><i class="bi bi-arrow-repeat spinner-grow"></i></span>
                        <span class="success-icon d-none" id="success-target_type"><i class="bi bi-check-circle-fill text-success"></i></span>
                    </div>
                </div>

                <!-- Barra de progreso -->
                <div class="progress mt-4">
                    <div id="progress-bar" class="progress-bar bg-primary" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <span id="progress-text">0%</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-6">
            <div class="container mt-4">
                <!-- Área de texto para mostrar la respuesta generada -->
                <div class="mb-3">
                    <!-- Indicador de carga que se muestra mientras se espera la respuesta -->
                    <div wire:loading wire:target="submit" class="mt-2 text-center text-muted">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-2">Generando respuesta...</p>
                    </div>

                    <!-- Área de texto para mostrar la respuesta una vez finalizada la carga -->
                    <label for="responseTextarea" class="form-label">Respuesta Generada</label>
                    <textarea id="responseTextarea" class="form-control" rows="10" style="overflow-y: auto;" readonly ></textarea>
                </div>
            </div>

            <div class="container mt-5">
                <div class="d-flex justify-content-around">
                    <!-- Botón para Dieta -->
                    <div>
                        @if ($isLoading)
                            <!-- Vista de carga -->
                            @else
                            {{-- @livewire('diet.diet-plan-loader') --}}
                            <button class="btn btn-primary d-flex align-items-center gap-2"  wire:click="generarPlan">
                                <i class="fas fa-brain"></i> Generar Plan de Dieta
                                <img src="https://img.icons8.com/?size=100&id=oDXd7HuX5XpI&format=png&color=000000"
                                width="40" height="40" alt="Dieta"/>
                            </button>

                            <!-- Botón para iniciar la generación -->
                        @endif
                    </div>


                    <!-- Botón para Ejercicio -->
                    <button class="btn btn-success" wire:click="hola">
                        <i class="fas fa-running"></i> Ejercicio
                        <img src="https://img.icons8.com/?size=100&id=gslIN7SW0irX&format=png&color=000000"  width="40" height="40"  alt="Descripción de la imagen" />
                    </button>

                    <!-- Botón para Ambos -->
                    <button class="btn btn-warning">
                        <i class="fas fa-users"></i> Ambos
                        <img src="https://img.icons8.com/?size=100&id=gslIN7SW0irX&format=png&color=000000"  width="40" height="40"  alt="Descripción de la imagen" />
                        <img src="https://img.icons8.com/?size=100&id=EFkI2Z8MLa1H&format=png&color=000000"  width="40" height="40"  alt="Descripción de la imagen" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $wire.on('start-loading', function () {
        let progressBar = document.getElementById('progress-bar');
        let progressText = document.getElementById('progress-text');
        let progress = 0;

        // Lista de datos a mostrar progresivamente
        const dataElements = [
            'nombre', 'age', 'gender', 'weight', 'height', 'bmi',
            'dietary_preference', 'physical_activity_level',
            'diseases', 'allergies', 'physical_conditions','restrictions', 'target_type'
        ];
        const totalSteps = dataElements.length;
        const totalDuration = 10000; // Duración total en milisegundos
        const stepDuration = totalDuration / totalSteps; // Duración por cada dato
        const progressStep = 100 / totalSteps; // Incremento de progreso por dato

        let currentIndex = 0;

        const interval = setInterval(() => {
            // Actualizar barra de progreso
            progress += progressStep;
            progressBar.style.width = progress + '%';
            progressText.textContent = Math.floor(progress) + '%';

            // Mostrar el siguiente dato
            if (currentIndex < dataElements.length) {
                const elementId = dataElements[currentIndex];
                const element = document.getElementById(elementId);
                const spinner = document.getElementById(`spinner-${elementId}`);
                const successIcon = document.getElementById(`success-${elementId}`);

                // Mostrar el elemento
                element.classList.remove('d-none');
                element.classList.add('show');

                // Mover spinner debajo
                setTimeout(() => {
                    spinner.classList.add('below');
                }, stepDuration / 2);

                // Reemplazar spinner con ícono de éxito
                setTimeout(() => {
                    spinner.classList.add('d-none'); // Ocultar spinner
                    successIcon.classList.remove('d-none'); // Mostrar ícono de éxito
                }, stepDuration);

                currentIndex++;
            }

            // Detener cuando todo se muestre
            if (progress >= 100) {
                clearInterval(interval);
            }
        }, stepDuration);
    });

    function writeLetterByLetter(currentText, newText) {
        let i = currentText.length;
        const textarea = document.getElementById('responseTextarea');

        // Desplaza automáticamente hacia abajo si no está ya al fondo
        function scrollToBottom() {
            textarea.scrollTop = textarea.scrollHeight;
        }

        // Llama a scrollToBottom antes de comenzar a escribir
        scrollToBottom();

        let interval = setInterval(() => {
            if (i < newText.length) {
                textarea.value += newText.charAt(i); // Agrega la siguiente letra
                i++;

                // Desplazar automáticamente hacia abajo después de cada letra
                scrollToBottom();
            } else {
                clearInterval(interval); // Detiene el intervalo cuando se ha escrito todo
            }
        }, 15); // 50ms por letra (ajústalo a tu gusto)
    }

    $wire.on('responseUpdatedText', (data) => {
        const textarea = document.getElementById('responseTextarea');
        let currentText = textarea.value;
        console.log(currentText + '  holas');
        let newText = data[0].response;
        console.log(newText);

        writeLetterByLetter(currentText, newText); // Llamar a la función de escritura
    });

</script>
@endscript


