<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $documents = Document::all();
        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($documents, 200 ?? null);
    }


    public function downloadFile($nomFile){

        $path = storage_path('app/public/documents/'.$nomFile);

        if($path){
            return response()->download($path);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec lors de la récupération'
            ], 500);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->file('files')){

            foreach($request->file('files') as $key => $file)
          {
              $fileName = time().'.'.$file->extension();
              $file->move(public_path('documents'), $fileName);

              $document = new Document();
              $document->nomDoc = $fileName;
              $document->chemin = $file;
              $document->etat = true;
              $document->demande_id = $request->demande_id;
              $document->saveOrFail();
          }
          }
          if($document){
            return response()->json([
                'statut' => 200,
                'message' => 'Création document réussie'
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec lors de la récupération'
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $document = Document::find($id)->delete();

        } catch (\Exception $ex){
            return \response()->json($ex->getMessage());
        }
        return \response()->json('Success', 200);

    }
}
