<div>

    <div class="row">
        <div class="col-12">
            @livewire('diet.horizontal-calendar')
        </div>
    </div>
    <h2>{{ $PlanTitle }}</h2>
    <div class="row justify-content-center mb-2">
        @livewire('diet.nutritional-summary-component')
    </div>
    <div class="row">

        @livewire('diet.meal-card-component', [
            'title' => 'Desayuno',
            'calories' => '350kcal',
            'protein' => '10g',
            'fat' => '8g',
            'carbs' => '56g',
            'dishName' => 'Avena con Frutas',
            'ingredients' => ['50 g de avena', '200 ml de leche descremada', '1 plátano mediano', '10 g de nueces'],
            'preparation' => 'Cocina la avena con leche descremada en una olla a fuego medio por unos 5 minutos. Agrega el plátano cortado y las nueces.',
            'healthBenefits' => 'Proporciona energía sostenible y es rico en fibra.',
        ])

    </div>

</div>
