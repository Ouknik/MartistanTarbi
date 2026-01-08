<?php

namespace App\Http\Controllers;

use App\Models\Soin;
use App\Http\Requests\StoreSoinRequest;
use App\Http\Requests\UpdateSoinRequest;
use Inertia\Inertia;

class SoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $soin = Soin::all();
        // return Inertia::render('Admin/Soins/Index', [
        //     'soins' => $soin,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Admin/Soins/Create',
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSoinRequest $request)
    {
        $image_path = '';

        if ($request->pathSoin) {
            $request->validate([
                'pathSoin' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            if ($request->hasFile('pathSoin')) {
                $image_path = $request->file('pathSoin')->store('images/Soins', 'public');
                move_uploaded_file($request->file('pathSoin'), $image_path);
            }
        } else {
            $image_path = 'images/Soins/soins.png';
        }

        Soin::create([
            'libelleSoin' => $request->libelleSoin,
            'montantSoin' => $request->montantSoin,
            'pathSoin' => $image_path,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soin  $soin
     * @return \Illuminate\Http\Response
     */
    public function show(Soin $soin)
    {
        return Inertia::render('Admin/Soins/Show', []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soin  $soin
     * @return \Illuminate\Http\Response
     */
    public function edit(Soin $soin)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSoinRequest  $request
     * @param  \App\Models\Soin  $soin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoinRequest $request, Soin $soin)
    {
        $soin->libelleSoin = $request->libelleSoin;
        $soin->montantSoin = $request->montantSoin;
        $soin->save();
        return redirect()->back()->with('message', 'Assurance modifié avec succés');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soin  $soin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soin $soin)
    {
        $soin->delete();
        return redirect()->back();
    }
}
