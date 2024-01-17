<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etablissements = DB::table('etablissements')
        ->where('etat', '=', true)
        ->get();

        if($etablissements){
            return response()->json([
                'statut' => 200,
                'etablissements' => $etablissements
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec lors de la récupération'
            ], 500);
        }
    }

    public function getEtabByUniv($id){

        $etablisByUniv = DB::table('etablissements')
        ->where('universite_id', '=', $id)
        ->get();

        if($etablisByUniv){
            return response()->json([
                'statut' => 200,
                'message' => $etablisByUniv
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec lors de la récupération des établissements'
            ], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codeEtab' => 'required',
            'libelleEtab' => 'required',
            'universite' => 'required'
        ]);

        $etablissement = new Etablissement();

        $etablissement->codeEtab = $request->codeEtab;
        $etablissement->libelleEtab = $request->libelleEtab;
        $etablissement->universite_id = $request->universite;
        $etablissement->saveOrFail();

        if($etablissement){
            return response()->json([
                'statut' => 200,
                'message' => 'Création réussie'
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
    public function show(Etablissement $etablissement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etablissement $etablissement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etablissement $etablissement)
    {
        //
    }
}
