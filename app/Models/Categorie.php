<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'nom_categorie'
    ];
   
    public function depense(){
        return $this->hasMany('App\Models\Depense');
    }
}
