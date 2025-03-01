<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/inscription',[AuthController::class,'inscription']);
Route::post('/connexion',[AuthController::class,'connexion']);
Route::post('/deconnexion',[AuthController::class,'deconnexion'])->middleware('auth:sanctum');

Route::post('/modify_password',[AuthController::class,'modify_password'])->middleware('auth:sanctum');

Route::post('/add_apprenant',[AuthController::class,'store'])->middleware('auth:sanctum');
Route::get('/get_apprenants',[AuthController::class,'index'])->middleware('auth:sanctum');
Route::get('/get_apprenant/{id}',[AuthController::class,'show'])->middleware('auth:sanctum');
Route::post('/update_apprenant/{id}',[AuthController::class,'update'])->middleware('auth:sanctum');
Route::delete('/delete_apprenant/{id}',[AuthController::class,'destroy'])->middleware('auth:sanctum');

Route::resource('formations', FormationController::class)->middleware('auth:sanctum');
