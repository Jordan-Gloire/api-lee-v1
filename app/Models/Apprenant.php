<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apprenant extends Model
{
    //
    protected $fillable = ['nom', 'prenom', 'telephone', 'date_naissance', 'lieu_naissance','adresse','ville'];
    public function formation()
    {
        return $this->belongsToMany(Formation::class,'apprenant_formation','apprenant_id','formation_id');
    }
}
