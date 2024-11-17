<div class="col-start-1 col-end-9 p-3 rounded-lg">
    <div class="flex flex-row items-start">
        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-600 flex-shrink-0">
            G
        </div>

        <div class="relative ml-3 text-sm bg-black bg-opacity-25 pt-3 pb-2 px-4 shadow rounded-xl">
            <h3 class="text-3xl">Puntaje: {{ $userScore }}</h3>
            <p>{{ $text }}</p>

            @if(count($errors) > 0)
                <h3 class="text-2xl">Errores encontrados</h3>
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                <ul>
                    <li>No se encontraron errores, ¡perfecto!</li>
                </ul>
            @endif
        </div>
    </div>
</div>
