
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @livewireStyles
</head>
<body>

    @livewire('i-a-recommendation.page.a-i-recommendation', [
        'id_consulta'=>$data['id_consulta'],
        'nombre' => $data['nombre'],
        'age' => $data['age'],
        'gender' => $data['gender'],
        'weight' => $data['weight'],
        'height' => $data['height'],
        'bmi' => $data['bmi'],
        'dietary_preference' => $data['dietary_preference'],
        'physical_activity_level' => $data['physical_activity_level'],
        'diseases' => $data['diseases'],
        'allergies' => $data['allergies'],
        'physical_conditions' => $data['physical_conditions'],
        'restrictions' => $data['restrictions'],
        'target_type' => $data['target_type']
    ])

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>


