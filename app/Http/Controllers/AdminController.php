<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class AdminController extends Controller
{
    // app/Http/Controllers/AdminController.php
public function index()
{
    $produits = Produit::all();
    return view('admin.dashboard', compact('produits'));
}
}
