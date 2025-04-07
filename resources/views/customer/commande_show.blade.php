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
        @foreach($produits as $product)
            <li>{{ $product['nom_prod'] }} - {{ $product['prix'] }} MAD</li>
        @endforeach
    </ul>
@endsection
