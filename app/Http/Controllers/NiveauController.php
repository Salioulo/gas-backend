<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = DB::table('niveaux')
        ->where('etat', '=', true)
        ->get();
        if($niveaux){
            return response()->json([
                'statut' => 200,
                'niveaux' => $niveaux
            ], 200);
        }else {
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
        $request->validate([
            'libelleNiv' => 'required'
        ]);

        $niveau = new Niveau();
        $niveau = Niveau::create($request->all());

        if($niveau){
            return response()->json([
                'statut' => 200,
                'message' => 'Création réussie'
            ], 200);
        }else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec création'
            ], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        //
    }
}
