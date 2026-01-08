<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Antecedent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $antecedentData;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($patient)
    {
        $antecedentData =  $patient->Antecedents()->get();
        $this->antecedentData = $antecedentData->toArray();
        // dd($antecedentData);
    }

    public function broadcastWith()
    {
        return [
            'antecedentData' => $this->antecedentData
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('antecedent-patient');
    }
}
