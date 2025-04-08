@extends('layouts.app')

@section('content')

    <h2>Details de la Commande</h2>

    <div>
        <strong>Commande ID:</strong> {{ $commande->id }}
    </div>

    <div>
        <strong>Montant total:</strong> {{ $commande->montant }} MAD
    </div>

    <div>
        <strong>Status:</strong> {{ $commande->status }}
    </div>

    <h3>Articles:</h3>
    <ul>
        @foreach($commande->panier->produits as $produit)
            <li>{{ $produit->nom_prod }} - {{ number_format($produit->pivot->quantite * $produit->prix, 2) }} MAD</li>
        @endforeach
    </ul>

@endsection
