<?php

namespace App\Http\Controllers;

use App\Models\Secretaire;
use App\Http\Requests\StoreSecretaireRequest;
use App\Http\Requests\UpdateSecretaireRequest;
use Inertia\Inertia;

class SecretaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secretaires = Secretaire::all();
        return Inertia::render(
            'Admin/Secetaires/Index',
            [
                'Secretaires' => $secretaires
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = ['Agadir', 'Taoudant'];
        $nationnalites = ['Marocaine', 'Française'];
        return Inertia::render(
            'Admin/Secretaires/Create',
            [
                'nationnalites' => $nationnalites,
                'villes'=>$villes,
            ]

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSecretaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSecretaireRequest $request)
    {
        Secretaire::create([
            'cinSecretaire'  => $request->cinSecretaire,
            'nomSecretaire' => $request->nomSecretaire,
            'prenomSecretaire' => $request->prenomSecretaire,
            'dateNaissanceSecretaire' => $request->dateNaissanceSecretaire,
            'telephoneSecretaire' => $request->telephoneSecretaire,
            'adresseSecretaire' => $request->adresseSecretaire,
            'sexeSecretaire' => $request->sexeSecretaire,
            'villeSecretaire' => $request->villeSecretaire,
            'emailSecretaire' => $request->emailSecretaire,
            'nationaliteSecretaire' => $request->nationaliteSecretaire,
            'descriptionSecretaire' => $request->descriptionSecretaire,
        ]);
        //sleep(1);
          return redirect()->route('docteurs.index')->with('message', ' Secretaire Ajouter avec Succee');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secretaire  $secretaire
     * @return \Illuminate\Http\Response
     */
    public function show(Secretaire $secretaire)
    {
        $secretaires = Secretaire::all();
        return Inertia::render(
            'Admin/Secretaires/Show',
            [
                'secretaies' => $secretaires,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secretaire  $secretaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Secretaire $secretaire)
    {
        return Inertia::render(
            'Admin/Secretaires/Edit',
            []
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSecretaireRequest  $request
     * @param  \App\Models\Secretaire  $secretaire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSecretaireRequest $request, Secretaire $secretaire)
    {
            $secretaire->cinSecretaire  =  $request->cinSecretaire;
            $secretaire->nomSecretaire = $request->nomSecretaire;
            $secretaire->prenomSecretaire = $request->prenomSecretaire;
            $secretaire->dateNaissanceSecretaire = $request->dateNaissanceSecretaire;
            $secretaire->telephoneSecretaire = $request->telephoneSecretaire;
            $secretaire->adresseSecretaire = $request->adresseSecretaire;
            $secretaire->sexeSecretaire = $request->sexeSecretaire;
            $secretaire->villeSecretaire = $request->villeSecretaire;
            $secretaire->emailSecretaire = $request->emailSecretaire;
            $secretaire->nationaliteSecretaire = $request->nationaliteSecretaire;
            $secretaire->descriptionSecretaire = $request->descriptionSecretaire;

        $secretaire->save();
        return redirect()->route('message','Secretaire Modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secretaire  $secretaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secretaire $secretaire)
    {
        $secretaire->delete();
        return redirect()->route('secretaire.index')->with('message','Secretaire SUpprimé avec succés');
    }
}
