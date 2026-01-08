<?php

namespace App\Events;

use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsultationDone implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $visiteDone;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $dateAujourdhui = Carbon::now()->toDateString();
        $consultations  = Consultation::with(['docteur', 'factures', 'patient.ReglementFacture','patient.RendezVous','patient.assurance'])
        ->whereDate('dateConsultation', $dateAujourdhui)
        ->orderBy('created_at','desc')
        ->latest()
        ->get();
        
        $this->visiteDone = $consultations->toArray();
    }

    public function broadcastWith()
    {
        return [
            'visiteDone' => $this->visiteDone
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('consultation-done');
    }
}
