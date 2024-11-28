<div class="d-flex justify-content-between align-items-center w-100">
    <button wire:click="changeWeek(-1)" class="btn btn-outline-primary btn-sm me-2">
        <i class="bi bi-chevron-left"></i>
    </button>

    <div class="d-flex border rounded-3 bg-light px-1 py-1 w-100 justify-content-between align-items-center ">
        @foreach ($weekDays as $day)
            <div class="text-center px-2">
                <div class="{{ $day['isToday'] ? 'text-primary fw-bold' : 'text-dark' }}">
                    {{ $day['name'] }}
                </div>
                <div class="{{ $day['isToday'] ? 'bg-primary text-white rounded-circle px-2 py-1' : '' }}">
                    {{ $day['date'] }}
                </div>
            </div>
        @endforeach
    </div>

    <button wire:click="changeWeek(1)" class="btn btn-outline-primary btn-sm ms-2">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>
