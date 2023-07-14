<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depense;
use App\Models\Compte;
use App\Models\Categorie;
use Session;
use Carbon\Carbon;
class DepenseController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    public function depense () 
    {

        //afideper le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;

        //les depense
        $dep = Depense::orderBy('created_at', 'desc')->with('categorie:id,nom_categorie')->paginate(20);
        //affideper commande auj
        $now = Carbon::now()->format('Y-m-d');
        $dep_now = Depense::orderBy('created_at', 'desc')->where('date_depense','like','%'.$now.'%')->with('categorie:id,nom_categorie')->paginate(20);
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;
        $now = Carbon::now()->format('Y-m-d');
        return view('depense.depense',[
            'deps' => $dep, 
            'dep_now' => $dep_now, 
            'mont' => $mont,
            'cats' => $cats,
            'compte_id' => $compte_id,
            'now' => $now,
        ]);
    }

    public function addDepense(Request $request)
    {
        //Validation
        $this->validate($request, [
           
            'montant_depense' => 'required|numeric',
            'categorie_id' => 'required',
            'compte_id' => 'required',
        ]);
       
      
        //Obtenir le solde du compte
        $compte = Compte::where('id',$request->compte_id)->first();
        $solde_compte = $compte->solde;
        $nouveau_solde_compte =  $solde_compte - $request->montant_depense;
        if($request->montant_depense <= 0) {
            Session::flash('error','Entrer le montant de la depense');
            return redirect()->back();
        } else {
           

            if($solde_compte < $request->montant_depense )
            {
                Session::flash('error','Le solde de votre compte est insuffisant');
                return redirect()->back();
            } else {
                //Mise  a jour du solde du compte
                $now = Carbon::now()->format('Y-m-d');
                $compte->solde = $nouveau_solde_compte;
                $compte->update();
                //sauvegarder au table depense
              
                $depense = new Depense();
               
                if($request->date_depense == ''){
                    $depense->date_depense =   $now;
                }else{
                    $depense->date_depense =   $request->date_depense;
                }
               
                $depense->montant_depense = $request->montant_depense;
                $depense->categorie_id = $request->categorie_id;
                $depense->compte_id = $request->compte_id;
        
                $depense->save();
    
                Session::flash('success','La depense est enregister avec success!');
                return redirect()->back();
            }
        }

        

       

        
     
    }

    

    public function depense_date()
    {
        //afideper le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;

        //affideper commande auj
        $now = Carbon::now()->format('Y-m-d');

        $date = \Request::get('date');
        $dep = Depense::orderBy('created_at', 'desc')->where('date_depense','like','%'.$date.'%')->with('categorie:id,nom_categorie')->paginate(20);
         //affideper commande auj
        
         $dep_now = Depense::orderBy('created_at', 'desc')->where('date_depense','like','%'.$now.'%')->with('categorie:id,nom_categorie')->paginate(20);
        return view('depense.depense',[
            'deps' => $dep, 
            'dep_now' => $dep_now, 
            'mont' => $mont,
            'cats' => $cats,
            'compte_id' => $compte_id,
            'now' => $now,
        ]);
    }

    public function depense_date_entre()
    {
        //afideper le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;

        //affideper commande auj
        $now = Carbon::now()->format('Y-m-d');

        $date1 = \Request::get('date_one');
        $date2 = \Request::get('date_two');
        $deps = Depense::whereBetween('date_depense', [$date1, $date2])->with('categorie:id,nom_categorie')->paginate(20);
         //affideper commande auj
       
         $dep_now = Depense::orderBy('created_at', 'desc')->where('date_depense','like','%'.$now.'%')->with('categorie:id,nom_categorie')->paginate(20);
        return view('depense.depense',[
            'deps' => $deps, 
            'dep_now' => $dep_now, 
            'mont' => $mont,
            'cats' => $cats,
            'compte_id' => $compte_id,
            'now' => $now,
        ]);
    }
   

    public function deleteDepense($id){
        Depense::find($id)->delete();
        Session::flash('success','Depense supprimer avec succés');
        return redirect()->back();
    }

    public function editDepense($id){
         //obtenir les categories
         $cats = Categorie::all();
         //obtenir la depense a modifier
        $dep = Depense::find($id);
       
        return view('depense.edit',
          [
            'dep'=> $dep,
            'cats' => $cats
          ]);
   }

    public function editDepenseSubmit(Request $request,$id){
        //Validation
        $this->validate($request, [
            
            'montant_depense' => 'required|numeric',
            'categorie_id' => 'required',
            'date_depense' => 'required',
        ]);
   
    
        $dep =  Depense::find($id);
        $dep->montant_depense = $request->montant_depense;
        $dep->categorie_id = $request->categorie_id;
        $dep->date_depense = $request->date_depense;
        $dep->update();
        Session::flash('success','La depense N° : '.$request->id.' a eté  modifier avec succes');

        return redirect()->back();
        
    }

    public function annulerDepense($id){

       
        $dep = Depense::find($id);
        //obteni id du compte
        $compte = Compte::where('id',$dep->compte_id)->first();
        //obtenir le solde du compte
        $solde_compte = $compte->solde;
        //mis a jour du solde
        $nouveau_solde_compte =  $solde_compte + $dep->montant_depense;
        $compte->solde = $nouveau_solde_compte;
        $compte->update();

        //effacer la depense
        Depense::find($id)->delete();
        Session::flash('success','Depense annuler avec succés');
        return redirect()->back();
    }

}
