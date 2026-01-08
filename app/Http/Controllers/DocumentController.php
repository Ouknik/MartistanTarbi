<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use Faker\Core\File;
use Inertia\Inertia;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::with('patients')->get();
        return Inertia::render(
            'Admin/Documents/ListDocument',
            [
                'documents'=>$documents,
            ]);
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
            'Admin/Documents/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {
        $patient = $request->patient['id'];
        $request->validate([
            'pathDocument' => 'file|mimes:jpg,png,jpeg,gif,svg,pdf|max:4096', // Updated validation rule
        ]);
        $document_path = '';
        if ($request->hasFile('pathDocument')) {
            $file = $request->file('pathDocument');
            // Generating a unique name for the file
            $file_name = time() . '_' . $file->getClientOriginalName();
            // Storing image or PDF file in the 'E-Documents' folder within the 'public' disk
            $document_path = $file->storeAs('E-Documents', $file_name, 'public');
            move_uploaded_file($file,$document_path);
        }
        Document::create([
            'nomDocument' => $request->nomDocument,
            'pathDocument' => $document_path,
            'patient_id' => $patient,
        ]);
    
        return redirect()->back();

        // $patient=$request->patient['id'];
        // $request->validate([
        //     'pathDocument' => 'image|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
        // ]);
        // $image_path = '';
        // if ($request->hasFile('pathDocument')) {
        //     $image_path = $request->file('pathDocument')->store('E-Documents', 'public');
        //     move_uploaded_file($request->file('pathDocument'),$image_path);
        // }
        // Document::create([
        //     'nomDocument' => $request->nomDocument,
        //     'pathDocument' => $image_path,
        //     'patient_id'=>$patient,
        // ]);
        // return redirect()->back();
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return Inertia::render(
            'Admin/Documents/Edit',
            [
                'document' => $document
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentRequest  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->nomDocument = $request->nomDocument;
        $document->pathDocument = $request->pathDocument;
        $document->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->back();
    }
}
