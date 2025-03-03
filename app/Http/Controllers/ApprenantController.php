<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprenantFormRequest;
use App\Http\Resources\ApprenantRessource;
use App\Models\Apprenant;
use Illuminate\Http\Request;

class ApprenantController extends Controller
{
    // Afficher la liste des apprenants avc leurs formations
    public function index()
    {
        $apprenants = Apprenant::with('formations')->get();
        return ApprenantRessource::collection($apprenants);
    }

    // Afficher un apprenant avec ses formations
    public function show($id)
    {
        $apprenant = Apprenant::with('formations')->find($id);
        if(!$apprenant){
            return response()->json(['message' => 'Apprenant non trouvé'], 404);
        }
        return new ApprenantRessource($apprenant);
    }

    // Ajouter un apprenant
    public function store(ApprenantFormRequest $request)
    {
        $apprenant = Apprenant::create($request->validated());
        if (!$request->has('formations')) {
            return response()->json(['message' => 'Aucune formation selectionnée'],404);
        }
        // Attach les formations à l'apprenant
        $apprenant->formations()->attach($request->formations);
        return new ApprenantRessource($apprenant);
    }


    // Mettre à jour un apprenant
    public function update(ApprenantFormRequest $request, $id)
    {
        // Trouver l'apprenant
        $apprenant = Apprenant::find($id);
        if (!$apprenant) {
            return response()->json(['message' => 'Apprenant non trouvé'], 404);
        }

        // Mettre à jour les données de l'apprenant
        $apprenant->update($request->validated());

        // Si des formations sont passées dans la requête, les synchroniser
        if ($request->has('formations')) {
            $apprenant->formations()->sync($request->formations);
        }

        // Retourner la ressource de l'apprenant mise à jour
        return new ApprenantRessource($apprenant);
    }


    // Supprimer un apprenant
    public function destroy($id)
    {
        // Trouver l'apprenant par son ID
        $apprenant = Apprenant::find($id);

        if (!$apprenant) {
            return response()->json(['message' => 'Apprenant non trouvé'], 404);
        }

        // Vérifier si l'apprenant a des formations associées avant de les détacher
        if ($apprenant->formations->isNotEmpty()) {
            $apprenant->formations()->detach();
        }

        // Supprimer l'apprenant
        $apprenant->delete();

        // Retourner une réponse indiquant que l'apprenant a bien été supprimé
        return response()->json(['message' => 'Apprenant supprimé avec succès'], 200);
    }
}
