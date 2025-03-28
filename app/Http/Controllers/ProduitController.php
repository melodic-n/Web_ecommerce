<?php

namespace App\Http\Controllers;

use App\Models\Produit;  // Assure-toi que le modèle Produit est bien importé
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        $produits = Produit::all();  // Récupérer tous les produits depuis la base de données
        //dd($produits); // Vérifier les données avant de les passer à la vue
        return view('index', compact('produits'));  // Référence à la vue directement dans resources/views
    }

    // Afficher le formulaire pour créer un nouveau produit
    public function create()
    {
        return view('produits.create');
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $request->validate([
            'nom_prod' => 'required|string|max:255',
            'img_prod' => 'required|image',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
        ]);

        // Enregistrer le produit
        $produit = new Produit();
        $produit->nom_prod = $request->nom_prod;
        $produit->img_prod = $request->file('img_prod')->store('images', 'public');  // Sauvegarder l'image dans le dossier public
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Produit créé avec succès!');
    }

    // Afficher le formulaire pour éditer un produit
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.edit', compact('produit'));
    }

    // Mettre à jour un produit existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_prod' => 'required|string|max:255',
            'img_prod' => 'image|nullable',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->nom_prod = $request->nom_prod;

        // Mettre à jour l'image seulement si une nouvelle image est fournie
        if ($request->hasFile('img_prod')) {
            $produit->img_prod = $request->file('img_prod')->store('images', 'public');
        }

        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès!');
    }

    // Supprimer un produit
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès!');
    }
}
