<?php

namespace App\Livewire\Diet;
use Carbon\Carbon;
use Livewire\Component;

class HorizontalCalendar extends Component
{
    public $currentDate;
    public $weekDays = [];

    public function mount()
    {
        $this->currentDate = Carbon::now();
        $this->generateWeekDays();
    }

    public function generateWeekDays()
    {
        $startOfWeek = $this->currentDate->copy()->startOfWeek(Carbon::SUNDAY); // Ajustar según inicio de semana
        $this->weekDays = [];

        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $this->weekDays[] = [
                'name' => $day->isoFormat('ddd'), // Nombre del día
                'date' => $day->format('d'),
                'isToday' => $day->isSameDay(Carbon::now()),
            ];
        }
    }

    public function changeWeek($direction)
    {
        $this->currentDate = $this->currentDate->copy()->addWeeks($direction);
        $this->generateWeekDays();
    }
    public function render()
    {
        return view('livewire.diet.horizontal-calendar');
    }
}
