<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class SuivieDemandeController extends Controller
{
    /**
     * Display a listing of the demande of user connect.
     */
    public function getSuivieDemandes()
    {
        $demandes = DB::table('demandes')
        ->join('universites', 'demandes.universite_id', '=', 'universites.id')
        ->join('typedemandes', 'demandes.typedemande_id', '=', 'typedemandes.id')
        ->join('etablissements', 'demandes.etablissement_id', '=', 'etablissements.id')
        ->join('specialites', 'demandes.specialite_id', '=', 'specialites.id')
        ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
        ->join('exercices', 'demandes.exercice_id', '=', 'exercices.id')
        ->join('pays', 'demandes.pays_id', '=', 'pays.id')
        ->where('demandes.user_id', '=', 2)
        ->select('demandes.*','typedemandes.libelleType','universites.codeUniv','etablissements.codeEtab',
                'specialites.libelleSpec','niveaux.libelleNiv','pays.libellePays')
        ->get();

        if($demandes) {
            return response()->json([
                'statut' => 200,
                'message' => $demandes
            ], 200);
        } else {
            return response()->json([
                'statut' => 500,
                'message' => 'Erreur lors de la récupération des demandes'
            ], 500);

        }

    }

}
