<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormationResource extends JsonResource
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
            'description' => $this->description,
            'prix' => $this->prix,
            'nombre_heures' => $this->nombre_heures,
            'nombre_de_modules' => $this->nombre_de_modules,
            'nombre_de_cours' => $this->nombre_de_cours,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
