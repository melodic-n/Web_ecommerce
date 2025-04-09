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
    
        Log::info('Panier details', ['panier' => $panier]);
    
        return response()->json($panier);
    }
    

    public function store(Request $request)
    {
        Log::info('Panier store request received', ['data' => $request->all()]);
    
        try {
            $user = Auth::user();
    
            // Validate request - expecting an array of products
            $validatedData = $request->validate([
                'produits' => 'required|array',
                'produits.*.id' => 'required|exists:produits,id',
                'produits.*.quantite' => 'required|integer|min:1',
            ]);
    
            Log::info('Validation passed', ['validatedData' => $validatedData]);
    
            // Calculate the total price of the cart
            $totalPrice = 0;
            foreach ($request->produits as $produit) {
                $produitData = Produit::find($produit['id']);
                $totalPrice += $produitData->prix * $produit['quantite'];
            }
    
            Log::info("Total price calculated", ['totalPrice' => $totalPrice]);
    
            // Check if the user already has a panier
            $panier = Panier::firstOrCreate(
                ['user_id' => $user->id],
                ['prix_total' => $totalPrice]
            );
    
            // Attach the products to the panier
            foreach ($request->produits as $produit) {
                $panier->produits()->syncWithoutDetaching([
                    $produit['id'] => ['quantite' => $produit['quantite']]
                ]);
            }
    
            // Update the total price after adding products
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
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Find or fail the panier for the authenticated user
        $panier = Panier::where('user_id', $user->id)->firstOrFail();
    
        // Find or fail the product that we are trying to add
        $produit = Produit::findOrFail($request->id);
    
        // Get the quantity from the request or set it to 1 if not provided
        $quantite = $request->quantite ?? 1;
    
        // Check if the requested quantity is available in stock
        if ($quantite > $produit->stock) {
            // If not enough stock, return an error response
            return response()->json([
                'message' => 'Stock insuffisant pour ce produit.',
                'available_stock' => $produit->stock
            ], 400); // 400 Bad Request
        }
    
        // If there's enough stock, add the product to the cart
        $panier->produits()->syncWithoutDetaching([
            $produit->id => ['quantite' => $quantite]
        ]);
    
        // Update the total price of the panier
        $this->updatePrixTotal($panier);
    
        // Return success response
        return response()->json([
            'message' => 'Produit ajouté/mis à jour',
            'panier' => $panier->refresh()
        ]);
    }
    
   // app/Http/Controllers/PanierController.php
   public function retirerArticle($produitId)
   {
       Log::info('Retirer article request received', ['produitId' => $produitId]);
   
       $user = Auth::user();
       $panier = Panier::where('user_id', $user->id)->firstOrFail();  // Find the user's cart
       $produit = Produit::findOrFail($produitId);  // Find the product by ID
   
       // Detach the product from the cart
       $panier->produits()->detach($produit->id);
   
       // Update the total price of the cart
       $this->updatePrixTotal($panier);
   
       // Return a response with the updated cart
       return response()->json(['message' => 'Produit retiré', 'panier' => $panier->refresh()]);
   }
   public function modifierQteArticle(Request $request, $produitId)
   {
       // Fetch the user's cart
       $panier = Panier::where('user_id', Auth::id())->first();
   
       if (!$panier) {
           Log::error("Panier not found for user: " . Auth::id());
           return response()->json(['message' => 'Panier non trouvé'], 404);
       }
   
       // Find the product in the cart
       $product = $panier->produits()->where('produit_id', $produitId)->first();
   
       if (!$product) {
           Log::error("Product not found in cart for product ID: $produitId");
           return response()->json(['message' => 'Produit non trouvé dans le panier'], 404);
       }
   
       // Check if the quantity is valid
       if ($request->quantite < 1) {
           return response()->json(['message' => 'Quantité invalide'], 400);
       }
   
       // Update the quantity
       $product->pivot->quantite = $request->quantite;
       $product->pivot->save();
   
       // Recalculate the total price
       $this->updatePrixTotal($panier);
   
       // Log updated panier details for debugging
       Log::info('Panier after updating quantity', ['panier' => $panier->load('produits')]);
   
       // Return updated cart data as JSON
       return response()->json([
           'message' => 'Quantité modifiée',
           'panier' => $panier->load('produits')
       ]);
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
