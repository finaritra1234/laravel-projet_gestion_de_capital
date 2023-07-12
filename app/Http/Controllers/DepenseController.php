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

        //aficher le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;

        //les depense
        $dep = Depense::orderBy('created_at', 'desc')->with('categorie:id,nom_categorie')->paginate(20);
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;
        $now = Carbon::now()->format('Y-m-d');
        return view('depense.depense',[
            'deps' => $dep, 
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

    public function depense_now()
    {
        //aficher le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;

        //afficher commande auj
        $now = Carbon::now()->format('Y-m-d');
        $dep = Depense::orderBy('created_at', 'desc')->where('date_depense','like','%'.$now.'%')->with('categorie:id,nom_categorie')->paginate(20);
        return view('depense.depense',[
            'deps' => $dep, 
            'mont' => $mont,
            'cats' => $cats,
            'compte_id' => $compte_id,
            'now' => $now,
        ]);
    }

    public function depense_date()
    {
        //aficher le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;

        //afficher commande auj
        $now = Carbon::now()->format('Y-m-d');

        $date = \Request::get('date');
        $dep = Depense::orderBy('created_at', 'desc')->where('date_depense','like','%'.$date.'%')->with('categorie:id,nom_categorie')->paginate(20);
        return view('depense.depense',[
            'deps' => $dep, 
            'mont' => $mont,
            'cats' => $cats,
            'compte_id' => $compte_id,
            'now' => $now,
        ]);
    }

    public function depense_date_entre()
    {
        //aficher le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;

        //afficher commande auj
        $now = Carbon::now()->format('Y-m-d');

        $date1 = \Request::get('date_one');
        $date2 = \Request::get('date_two');
        $deps = Depense::whereBetween('date_depense', [$date1, $date2])
        ->with('categorie:id,nom_categorie')->paginate(20);
        return view('depense.depense',[
            'deps' => $deps, 
            'mont' => $mont,
            'cats' => $cats,
            'compte_id' => $compte_id,
            'now' => $now,
        ]);
    }
    public function depense_date_week()
    {
        //aficher le solde en haut a droit du navbar
        $depense = compte::get()->first();
        $mont = $depense->solde;
        //obtenir les categories
        $cats = Categorie::all();
        //obtenir le compte
        $comptes = Compte::get()->first();
        $compte_id = $comptes->id;

        //afficher commande auj
        $now = Carbon::now()->format('Y-m-d');
        //obtenir le semaine precedent
        $currentDate = Carbon::now();
       
        
        while ($currentDate->lessThan($currentDate)) {
            
            $currentDate->subDays(7);
        }
        $deps = Depense::whereBetween('date_depense', [$now, $currentDate])
        ->with('categorie:id,nom_categorie')->paginate(20);
        return view('depense.depense',[
            'deps' => $deps, 
            'mont' => $mont,
            'cats' => $cats,
            'compte_id' => $compte_id,
            'startOfWeek' => $currentDate,
          
            'now' => $now,
        ]);
    }

    public function deleteDepense($id){
        Depense::find($id)->delete();
        Session::flash('success','Depense supprimer avec succés');
        return redirect()->back();
    }

}
