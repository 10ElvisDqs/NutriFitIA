<div>
    @if ($isLoading)
        <!-- Pantalla de carga -->
        <div class="d-flex justify-content-center align-items-center vh-100 bg-white">
            <div class="text-center">
                <img
                id="animatedImage"
                src="https://img.icons8.com/?size=512&id=oDXd7HuX5XpI&format=png" alt="Cargando..."
                width="150"
                height="150"
                style="position: relative;"
                >
                <p class="mt-3">Generando plan de dieta...</p>
                <div class="spinner-grow text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <div class="spinner-grow text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <div class="spinner-grow text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <div class="spinner-grow text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <div class="spinner-grow text-warning" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>

                  <div>
                    <div class="w-1/2 bg-gray-200 rounded-full h-4 dark:bg-gray-700 mx-auto">
                        <div
                            class="bg-blue-500 h-4 rounded-full transition-all duration-200 ease-in-out"
                            style="width: {{ $progress }}%;"></div>
                    </div>
                    <p>{{ $progress }}% completado</p>
                  </div>
            </div>
        </div>
    @else
        <!-- Contenido después de la carga -->
        <div>
            <video autoplay loop muted class="w-48 h-48">
                <source src="{{ asset('videos\\loading.webm') }}" type="video/webm">
                {{-- <source src="C:\Proyectos\Nutri-IA\api-nutricional-ia\public\videos\loading.webm" type="video/webm"> --}}
                {{-- <source src="{{ asset('videos/loading.webm') }}" type="video/webm"> --}}
                Tu navegador no soporta el video.
            </video>

            <h1>¡Plan de dieta generado!</h1>
            <!-- Mostrar más detalles aquí -->
        </div>
    @endif
</div>

@script
<script>
        const image = document.getElementById('animatedImage');
        let position = 0;
        let direction = 1; // 1 para derecha, -1 para izquierda

        function animate() {
            // Actualiza la posición
            position += direction;

            // Cambia la dirección si llega al límite
            if (position > 50 || position < 0) {
                direction *= -1;
            }

            // Aplica el movimiento
            image.style.left = position + 'px';

            // Llama a la función en el siguiente frame
            requestAnimationFrame(animate);
        }

        // Inicia la animación
        $wire.on('start-diet-generation', function () {
            animate();
            console.log("ingresooo");

            $wire.dispatch('startGeneration');
        });

        $wire.on('progressUpdatedd', function () {
            // Aquí puedes agregar algún comportamiento al recibir el evento
            console.log('ingreso al actualizar');
            // console.log('El progreso se ha actualizado: ' + @this.progress + '%');
        });
</script>

@endscript
