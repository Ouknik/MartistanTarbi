<?php

namespace App\Http\Controllers;

use App\Events\Medicaments;
use App\Models\Ordonnance;
use App\Models\Medicament;
use App\Http\Requests\StoreOrdonnanceRequest;
use App\Http\Requests\UpdateOrdonnanceRequest;
use App\Models\Prescription;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class OrdonnanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrdonnanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrdonnanceRequest $request)
    {
        $docteur = User::where('type', 'docteur')->first();
        $date = date('Y-m-d');
        $medicaments = $request->medicaments;
        $ordonnance = new Ordonnance();
        $ordonnance->dateOrdonnance = $date;
        $ordonnance->consultation_id = $request->idConsultation;
        $ordonnance->patient_id = $request->patient;
        $ordonnance->user_id =  $docteur->id;
        $ordonnance->save();

        $this->InsertMedicamentPrescription($medicaments, 'normal', $ordonnance);
        // event(new Medicaments);

        return redirect()->back();
    }

    public function InsertMedicamentPrescription($medicaments, $type, $ordonnance)
    {
        foreach ($medicaments as $medicament) {
            $prescription = $medicament['prescription'];
            $medicamentId  = $medicament['medicament_id'];
            $ordonnance->Medicaments()->attach($medicamentId, ['prescription' => $prescription, 'typeOrdonnance' => $type]);
            if (isset($medicament['isChecked']) && $medicament['isChecked']) {
                Prescription::create([
                    'prescription' => $prescription,
                    'medicament_id' => $medicamentId
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function show(Ordonnance $ordonnance)
    {
        $ordonnances = Ordonnance::all();
        return Inertia::render(
            'Admin/Ordonnances/List',
            [
                'ordonnances' => $ordonnances
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordonnance $ordonnance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdonnanceRequest  $request
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdonnanceRequest $request, Ordonnance $ordonnance)
    {
        $medicamentOrdonnance = $request->Ordonnance['medicaments'];
        $ordonnance = Ordonnance::findOrFail($ordonnance->id);
        $medicaments = $request->medicaments;
        if ($medicaments) {
            foreach ($medicaments as $medicament) {
                $ordonnance->Medicaments()->attach($medicament['medicament_id'], [
                    'prescription' => $medicament['prescription'],
                    'typeOrdonnance' => 'normal'
                ]);
            }
        }
        foreach ($medicamentOrdonnance as $medicament) {
            DB::table('ordonnances_medicaments')
                ->where('ordonnance_id', $medicament['pivot']['ordonnance_id'])
                ->where('medicament_id', $medicament['pivot']['medicament_id'])
                ->update([
                    'prescription' => $medicament['pivot']['prescription'],

                ]);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordonnance $ordonnance)
    {
        $ordonnance->Medicaments()->detach();
        $ordonnance->delete();
        return redirect()->back();
    }

    public function deleteLigneOrdonnance($ordonnaceId, $medicamentId)
    {
        $ordonnance = Ordonnance::findOrFail($ordonnaceId);
        $medicament = Medicament::findOrFail($medicamentId);
        $ordonnance->medicaments()->detach($medicament);
        return redirect()->back();
    }
}
