<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApprenantRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone' => $this->telephone,
            'date_naissance' => $this->date_naissance,
            'adresse' => $this->adresse,
            'ville' => $this->ville,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'formations' => FormationResource::collection($this->formations),
        ];
    }
}
