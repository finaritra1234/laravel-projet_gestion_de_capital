<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
class Depense extends Model
{
    protected $fillable = [
        'date_depense','montant_depense','categorie_id','compte_id'
    ];
  
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function compte(){
        return $this->belongsTo('App\Models\Compte');
    }
}
