<?php

namespace App\Events;

use App\Models\Medicament;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Medicaments implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $medicaments;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->medicaments = Medicament::with('prescriptions')->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('get-medicaments');
    }
}
