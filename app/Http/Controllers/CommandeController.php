<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
    }

    public function createOrder(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
    
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }
    
        $panier = Panier::where('user_id', $user->id)->first();
    
        if (!$panier) {
            return response()->json(['message' => 'Panier non trouvé pour cet utilisateur'], 404);
        }
    
        $commande = new Commande([
            'user_id' => $user->id,
            'status' => 'pending',
            'montant' => $panier->prix_total,
            'panier_id' => $panier->id,
        ]);
    
        $commande->save();
    
        return response()->json([
            'message' => 'Commande créée avec succès',
            'commande' => $commande
        ]);
        
    }
    
    public function index()
{
    if (auth()->user()->role === 'admin') {
        $commandes = Commande::with(['user', 'panier'])->get();
        return view('admin.dashboard', compact('commandes')); // Will merge with other data
    }
    return view('customer.commande');

}public function showOrderSummary()
{
    $cart = session('cart', []); 
    $total = array_reduce($cart, function($carry, $product) {
        return $carry + floatval(str_replace(' MAD', '', $product['prix']));
    }, 0);

    dd($cart, $total); // Dump the cart and total for debugging
    return view('order-summary', compact('cart', 'total'));
}


 // Process the order (after payment)
 public function processOrder(Request $request)
 {
     // change commande status to confirmed
     return redirect()->route('order.confirmation');
 }
}
