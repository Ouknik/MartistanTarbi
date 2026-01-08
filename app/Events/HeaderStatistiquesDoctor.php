<?php

namespace App\Events;

use App\Models\Consultation;
use App\Models\Docteur;
use App\Models\Patient;
use App\Models\ReglementFacture;
use App\Models\RendezVous;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class HeaderStatistiquesDoctor implements ShouldBroadcast
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
        // $doc = Auth::user();
        // if($doc->type=="secretaire" || $doc->type=="docteur")
        // {
        //     $this->docteur = $doc;
        // }
        $this->docteur =  Docteur::all();
        // dd($this->docteur);
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
        return new Channel('header-statistiques-doctor');
    }
}
