<?php

namespace App\Http\Controllers;

use App\Events\Medicaments;
use App\Models\Medicament;
use App\Http\Requests\StoreMedicamentRequest;
use App\Http\Requests\UpdateMedicamentRequest;
use Faker\Provider\Medical;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicaments = DB::table('medicaments')->get();
        return redirect()->back()->with('medicaments', $medicaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Medicaments/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicamentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicamentRequest $request)

    {
        $data = [
            'codeMedicament' => $request->codeMedicament,
            'nomMedicament' => $request->nomMedicament,
            'formeMedicament' => $request->formeMedicament,
            'presentationMedicament' => $request->presentationMedicament,
            'prixMedicament' => $request->prixMedicament,
            'uniteMessure' => $request->uniteMessure,
        ];
        if ($request->dosageMedicament !== null) {
            $data['dosageMedicament'] = $request->dosageMedicament;
        } else {
            $data['dosageMedicament'] = '';
        }

        if ($request->uniteDosageMedicament !== null) {
            $data['uniteDosageMedicament'] = $request->uniteDosageMedicament;
        } else {
            $data['uniteDosageMedicament'] = '';
        }

        Medicament::create($data);

        event(new Medicaments());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function show(Medicament $medicament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicament $medicament)
    {
        return Inertia::render(
            'Admin/Medicaments/Edit',
            [
                'medicament' => $medicament
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicamentRequest  $request
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicamentRequest $request, Medicament $medicament)
    {
        $medicament->codeMedicament = $request->codeMedicament;
        $medicament->nomMedicament = $request->nomMedicament;
        $medicament->formeMedicament = $request->formeMedicament;
        $medicament->presentationMedicament = $request->presentationMedicament;
        $medicament->prixMedicament = $request->prixMedicament;
        $medicament->uniteMessure = $request->uniteMessure;

        if ($request->dosageMedicament !== null) {
            $medicament->dosageMedicament = $request->dosageMedicament;
        } else {
            $medicament->dosageMedicament = '';
        }

        if ($request->uniteDosageMedicament !== null) {
            $medicament->uniteDosageMedicament = $request->uniteDosageMedicament;
        } else {
            $medicament->uniteDosageMedicament = '';
        }

        $medicament->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicament $medicament)
    {
        $medicament->delete();
        return redirect()->back();
    }
}
