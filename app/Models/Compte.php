<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $fillable = [
        'solde'
    ];
    public function transaction(){
        return $this->hasMany('App\Models\Transaction');
    }
    public function depense(){
        return $this->hasMany('App\Models\Depense');
    }
}
