<div class="chat-container">
    <div class="chat-messages">
        <div class="grid gap-y-2">

            <!-- Mensaje inicial -->
            <x-chat-message text="Escribe el texto que quieres que revise." />

            <!-- Iterar sobre los mensajes -->
            @foreach ($messages as $message)
                @if ($message['isGpt'])
                    <x-gpt-message-orthography
                        :text="$message['text']"
                        :errors="$message['info']['errors']"
                        :userScore="$message['info']['userScore']" />
                @else
                    <x-my-message :text="$message['text']" />
                @endif
            @endforeach

            <!-- Loader cuando se está cargando -->
            @if ($isLoading)
                <x-typing-loader />
            @endif

        </div>
    </div>

    <!-- MessageBox -->
    <x-text-message-box
        placeholder="Escribe aquí lo que deseas"
        @messageSent="$emit('messageSent', $event)"
        :disableCorrections="true" />
</div>
