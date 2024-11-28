<!-- resources/views/livewire/user-dashboard.blade.php -->
<div class="flex items-center justify-center p-6 space-x-6">
    <div>
        <!-- Mensaje de bienvenida con efecto de escritura -->
        <h1 class="text-2xl font-semibold mb-4">
            <span id="typing-text">{{ $message }}</span>
        </h1>

        <!-- Asistente animado -->
        <div class="relative">
            <img src="{{ asset('images/assistant.gif') }}" alt="Asistente animado" class="w-32 h-32 animate-pulse">
        </div>

        <!-- Información del usuario -->
        <p class="text-lg mt-4">Hola, {{ $user->name }}. ¡Estamos encantados de que estés con nosotros!</p>
    </div>
</div>

<!-- Agregamos el script para el efecto de escritura -->

@script
<script>
    $wire.on('livewire:load', function () {
        const typingText = document.getElementById('typing-text');
        const message = typingText.innerText;
        typingText.innerText = ''; // Limpiar el texto inicial

        let i = 0;
        const typingInterval = setInterval(function () {
            typingText.innerText += message.charAt(i);
            i++;
            if (i > message.length - 1) {
                clearInterval(typingInterval);
            }
        }, 100);
    });
</script>
@endscript
