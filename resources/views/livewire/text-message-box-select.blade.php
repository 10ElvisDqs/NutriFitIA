<!-- resources/views/livewire/text-message-box-select.blade.php -->

<form wire:submit.prevent="handleSubmit" class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
    <div class="flex-grow">
        <div class="flex">
            <!-- Campo de entrada de texto -->
            <input
                type="text"
                wire:model="prompt"
                class="flex w-full border rounded-xl text-gray-800 focus:outline-none focus:border-indigo-300 pl-4 h-10"
                :placeholder="$placeholder"
            />

            <!-- Selección desplegable -->
            <select
                wire:model="selectedOption"
                class="w-2/5 ml-5 border rounded-xl text-gray-800 focus:outline-none focus:border-indigo-300 pl-4 h-10">
                <option value="">Seleccione</option>
                @foreach($options as $option)
                    <option value="{{ $option['id'] }}">{{ $option['text'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Botón de envío -->
    <div class="ml-4">
        <button
            type="submit"
            class="btn-primary"
            @disabled(empty($prompt) || empty($selectedOption))
        >
            <span class="mr-2">Enviar</span>
            <i class="fa-regular fa-paper-plane"></i>
        </button>
    </div>
</form>
