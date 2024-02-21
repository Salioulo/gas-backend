<?php

namespace App\Http\Controllers;

use App\Models\Universite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UniversiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universites = DB::table('universites')
        ->where('etat', '=', true)
        ->get();

        if($universites){
            return response()->json([
                'statut' => 200,
                'universites' => $universites
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
       try{
        $validate = Validator::make($request->all(),[
            'codeUniv' => 'required',
            'libelleUniv' => 'required'
        ]);
        if($validate->fails()){
            return response()->json([
                'result' => false,
                'message' => $validate->errors()
            ], 401);
        }

        $universite = new Universite();

        $universite->codeUniv = $request->codeUniv;
        $universite->libelleUniv = $request->libelleUniv;
        $universite->saveOrFail();

        if($universite){
            return response()->json([
                'statut' => 200,
                'message' => 'Création réussie'
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Echec lors de la création'
            ], 500);
        }

       } catch (\Throwable $th) {
            return response()->json([
                'result' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Universite $universite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Universite $universite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Universite $universite)
    {
        //
    }
}
