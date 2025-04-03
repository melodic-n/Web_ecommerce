<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/panier', [PanierController::class, 'store']);
    Route::post('/panier/{id}/ajouter', [PanierController::class, 'ajouterArticle']);
    Route::delete('/panier/{id}/retirer/{produitId}', [PanierController::class, 'retirerArticle']);
    Route::put('/panier/{id}/modifier/{produitId}', [PanierController::class, 'modifierQteArticle']);
    Route::get('/commande/{id}', [CommandeController::class, 'index']);
    Route::post('/commandes/create', [CommandeController::class, 'createOrder']);
    Route::get('/paniers', [PanierController::class, 'show']);
});


Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/test', function () {
        return response()->json(['message' => 'Admin access granted']);
    });
});
// routes/web.php or routes/api.php

Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');