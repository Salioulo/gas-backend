<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DetailsDemandeController extends Controller
{
    /**
     * Display a details demande.
     */
    public function getDetailsDemande($id){

        $details = DB::table('demandes')
        ->where('demandes.id', '=', $id)
        ->join('users', 'demandes.user_id', '=', 'users.id')
        ->join('universites', 'demandes.universite_id', '=', 'universites.id')
        ->join('etablissements', 'demandes.etablissement_id', '=', 'etablissements.id')
        ->join('specialites', 'demandes.specialite_id', '=', 'specialites.id')
        ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
        ->join('typedemandes', 'demandes.typedemande_id', '=', 'typedemandes.id')
        ->join('pays', 'demandes.pays_id', '=', 'pays.id')
        ->join('documents', 'documents.demande_id', '=', 'demandes.id')
        ->select('demandes.*','users.*','universites.codeUniv','etablissements.codeEtab',
            'specialites.libelleSpec','niveaux.libelleNiv','typedemandes.libelleType','pays.libellePays','documents.nomDoc','documents.chemin')
        ->first();

        if($details) {
            return response()->json([
                'statut' => 200,
                'message' => $details
            ], 200);
        } else{
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des données!'
            ], 500);

        }

    }
}
