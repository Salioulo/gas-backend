<?php

namespace App\Http\Controllers;

use App\Models\Document;
use http\Env\Response;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $fileName = $request->nom. time() . '.' . $request->file->extension();
            $request->file->storeAs('public/images', $fileName);

            $document = new Document();
            $document->nom = '';
            $document->chemin = $fileName;
            $document->etat = true;
            $document->demande_id = $request->demande_id;
            $document->saveOrFail();

        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($document, 200);

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
