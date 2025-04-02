<?php

namespace App\Http\Controllers;

use App\Models\Commande; // Importez le modèle Commande depuis App\Models
use App\Models\Panier;
use App\Models\User;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function createOrder($id)
{
    $panier = Panier::where('id', $id)->first();

    if ($panier) {
        $commande = new Commande([
            'user_id' => $panier->user_id,
            'status' => 'pending',
            'montant' => $panier->prix_total,
            'panier_id' => $panier->id,
        ]);

        $commande->save();
        return response()->json(['message' => 'Commande created']);
    } else {
        return response()->json(['message' => 'Panier non trouvé pour cet utilisateur'], 404);
    }
}
    public function index($id)
    {
        $customer = User::findOrFail($id); 
    
        $commande = $customer->commande; 
    
        if ($commande) {
            return response()->json($commande);
        } else {
            return response()->json(['message' => 'Commande non trouvée pour cet utilisateur'], 404);
        }
    }

    // after checking payemnet change status 

}
