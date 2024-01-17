<?php

namespace App\Http\Controllers;

use App\Models\Typedemande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypedemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typedemandes = Typedemande::all();

        if($typedemandes){
            return response()->json([
                'statut' => 200,
                'typedemandes' => $typedemandes
            ], 200);
        }else{
            return response()->json([
                'statut' => 500,
                'message' => 'Erreure lors de la récupération des données'
            ], 500);
        }

        /*try {
        $typedemandes = Typedemande::all();

        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($typedemandes, 200 ?? null);*/
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'libelleType' => 'required',
                //'etat' => 'required'
            ]);
            $typedemande = Typedemande::create($request->all());
            $typedemande->saveOrFail();

        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($typedemande, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $typedemande = Typedemande::find($id);

        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($typedemande);
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
        $typedemande = Typedemande::find($id);
        $typedemande->update($request->all());
        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($typedemande, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        $typedemande = Typedemande::find($id)->delete();
        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json('Success', 'Supression réussie');

    }
}
