

@extends('layouts.app')
<!-- Estilos -->
<style>
    /* Glassmorphism para el contenedor principal */
    .glass-loader {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.5);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Animación flotante para la imagen */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Círculo de progreso */
    .spinner-circle {
        animation: rotate 2s linear infinite;
    }
    .path {
        stroke: #90caf9;
        stroke-linecap: round;
        animation: dash 1.5s ease-in-out infinite;
    }

    /* Animación del círculo */
    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes dash {
        0% {
            stroke-dasharray: 1, 150;
            stroke-dashoffset: 0;
        }
        50% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -35;
        }
        100% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -124;
        }
    }

    /* Efecto de texto */
    .loader-text {
        font-size: 0.9rem;
        color: #90caf9;
    }
</style>
@section('content')
    @livewireStyles
    @livewire('diet.diet-plan-loader', [
    'user_id' =>$data['user_id'],
    'recommendation_ia_id' =>$data['recommendation_ia_id'],
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
    'target_type' => $data['target_type']
])
@endsection
