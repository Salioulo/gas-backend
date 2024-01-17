<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SpecialiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialites = DB::table('specialites')
        ->where('etat', '=', true)
        ->get();

        if($specialites){
            return response()->json([
                'statut' => 200,
                'specialites' => $specialites
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec création'
            ], 500);

        }
    }

    public function getSpecialiteByEtab($id){

        $specilitesByEtab = DB::table('specialites')
        ->where('etablissement_id', '=', $id)
        ->get();

        if($specilitesByEtab){
            return response()->json([
                'statut' => 200,
                'message' => $specilitesByEtab
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec lors de la récupération des spécialités'
            ], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'libelleSpec' => 'required',
            'etablissement' => 'required'
        ]);
        //return response()->json($request);

       $specialite = new Specialite();
       $specialite->libelleSpec = $request->libelleSpec;
       $specialite->etablissement_id = $request->etablissement;
       $specialite->saveOrFail();

        if($specialite){
            return response()->json([
                'statut' => 200,
                'message' => 'Création réussie'
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec création'
            ], 500);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Specialite $specialite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialite $specialite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialite $specialite)
    {
        //
    }
}
