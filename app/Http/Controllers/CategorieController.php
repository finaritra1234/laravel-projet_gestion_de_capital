<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Compte;
use Session;
class CategorieController extends Controller
{
    public function __construct()
    {
       
        $this->middleware('auth:admin');

       
    }
    public function categorie () {
        //aficher le solde en haut a droit du navbar
        $compte = Compte::get()->first();
        $mont = $compte->solde;

        $cat= Categorie::all();
        return view('categorie.categorie',['mont' => $mont, 'cats'=> $cat]);
    }

    public function addCategorie(Request $request) 
   {
        //validation
        $this->validate($request,[
            'nom_categorie' => 'required'
        ],[
            'nom_categorie.required' => 'Entrer le nom de la categorie de depense',
        
        ]);

        //creer categorie
        Categorie::create([
            'nom_categorie' => $request->nom_categorie,
            
        ]);
        Session::flash('success', 'Votre categorie est ajouter avec succes!!!');
        return redirect()->back();
      
   }

   public function deleteCategorie($id){
        Categorie::find($id)->delete();
        Session::flash('success','Depense supprimer avec succés');
        return redirect()->back();
   }
}
