<form wire:submit.prevent="handleSubmit" class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
    <div class="mr-3">
        <button type="button" wire:click="$refs.fileInput.click()" class="flex items-center justify-center text-gray-400">
            <i class="fa-solid fa-paperclip text-xl"></i>
        </button>
        <input type="file" wire:model="file" x-ref="fileInput" class="hidden">
        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="flex-grow">
        <div class="relative w-full">
            <input
                type="text"
                wire:model="prompt"
                class="flex w-full border rounded-xl text-gray-800 focus:outline-none focus:border-indigo-300 pl-4 h-10"
                placeholder="{{ $placeholder }}"
                autofocus
            >
            @error('prompt') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="ml-4">
        <button class="btn-primary" type="submit" @disabled(!$file)>
            <span class="mr-2">Enviar</span>
            <i class="fa-regular fa-paper-plane"></i>
        </button>
    </div>
</form>
