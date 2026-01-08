<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use App\Http\Requests\StoreTraitementRequest;
use App\Http\Requests\UpdateTraitementRequest;
use App\Models\Medicament;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TraitementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traitements = Traitement::all();
        return redirect()->back()->with('assurances', $traitements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Traitements/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTraitementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTraitementRequest $request)
    {
        $traitement = Traitement::create([
            'nomTraitement' => $request->nomTraitement,
        ]);
        if ($request->medicaments) {
            $medicaments = $request->medicaments;
            foreach ($medicaments as $medicament) {
                $NombreComprime = $medicament['NombreComprime'];
                $quantiteParJour = $medicament['quantiteParJour'];
                $dureeNombre = $medicament['dureeNombre'];
                $momentDePrise = $medicament['momentDePrise'];
                $duree = $medicament['duree'];
                // $typeOrdonnance = 'Normale';
                $traitement->Medicaments()->attach($medicament['id'], ['NombreComprime' => $NombreComprime, 'quantiteParJour' => $quantiteParJour, 'dureeNombre' => $dureeNombre, 'momentDePrise' => $momentDePrise, 'duree' => $duree]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Traitement  $traitement
     * @return \Illuminate\Http\Response
     */
    public function show(Traitement $traitement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Traitement  $traitement
     * @return \Illuminate\Http\Response
     */
    public function edit(Traitement $traitement)
    {
        // return Inertia::render(
        //     'Admin/Traitements/AddMedicament',
        //     [
        //         'traitement' => $traitement
        //     ]
        // );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTraitementRequest  $request
     * @param  \App\Models\Traitement  $traitement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTraitementRequest $request, Traitement $traitement)
    {
        // dd($request);
        $traitement->nomTraitement = $request->traitementV['nomTraitement'];
        $medicaments = $request->medicaments;
        if ($request->medicaments != null) {
            foreach ($medicaments as $medicament) {
                $NombreComprime = $medicament['NombreComprime'];
                $quantiteParJour = $medicament['quantiteParJour'];
                $momentDePrise = $medicament['momentDePrise'];
                $dureeNombre = $medicament['dureeNombre'];
                $duree =  $medicament['duree'];
                $traitement->Medicaments()->attach($medicament['id'], ['NombreComprime' => $NombreComprime, 'quantiteParJour' => $quantiteParJour, 'momentDePrise' => $momentDePrise, 'dureeNombre' => $dureeNombre, 'duree' => $duree]);
            }
        }
        $traitement->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Traitement  $traitement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Traitement $traitement, Medicament $medicament)
    {
        $trait = DB::table('medicaments_traitements')->where('traitement_id', '=', $traitement->id);
        $trait->delete();
        $traitement->delete();
        return redirect()->back();
    }

    public function deleteLigneTraitement($traitementId, $medicamentId)
    {
        $traitement = Traitement::findOrFail($traitementId);
        $medicament = Medicament::findOrFail($medicamentId);
        $traitement->medicaments()->detach($medicament);
        return redirect()->back();
    }

    public function updateLigneTraitement($traitementId, $medicament)
    {
        $medicamentData = json_decode($medicament);
        $traitement = Traitement::findOrFail($traitementId);
        $medicament = $traitement->Medicaments()->where('medicament_id', $medicamentData->medicament_id)->first();
        $traitement->Medicaments()->updateExistingPivot($medicament->id, [
            'NombreComprime' => $medicamentData->NombreComprime,
            'quantiteParJour' => $medicamentData->quantiteParJour,
            'momentDePrise' => $medicamentData->momentDePrise,
            'duree' => $medicamentData->duree,
            'dureeNombre' => $medicamentData->dureeNombre,
        ]);
        $medicament->save();
    }
}
