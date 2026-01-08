<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Http\Requests\StoreCertificatRequest;
use App\Http\Requests\UpdateCertificatRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;


class CertificatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificats = Certificat::with('patients')->get();
        return Certificat::render(
            'Admin/Certificats/Listcertificat',
            [
                'certificats' => $certificats,
            ]
        );
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Certificats/CreateCertificat'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificatRequest $request)
    {
        // dd($request->typeCertificat);
        $duree = 0;
        $docteur = User::where('type', 'docteur')->first();
        Certificat::create([
            'dateCertificat' => $request->dateCertificat,
            'typeCertificat' => $request->typeCertificat,
            'contenu' => $request->contenu,
            'duree' => $duree,
            'patient_id' => $request->patient_id,
            'user_id' => $docteur->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificat  $certificat
     * @return \Illuminate\Http\Response
     */
    public function show(Certificat $certificat)
    {
        $certificats = Certificat::with('patients')->get();
        return Certificat::render(
            'Admin/Certificats/Listcertificat',
            [
                'certificats' => $certificats,
            ]
        );
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificat  $certificat
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificat $certificat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificatRequest  $request
     * @param  \App\Models\Certificat  $certificat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificatRequest $request, Certificat $certificat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificat  $certificat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificat $certificat)
    {
        $certificat->delete();
        return redirect()->back();
    }
}
