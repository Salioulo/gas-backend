<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DetailsDemandeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\SuivieDemandeController;
use App\Mail\SendDemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** ---------Register and Login ----------- */
Route::controller(RegisterController::class)->group(function()
{
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('users', 'index')->name('index');

});

Route::resource('pays', \App\Http\Controllers\PaysController::class);
Route::resource('typedemande', \App\Http\Controllers\TypedemandeController::class);
Route::resource('document', \App\Http\Controllers\DocumentController::class);
Route::resource('demande', \App\Http\Controllers\DemandeController::class);
Route::resource('demande', \App\Http\Controllers\DemandeController::class);
Route::resource('exercice', \App\Http\Controllers\ExerciceController::class);
Route::resource('niveau', \App\Http\Controllers\NiveauController::class);
Route::resource('specialite', \App\Http\Controllers\SpecialiteController::class);
Route::resource('etablissement', \App\Http\Controllers\EtablissementController::class);
Route::resource('universite', \App\Http\Controllers\UniversiteController::class);

Route::get('universite/{id}/etablissements', [EtablissementController::class, 'getEtabByUniv']);
Route::get('etablissement/{id}/specialites', [SpecialiteController::class, 'getSpecialiteByEtab']);
Route::get('suivie-demande', [SuivieDemandeController::class, 'getSuivieDemandes']);
Route::get('demande/{id}/details', [DetailsDemandeController::class, 'getDetailsDemande']);
Route::get('fichier/{nomFile}/download', [DocumentController::class, 'downloadFile']);

Route::get('send-mail', [DemandeController::class, 'sendDemoMail']);
