<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function show($id)
    {
        $panier = Panier::with('produits')->where('user_id', $id)->first();
        return response()->json($panier);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produits' => 'required|array', 
            'produits.*.id' => 'required|exists:produits,id', 
            'produits.*.quantite' => 'required|integer|min:1', 
        ]);
    
        $totalPrice = 0;
        foreach ($request->produits as $produit) {
            $produitData = Produit::findOrFail($produit['id']);
            $totalPrice += $produitData->prix * $produit['quantite'];
        }
    
        $panier = Panier::create([
            'user_id' => $request->user_id,
            'prix_total' => $totalPrice,
        ]);
    
        foreach ($request->produits as $produit) {
            $panier->produits()->attach($produit['id'], ['quantite' => $produit['quantite']]);
        }
    
        return response()->json(['message' => 'Panier created successfully', 'panier' => $panier->load('produits')], 201);
    }
    
    public function ajouterArticle(Request $request, $panierId)
    {
        $panier = Panier::findOrFail($panierId);
        $produit = Produit::findOrFail($request->id); // Assurez-vous que c'est bien 'id'
    
        $quantite = $request->quantite ?? 1;
    
        // Utiliser syncWithoutDetaching pour mettre à jour ou ajouter la relation
        $panier->produits()->syncWithoutDetaching([
            $produit->id => ['quantite' => $quantite]
        ]);
    
        $this->updatePrixTotal($panier);
    
        return response()->json(['message' => 'Produit ajouté/mis à jour', 'panier' => $panier->refresh()]);
    }


    public function retirerArticle($panierId, $produitId)
    {
        $panier = Panier::findOrFail($panierId);
        $produit = Produit::findOrFail($produitId);

        $panier->produits()->detach($produit->id);

        $this->updatePrixTotal($panier);

        return response()->json(['message' => 'Produit retiré', 'panier' => $panier->refresh()]);
    }

    public function modifierQteArticle(Request $request, $panierId, $produitId)
    {
        $panier = Panier::findOrFail($panierId);
        $produit = Produit::findOrFail($produitId);
        $nouvelleQuantite = $request->quantite;

        $panier->produits()->updateExistingPivot($produit->id, ['quantite' => $nouvelleQuantite]);

        $this->updatePrixTotal($panier);

        return response()->json(['message' => 'Quantité modifiée', 'panier' => $panier->refresh()]);
    }

    private function updatePrixTotal(Panier $panier)
    {
        $total = 0;
        foreach ($panier->produits as $produit) {
            $total += $produit->prix * $produit->pivot->quantite;
        }
        $panier->update(['prix_total' => $total]);
    }
}
