<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class CommandeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get the authenticated user's panier (cart)
        $panier = Panier::where('user_id', auth()->id())->first();  // Get the panier for the logged-in user

        if (!$panier) {
            return redirect()->route('home')->with('error', 'Panier not found for the given user.');
        }

        // Get the cart items and total amount
        $cartItems = $panier->produits;  // Assuming you have the 'produits' relationship
        $totalAmount = $panier->prix_total;

        // Get the authenticated user's customer data
        $customer = Auth::user()->customer; // Assuming the 'customer' relation on User

        // If the customer relation is missing, fallback to the user data
        if (!$customer) {
            $customer = Auth::user(); // Use the user data directly if customer relation is missing
        }

        // Pass the user and customer data to the view
        return view('customer.commande', compact('cartItems', 'totalAmount', 'panier', 'customer'));
    }public function store(Request $request)
    {
        // Enable query log
        DB::enableQueryLog();
        
        // Log incoming request data
        Log::info('Commande data:', $request->all());
        
        // Validate incoming data
        $validated = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'adresse' => 'required',
            'total_amount' => 'required|numeric',
            'panier_id' => 'required|exists:paniers,id',  // Ensure panier exists in the database
        ]);
        
        // Fetch the panier using panier_id
        $panier = Panier::with('produits')->find($request->panier_id);
        
        if (!$panier) {
            return response()->json([
                'success' => false,
                'message' => 'Panier not found.',
            ]);
        }
        
        // Prepare the cart data (product details from the panier)
        $cartData = $panier->produits->map(function ($produit) {
            return [
                'product_id' => $produit->id,  // Assuming product has `id`
                'quantity' => $produit->pivot->quantite,  // Get quantity from the pivot table
                'price' => $produit->prix,  // Assuming product has `prix`
                'nom_prod' => $produit->nom_prod,  // Add product name here
            ];
        });
    
        // Calculate the total price of the cart
        $totalPrice = $panier->produits->sum(function ($produit) {
            return $produit->pivot->quantite * $produit->prix; // Multiply quantity by product price
        });
        
        // Create a new Commande (order)
        $commande = new Commande();
        $commande->user_id = auth()->id();
        $commande->status = 'pending';  // Order is initially pending
        $commande->montant = $totalPrice;  // Set the total price of the order
        $commande->livraison_info = json_encode([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'tel' => $request->tel,
            'adresse' => $request->adresse,
        ]);
        $commande->cart_data = json_encode($cartData);  // Store the cart data as JSON
        $commande->panier_id = $request->panier_id;  // Associate the panier with the order
        
        // Attempt to save the order
        $isSaved = $commande->save();
        
        // Log if saving the order was successful
        Log::info('Commande saved:', ['success' => $isSaved, 'orderId' => $commande->id]);
        
        // Log any database queries
        Log::info('SQL Queries: ' . json_encode(DB::getQueryLog()));
        
        // If the order was saved successfully
        if ($isSaved) {
            // Loop through each product in the panier and decrease its stock
            foreach ($panier->produits as $produit) {
                $quantiteOrdered = $produit->pivot->quantite;  // Get quantity ordered
                $produit->quantite -= $quantiteOrdered;  // Decrease the stock
                $produit->save();  // Save the updated product
                Log::info('Product stock updated:', ['product_id' => $produit->id, 'new_stock' => $produit->stock]);
            }
    
            // Delete the associated panier after order creation
            $panier->delete();
            Log::info('Panier deleted:', ['panier_id' => $panier->id]);
    
            // Redirect to the order show page
            return redirect()->route('commande.show', ['id' => $commande->id])
                ->with('success', 'Your order has been successfully placed.');
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order.',
            ]);
        }
    }
    
    public function show($id)
    {
        Log::info('Fetching order with id: ' . $id);
    
        $commande = Commande::findOrFail($id); // Find the order by ID
    
        // Decode the cart data from JSON into an array
        $cartData = json_decode($commande->cart_data, true);
    
    
        return view('customer.commande_show', compact('commande', 'cartData')); // Pass cartData to the view
    }
    
}    
