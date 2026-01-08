<?php

namespace App\Events;

use App\Models\Clinique;
use App\Models\OperationPatient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OperationsClinique
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $OperationPatient;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $OperationPatient = Clinique::all();
        $this->OperationPatient = $OperationPatient->toArray();
    }

    public function broadcastWith()
    {
        return [
            'OperationPatient' => $this->OperationPatient
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('operations-patients');
    }
}
