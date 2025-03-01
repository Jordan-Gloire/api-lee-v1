<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormationFormRequest;
use App\Http\Resources\FormationResource;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Affiche toutes les formations
        $formations = FormationResource::collection(Formation::paginate(10));
        return response()->json($formations, 200);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormationFormRequest $request)
    {
        // Logique pour enregistrer une nouvelle formation
        $formation = Formation::create($request->validated());
        return new FormationResource($formation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        // Affiche la formation spécifiée (injection implicite du modèle)
    	$formation = Formation::find($formation);
        if(!$formation){
            return response()->json('Formation non trouvée', 404);
        }    
        return new FormationResource($formation);    
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation)
    {
        // Logique pour mettre à jour la formation spécifiée
        $formation = Formation::find($formation);
        if(!$formation){
            return response()->json('Formation non trouvée', 404);
        }
        $formation->update($request->validated());
        return new FormationResource($formation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        // Logique pour supprimer la formation spécifiée
        $formation = Formation::find($formation);
        if(!$formation){
            return response()->json('Formation non trouvée', 404);
        }
        $formation->delete();
        return response()->json('Formation supprimée', 200);
    }
}
