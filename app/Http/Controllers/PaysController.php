<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = DB::table('pays')
        ->where('etat', '=', true)
        ->get();

        if($pays){
            return response()->json([
                'statut' => 200,
                'pays' => $pays
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => "Echec lors de la création"
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libellePays' => 'required|unique:pays,libellePays',
        ]);

        $pays = Pays::create($request->all());
        $pays->saveOrFail();

        if($pays){
            return response()->json([
                'statut' => 200,
                'message' => "Cération réussie"
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => "Echec lors de la création"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
        $pays = Pays::find($id);

        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($pays);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required',
            'etat' => 'required'
        ]);
        try {
        $pays = Pays::find($id);
        $pays->libelle = $request->libelle;
        $pays->etat = $request->etat;
        $pays->save();
        } catch (\Exception $ex){
            return \response()->json($ex->getMessage());
        }
        return response()->json($pays, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        $pays = Pays::find($id)->delete();
        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json('success', '200');
    }
}
