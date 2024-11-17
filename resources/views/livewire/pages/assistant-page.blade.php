<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* Contenedor principal con glassmorphism y gradiente vibrante */
    .chat-container {
        background: rgba(255, 255, 255, 0.15); /* Fondo translúcido */
        backdrop-filter: blur(20px); /* Efecto de vidrio */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5); /* Sombra profunda */
        border-radius: 20px; /* Bordes redondeados */
        border: 1px solid rgba(255, 255, 255, 0.3); /* Borde sutil */
        padding: 30px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .chat-container:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.6);
    }

    /* Fondo animado */
    .chat-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(120deg, #ff7eb3, #ff758c, #ff7eb3, #ff758c);
        background-size: 300% 300%;
        z-index: -1;
        animation: gradient-animation 8s infinite ease-in-out;
    }

    @keyframes gradient-animation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Encabezado */
    .chat-header img {
        max-width: 150px;
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .chat-header img:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(255, 120, 120, 0.5);
    }

    /* Mensajes */
    .chat-message, .my-message {
        background: rgba(255, 255, 255, 0.2); /* Fondo translúcido */
        border-radius: 15px;
        padding: 15px;
        margin: 10px 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        color: white;
        animation: fade-in 0.5s ease;
        max-height: 200px; /* Altura máxima permitida para los mensajes */
        overflow-y: auto; /* Agrega un scroll vertical si el contenido excede la altura */
        word-wrap: break-word; /* Maneja correctamente palabras largas */
        overflow-wrap: anywhere;
    }

    .chat-message {
        text-align: right;
        background: linear-gradient(145deg, #4e54c8, #8f94fb);
        color: #fff;
    }

    .my-message {
        text-align: left;
        background: linear-gradient(145deg, #ff758c, #ff7eb3);
        color: #fff;
    }

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loader */
    .typing-loader {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
    }

    .typing-loader span {
        width: 12px;
        height: 12px;
        background: #fff;
        border-radius: 50%;
        animation: typing 1.2s infinite ease-in-out;
    }

    .typing-loader span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-loader span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 80%, 100% {
            transform: scale(0);
        }
        40% {
            transform: scale(1);
        }
    }

    /* Caja de texto */
    .message-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 10px 15px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        margin-top: 20px;
    }

    .message-box input {
        background: transparent;
        border: none;
        color: white;
        outline: none;
        flex-grow: 1;
        font-size: 16px;
        padding: 5px;
    }

    .message-box input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .message-box button {
        background: linear-gradient(145deg, #4e54c8, #8f94fb);
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        color: white;
        font-weight: bold;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .message-box button:hover {
        background: linear-gradient(145deg, #8f94fb, #4e54c8);
        transform: scale(1.1);
    }
</style>

<div class="container mt-5">
    <div class="chat-container">
        <!-- Encabezado -->
        <div class="chat-header d-flex justify-content-center mb-4">
            <img src="{{ asset('img/logoNutriFitIA3.PNG') }}" alt="Logo">
        </div>

        <livewire:chat-message :text="'Hola Soy la IA, en que te puedo Ayudar?'" />
        <livewire:my-message :text="'Hola Soy Elvis'" />
        <!-- Mensajes -->
        @foreach ($messages as $message)
            @if ($message->is_user_message)
                <livewire:my-message :text="$message->content" />
            @else
                <livewire:chat-message :text="$message->content" />
            @endif
        @endforeach

        <!-- Loader -->
        <div class="typing-loader">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Caja de texto -->
        <div class="message-box">
            <livewire:text-message-box placeholder="Escribe aquí tu mensaje..." />
            <button><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>
