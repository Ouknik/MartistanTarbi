<?php

namespace App\Events;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class AddToListPatient implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $patients;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {

        $date = Carbon::now()->toDateString();

        $patients  = Patient::active()
            ->with(['factures', 'consultations.factures', 'ReglementFacture.docteur', 'rendezVous' => function ($query) use ($date) {
                $query->where('dateRendezVous', '>=', $date)->orderBy('dateRendezVous', 'asc')
                    ->with('docteur');
            }])

            ->paginate(5);

        // dd($this->patients);
        $this->patients = $patients->toArray();
    }

    public function broadcastWith()
    {
        return [
            'patients' => $this->patients
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('add-to-list-patients');
    }
}
