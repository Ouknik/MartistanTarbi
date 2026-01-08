<?php

namespace App\Events;

use App\Models\Docteur;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class DocteurHeader implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $docteur;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $doc = Docteur::all();
        // dd($doc->totalPatients);
        $this->docteur = $doc;
    }

    public function broadcastWith()
    {
        return [
            'docteur' => $this->docteur
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('state-docteur');
    }
}
