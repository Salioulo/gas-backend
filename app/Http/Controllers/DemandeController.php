<?php

namespace App\Http\Controllers;

use App\Mail\SendDemoMail;
use App\Models\Demande;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as FacadesMail;

class DemandeController extends Controller
{
    public function sendDemoMail()
    {
        //return 1;
        $email = 'zalesalioulo@gmail.com';

        $maildata = [
            'title' => 'Laravel Mail Sending Example with Markdown',
            'url' => 'https://www.positronx.io'
        ];

        FacadesMail::to($email)->send(new SendDemoMail($maildata));

        dd("Mail has been sent successfully");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $demandes = Demande::all();
        } catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($demandes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$user = Auth::user();
            $request->validate([
                //'statut' => 'required',
                //'etat' => 'required',
                'paysdem' => 'required',
                'typedemande' => 'required',
                'universite' => 'required',
                'etablissement' => 'required',
                'specialite' => 'required',
                'niveau' => 'required',
                'exercice' => 'required',
                'user' => 'required',
                'typeFiles' => 'required'
            ]);


            $demande = new Demande();
            //$demande->statut = $request->statut;
            //$demande->etat = $request->etat;
            $demande->pays_id = $request->paysdem;
            $demande->typedemande_id = $request->typedemande;
            $demande->universite_id = $request->universite;
            $demande->etablissement_id = $request->etablissement;
            $demande->specialite_id = $request->specialite;
            $demande->niveau_id = $request->niveau;
            $demande->exercice_id = $request->exercice;
            $demande->user_id = $request->user;
            $demande->saveOrFail();

            if($request->has('typeFiles'))
            $files = $request->typeFiles;

            foreach($files as $key => $value)
            {
                $file = time().$key.$value->getClientOriginalExtension();
                $namefile = $value->getClientOriginalName();
                $path = public_path('upload');
                $value->move($file, $path);

                $document = new Document();
                $document->nomDoc = $namefile;
                $document->chemin = $value;
                $document->etat = true;
                $document->demande_id = $demande->user_id;
                $document->saveOrFail();
            }

            if($demande){
                return response()->json([
                    'statut' => 200,
                    'message' => 'Création demande réussie'
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
    public function show($id)
    {
        try {
        $demande = Demande::find($id);
        } catch(\Exception $ex){
            return \response()->json($ex->getMessage());
        }
        return response()->json($demande, 200 ?? null);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'statut' => 'required',
                'etat' => 'required',
            ]);
            //return response()->json($request);
            $demande = Demande::FindOrFail($id);
            $demande->statut = $request->statut;
            $demande->etat = $request->etat;
            $demande->save();
        }catch (\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json($demande, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{

            $demande = Demande::find($id)->delete();

        }catch(\Exception $ex){
            return response()->json($ex->getMessage());
        }
        return response()->json('Delete success', 200);

    }
}
