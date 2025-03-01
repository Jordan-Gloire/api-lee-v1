<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    //
    protected $fillable = ['nom', 'description', 'prix', 'date_debut', 'date_fin', 'nombre_heures', 'nombre_de_modules', 'nombre_de_cours'];
    public function apprenants()
    {
        return $this->belongsToMany(Apprenant::class,'apprenant_formation','formation_id','apprenant_id');  
    }
}
