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
use Inertia\Inertia;

class CalendarDoctor implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $calendarDoctor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $rendezvous = RendezVous::with('patient', 'docteur')->get();
        $this->calendarDoctor = $rendezvous;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('calendar-doctor');
    }
}
