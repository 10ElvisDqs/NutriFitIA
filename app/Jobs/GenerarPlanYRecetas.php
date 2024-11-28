<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Events\PlanDeDietaGenerado;

class GenerarPlanYRecetas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Procesa la dieta (como el ejemplo anterior)
        $planDieta = $this->generarPlanDieta($this->dietData, $this->userId);

        // Emite el evento de que el plan de dieta ha sido generado
        event(new PlanDeDietaGenerado($planDieta));
    }
}
