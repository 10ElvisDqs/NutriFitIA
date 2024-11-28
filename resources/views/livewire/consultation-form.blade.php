
<div class="container mt-5 bg-primary shadow p-3 mb-5 bg-body-tertiary rounded" >

    <h3>Formulario de Predicción</h3>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="row justify-content-md-center">
            <div class="col-3">
                <label for="age" class="form-label">Edad</label>
                <input type="number" id="age" class="form-control" wire:model="age">
                @error('age') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-3">
                <label for="gender" class="form-label">Género</label>
                <select id="gender" class="form-select" wire:model="gender">
                    <option value="">Selecciona una opción</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row justify-content-md-center">

            <div class="col-3">
                <label for="weight" class="form-label">Peso (kg)</label>
                <input type="number" step="0.1" id="weight" class="form-control" wire:model.lazy="weight">
                @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-3">
                <label for="height" class="form-label">Altura (m)</label>
                <input type="number" step="0.01" id="height" class="form-control"  wire:model.lazy="height">
                @error('height') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-3">
                <label for="bmi" class="form-label">IMC</label>
                <input type="text" id="bmi" class="form-control" wire:model="bmi" readonly>
            </div>
        </div>
        <div class="row mb-2 justify-content-md-center">
            <div class="col-3">
                <label for="dietary_preference" class="form-label">Preferencia alimentaria</label>
                <select id="dietary_preference" class="form-select" wire:model="dietary_preference">
                    <option value="">Selecciona una opción</option>
                    <option value="omnivora">Omnívora</option>
                    <option value="vegetariana">Vegetariana</option>
                    <option value="vegana">Vegana</option>
                    <option value="flexitariana">Flexitariana</option>
                    <option value="pescetariana">Pescetariana</option>
                    <option value="crudivora">Crudívora</option>
                </select>
                @error('dietary_preference') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-3">
                <label for="physical_activity_level" class="form-label">Nivel de Actividad Fisica</label>
                <select id="physical_activity_level" class="form-select" wire:model="physical_activity_level">
                    <option value="">Selecciona una opción</option>
                    <option value="sedentario">Sedentario</option>
                    <option value="actividad ligera">Actividad ligera</option>
                    <option value="actividad moderada">Actividad moderada</option>
                    <option value="actividad intensa">Actividad intensa</option>
                    <option value="pescetariana">Pescetariana</option>
                    <option value="actividad muy intensa">Actividad muy intensa</option>
                </select>
                @error('physical_activity_level') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-12 text-center mb-4">
                <h2 class="h4">¿Cuál es tu objetivo?</h2>
                <p>Calcularemos tus calorías necesarias para lograrlo</p>
            </div>

            <div class="row justify-content-center">
                @foreach ($targetType as $type)
                    <div class="col-md-4 mb-3">
                        <div wire:click="selectTarget('{{$type->name}}')" class="card cursor-pointer
                            {{ $type->name === $target_type ? 'border-success bg-success bg-opacity-10' : 'border-primary' }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-down"></i>
                                    {{-- <i class="bi bi-arrow-down-circle-fill text-success mr-2" style="font-size: 2rem;"></i> --}}
                                    <h5 class="card-title">{{$type->name}}</h5>
                                </div>
                                <p class="card-text">Optimiza la pérdida de peso y conserva tu masa muscular.</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            @error('target_type')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>


        <div class="container mt-5 ">
            <div class="row justify-content-md-center">
                <h3>Seleccionar Condiciones Médicas</h3>
            </div>
            <div class="row justify-content-md-center p-2">
                <div class="col-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addConditionModal">
                    Agregar Condición Médica
                    </button>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif

            <div class="row justify-content-md-center">
                @foreach ($medicalConditions as $type => $conditions)
                    <div class="col-md-3 mb-4">
                        <h5>{{ $type }}</h5>
                        @foreach ($conditions as $condition)
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="{{ $type }}-{{ $condition->condition_id }}"
                                    wire:click="toggleCondition('{{ $type }}', {{ $condition->condition_id }}, '{{ $condition->name }}')"
                                    {{ isset($$type[$condition->condition_id]) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $type }}-{{ $condition->condition_id }}">
                                    {{ $condition->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="col-3 mb-4">
                    <!-- Mostrar condiciones seleccionadas -->
                    <div class="bg-light rounded border p-3 mb-2">
                        <h4>Selecciones Actuales</h4>

                        <div>
                            <strong>Restricciones:</strong>
                            <ul>
                                @foreach ($restrictions as $name)
                                    <li> <span class=" badge rounded-pill bg-dark"> {{ $name }} </span></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div>
                                <strong>Enfermedades:</strong>
                                <ul>
                                @foreach ($diseases as $name)
                                    <li> <span class=" badge rounded-pill bg-dark"> {{ $name }} </span></li>
                                @endforeach
                                </ul>
                        </div>

                        <div>
                            <strong>Alergias:</strong>
                            <ul>
                                @foreach ($allergies as $name)
                                <li> <span class=" badge rounded-pill bg-dark"> {{ $name }} </span></li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            <strong>Condiciones Médicas:</strong>
                            <ul>
                                @foreach ($physical_conditions as $name)
                                <li> <span class=" badge rounded-pill bg-dark"> {{ $name }} </span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <!-- Continúa con el resto de los campos -->
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>



    {{-- <div id="response" class="response-text">
        <p id="typing-text"></p>
    </div> --}}


    <div class="container mt-4">
    <!-- Área de texto para mostrar la respuesta generada -->
        <div class="mb-3">
            <div wire:loading wire:target="submit" class="mt-2 text-center text-muted">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p class="mt-2">Generando respuesta...</p>
            </div>
            <label for="responseTextarea" class="form-label">Respuesta Generada</label>
            <textarea id="responseTextarea" class="form-control" rows="10" style="overflow-y: auto;" ></textarea>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="addConditionModal" tabindex="-1" aria-labelledby="addConditionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addConditionModalLabel">Nueva Condición Médica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <div class="form-group mb-3">
                        <label for="newConditionName">Nombre de la Condición</label>
                        <input type="text" id="newConditionName" class="form-control" wire:model="newConditionName">
                        @error('newConditionName') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="selectedType">Tipo de Condición</label>
                        <select id="selectedType" class="form-control" wire:model="selectedType">
                            <option value="">Seleccionar Tipo</option>
                            @foreach ($conditionTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click="addCondition">Agregar Condición</button>
                </div>
            </div>
        </div>
    </div>


</div>
@script
<script>
    $wire.on('post-created', () => {
        console.log("Holaa des port create");
    });
    $wire.on('conditionAdded', () => {
        console.log('Evento conditionAdded recibido');

        // Asegúrate de que el modal esté correctamente referenciado
        const modalElement = document.getElementById('addConditionModal');
        const modal = bootstrap.Modal.getInstance(modalElement);

        if (modal) {
            modal.hide();  // Cierra el modal si existe
            console.log('Modal cerrado');
        }

        // Limpia el backdrop y los estilos
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        document.body.classList.remove('modal-open');
        document.body.style = '';
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
        }, 50); // 50ms por letra (ajústalo a tu gusto)
    }

    $wire.on('responseUpdated', (data) => {
        const textarea = document.getElementById('responseTextarea');
        let currentText = textarea.value;
        let newText = data[0].response;

        writeLetterByLetter(currentText, newText); // Llamar a la función de escritura
    });


    function calculateBMI() {
        const weight = parseFloat(document.getElementById('weight').value); // Peso en kg
        const height = parseFloat(document.getElementById('height').value); // Altura en metros

        if (weight > 0 && height > 0) {
            const bmi = weight / (height * height); // Calcular el IMC
            document.getElementById('bmi').textContent = bmi.toFixed(2); // Mostrar el IMC con 2 decimales
        } else {
            document.getElementById('bmi').textContent = '0'; // Si los valores son incorrectos, muestra 0
        }
    }


</script>
@endscript


