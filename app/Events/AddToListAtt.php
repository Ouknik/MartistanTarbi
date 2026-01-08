<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddToListAtt implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $patientsAtt;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->patientsAtt = Patient::where('isActive', 1)
            ->orderByRaw("CASE WHEN statutPatient = 'Urgent' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'asc')
            ->latest()
            ->select('id', 'nomPatient', 'prenomPatient', 'statutPatient', 'sexePatient', 'suiviPar')
            ->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('add-to-list');
    }
}
