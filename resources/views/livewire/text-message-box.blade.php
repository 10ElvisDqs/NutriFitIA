<form wire:submit.prevent="handleSubmit"
    class="d-flex align-items-center h-16 rounded-pill p-1"
    style="background-color:#2F2F2F;"
    >
    <div class="flex-grow-1">
        <div class="position-relative w-100">
            <input
                type="text"
                autofocus
                class="form-control rounded-pill   pl-3 h-10 "
                style="background-color:#2F2F2F;"
                placeholder="{{ $placeholder }}"
                wire:model.defer="prompt"
                autocomplete="{{ $disableCorrections ? 'off' : 'on' }}"
                spellcheck="{{ $disableCorrections ? 'false' : 'true' }}"
            >
        </div>
    </div>

    <div class="ml-1">
        <button
            class="btn btn-primary rounded-circle"
            type="submit"
            {{-- {{ empty($prompt) ? 'disabled' : '' }} --}}
        >
            {{-- <span class="mr-2">Enviar</span> --}}
            <i class="fa-regular fa-paper-plane"></i>
        </button>
    </div>
</form>
