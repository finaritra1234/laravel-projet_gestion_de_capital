<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
class AdminController extends Controller
{
   
   public function __construct()
   {
       $this->middleware('auth:admin');
      
   }
 
   public function index(){
       //aficher le solde en haut a droit du navbar
       $compte = Compte::get()->first();
       $mont = $compte->solde;

      return view('admin' ,['mont' => $mont]);
   }

   
}
