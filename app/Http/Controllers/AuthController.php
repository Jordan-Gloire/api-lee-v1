<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function inscription(RegisterFormRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        $message = 'Utilisateur créé avec succès';
        $code = 201;
        return response()->json(['user' => $user, 'token' => $token, 'message' => $message, 'code' => $code], 201);
    }
    // public function connexion(LoginFormRequest $request)
    // {
    //     $user = User::where('email', $request->email)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'user' => $user,
    //             'token' => $token,
    //             'message' => 'Connexion réussie',
    //             'code' => 200
    //         ], 200);
    //     }

    //     return response()->json([
    //         'message' => 'Email ou mot de passe incorrect',
    //         'code' => 401
    //     ], 401);
    // }


    public function connexion(LoginFormRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                "message" => "Informations d'identification non valides",
            ], 401);
        }
        $token    = $user->createToken("token")->plainTextToken;
        $response = [
            "user"  => $user,
            "token" => $token,
        ];
        return response($response, 201);
    }
    public function deconnexion(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie', 'code' => 200], 200);
    }

    public function modify_password(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Vérifier si le mot de passe actuel est correct
        if (Hash::check($request->current_password, $request->user()->password)) {
            try {
                // Mise à jour du mot de passe
                $request->user()->update(['password' => Hash::make($request->new_password)]);
                return response()->json(['message' => 'Mot de passe modifié avec succès', 'code' => 200], 200);
            } catch (\Exception $e) {
                // Gestion d'erreur si la mise à jour échoue
                return response()->json(['message' => 'Une erreur est survenue. Veuillez réessayer.', 'code' => 500], 500);
            }
        }
        // Si le mot de passe actuel est incorrect
        return response()->json(['message' => 'Mot de passe actuel incorrect', 'code' => 401], 401);
    }
}
