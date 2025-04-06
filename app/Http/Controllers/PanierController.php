<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PanierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure authentication is required
    }

    public function show()
    {
        $user = Auth::user();
        $panier = Panier::with('produits')->where('user_id', $user->id)->first();

        if (!$panier) {
            return response()->json(['message' => 'Aucun panier trouvé'], 404);
        }

        return response()->json($panier);
    }

    public function store(Request $request)
    {
        Log::info('Panier store request received', ['data' => $request->all()]);

        try {
            $user = Auth::user();

            // ✅ Validate request
            $validatedData = $request->validate([
                'produits' => 'required|array',
                'produits.*.id' => 'required|exists:produits,id',
                'produits.*.quantite' => 'required|integer|min:1',
            ]);

            Log::info('Validation passed', ['validatedData' => $validatedData]);

            // ✅ Calculate total price
            $totalPrice = 0;
            foreach ($request->produits as $produit) {
                $produitData = Produit::find($produit['id']);
                $totalPrice += $produitData->prix * $produit['quantite'];
            }
            Log::info("Total price calculated", ['totalPrice' => $totalPrice]);

            // ✅ Check if the user already has a panier
            $panier = Panier::firstOrCreate(
                ['user_id' => $user->id],
                ['prix_total' => $totalPrice]
            );

            // ✅ Attach products to panier
            foreach ($request->produits as $produit) {
                $panier->produits()->syncWithoutDetaching([
                    $produit['id'] => ['quantite' => $produit['quantite']]
                ]);
            }

            $this->updatePrixTotal($panier);

            return response()->json([
                'message' => 'Panier mis à jour avec succès',
                'panier' => $panier->load('produits')
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du panier : ' . $e->getMessage());
            return response()->json([
                'error' => 'Erreur lors de la création du panier.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function ajouterArticle(Request $request)
    {
        Log::info('Ajouter article request received', ['data' => $request->all()]);

        $user = Auth::user();
        $panier = Panier::where('user_id', $user->id)->firstOrFail();
        $produit = Produit::findOrFail($request->id);

        $quantite = $request->quantite ?? 1;

        $panier->produits()->syncWithoutDetaching([
            $produit->id => ['quantite' => $quantite]
        ]);

        $this->updatePrixTotal($panier);

        return response()->json(['message' => 'Produit ajouté/mis à jour', 'panier' => $panier->refresh()]);
    }

    public function retirerArticle($produitId)
    {
        Log::info('Retirer article request received', ['produitId' => $produitId]);

        $user = Auth::user();
        $panier = Panier::where('user_id', $user->id)->firstOrFail();
        $produit = Produit::findOrFail($produitId);

        $panier->produits()->detach($produit->id);

        $this->updatePrixTotal($panier);

        return response()->json(['message' => 'Produit retiré', 'panier' => $panier->refresh()]);
    }

    public function modifierQteArticle(Request $request, $produitId)
    {
        Log::info('Modifier quantité request received', ['data' => $request->all()]);

        $user = Auth::user();
        $panier = Panier::where('user_id', $user->id)->firstOrFail();
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
        Log::info("Prix total mis à jour", ['panierId' => $panier->id, 'nouveauPrixTotal' => $total]);
    }
}
