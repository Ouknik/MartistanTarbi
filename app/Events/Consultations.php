<?php

namespace App\Events;

use App\Models\Consultation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Consultations implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $consultations;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($consultation)
    {
        // $this->patient = $patient;
        // dd($consultations);

        $consultationsPatient =  Consultation::with(
            'EchographieNormale','factures'
        )->where('id',$consultation)->orderBy('created_at', 'desc')->get();

        $this->consultations = $consultationsPatient->toArray();
        // dd($this->consultations);
    }



    public function broadcastWith()
    {
        return [
            'consultations' => $this->consultations
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('consultations-patient-done');
    }
}
