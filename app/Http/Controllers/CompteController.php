<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Compte;
use DB;
class CompteController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }
    public function compte () {

       //aficher le solde en haut a droit du navbar
       $compte = Compte::get()->first();
       $mont = $compte->solde;

        $solde = Compte::all();

        return view('compte.compte',['soldes' => $solde, 'mont' => $mont,]);
    }

    public function addCompte(Request $request) 
   {
      //validation
      $this->validate($request,[
         'solde' => 'required|numeric'
      ],[
         'solde.required' => 'Entrer le montant de votre compte',
         'solde.numeric' => 'Le montant est incorrecte',
      ]);

      if($request->solde <= 0) {
         Session::flash('error', 'Veuillez entrez le montant de votre solde');
         return redirect()->back();
      } else {
           //create admin
         Compte::create([
            'solde' => $request->solde,
            
        ]);
        Session::flash('success', 'Votre solde est ajouter avec succes!!!');
        return redirect()->back();
      }
   }
}
