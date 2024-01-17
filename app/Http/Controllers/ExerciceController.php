<?php

namespace App\Http\Controllers;

use App\Models\Exercice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercices = DB::table('exercices')
        ->where('statut','=', true)
        ->get();
        if($exercices) {
            return response()->json([
                'statut' => 200,
                'exercices' => $exercices
            ], 200);
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
        $request->validate([
            'libelleExer' => 'required'
        ]);

        $exercice = new Exercice();
        $exercice->libelleExer = $request->libelleExer;
       // $exercice->statut = $request->statut;
        $exercice->saveOrFail();

        if($exercice){
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
    public function show(Exercice $exercice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercice $exercice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercice $exercice)
    {
        //
    }
}
