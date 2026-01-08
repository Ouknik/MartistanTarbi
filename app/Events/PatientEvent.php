<?php

namespace App\Events;

use App\Models\Assurance;
use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PatientEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $patient;
    public $assurance;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($patient)
    {
        // $this->patient = Patient::with('Antecedents')->where('id',$patient->id)->first();
     

        // dd($patient);
        $this->assurance = Assurance::where('id', '=', $patient->assurance_id)->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('patient-show');
    }
}
