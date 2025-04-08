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
        @foreach($cartData as $item)
            <li>{{ $item['nom_prod'] }} - {{ number_format($item['quantity'] * $item['price'], 2) }} MAD</li>
        @endforeach
    </ul>

    <!-- Button to go back to the homepage -->
    <div>
        <a href="{{ url('/') }}" class="btn btn-primary">Retour à l'accueil</a>
    </div>

@endsection
