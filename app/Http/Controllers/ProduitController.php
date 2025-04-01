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

    public function store(Request $request)
    {
        $produit = Produit::create($request->all());
        return response()->json($produit, 201);
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

