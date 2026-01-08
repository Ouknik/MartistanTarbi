<?php

namespace App\Events;

use App\Models\RendezVous;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ListRendezVous implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $RendezVousList;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->RendezVousList= RendezVous::with('patient')->get();
        // dd($this->RendezVousList);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('rendez-vous-list');
    }
}
