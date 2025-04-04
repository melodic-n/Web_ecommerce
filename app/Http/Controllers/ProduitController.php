<?php

namespace App\Http\Controllers;

use App\Models\Produit;  
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return response()->json($produits); 
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json($produit); 
    }

    public function apiIndex()
{
    $products = Produit::all(); // Use French name if your model is 'Produit'
    return response()->json($products);
}

public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string'
        ]);

        $product = Produit::create($validated);

        return response()->json([ // ← MUST return JSON
            'success' => true,
            'product' => $product,
            'message' => 'Product added successfully'
        ], 201); // HTTP 201 Created

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json($produit); 
    }

  public function update(Request $request, $id)
{
    $produit = Produit::find($id);
    
    if (!$produit) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $produit->nom_prod = $request->input('nom_prod', $produit->nom_prod); // Update only the fields that are passed in the request
    $produit->prix = $request->input('prix', $produit->prix);
    $produit->img_prod = $request->input('img_prod', $produit->img_prod);
    $produit->description = $request->input('description', $produit->description);
    $produit->category = $request->input('category', $produit->category);
    $produit->quantite = $request->input('quantite', $produit->quantite);

    $produit->save();

    return response()->json(['message' => 'Product updated successfully', 'data' => $produit]);
}

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return response()->json(['message' => 'Product deleted successfully']); 
    }
}

