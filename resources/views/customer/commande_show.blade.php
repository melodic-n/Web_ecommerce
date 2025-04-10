@extends('layouts.app')

@section('content')
<style>
    .order-container {
        max-width: 800px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .order-header {
        border-bottom: 2px solid #E77A4B;
        margin-bottom: 20px;
    }

    .order-header h2 {
        color: #B28672;
        font-weight: bold;
    }

    .order-info div {
        margin-bottom: 15px;
        font-size: 1.1em;
    }

    .order-info strong {
        width: 150px;
        display: inline-block;
    }

    .badge-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9em;
        color: #fff;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .order-items li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        font-size: 1em;
        display: flex;
        justify-content: space-between;
    }

    .return-button {
        margin-top: 30px;
        text-align: center;
    }

    .return-button a {
        padding: 10px 20px;
        background-color: #E77A4B;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
    }

    .return-button a:hover {
        background-color: #c06233;
    }
</style>

<div class="order-container">
    <div class="order-header">
        <h2>Détails de la Commande</h2>
    </div>

    <div class="order-info">
        <div><strong>Commande ID:</strong> {{ $commande->id }}</div>
        <div><strong>Montant total:</strong> {{ number_format($commande->montant, 2) }} MAD</div>
        <div>
            <strong>Status:</strong>
            <span class="badge-status 
                @if($commande->status === 'completed') badge-success
                @elseif($commande->status === 'pending') badge-warning
                @elseif($commande->status === 'canceled') badge-danger
                @else badge-secondary @endif">
                {{ ucfirst($commande->status) }}
            </span>
        </div>
    </div>

    <h4>Articles commandés:</h4>
    <ul class="order-items">
        @foreach($cartData as $item)
            <li>
                <span>{{ $item['nom_prod'] }}</span>
                <span>{{ number_format($item['quantity'] * $item['price'], 2) }} MAD</span>
            </li>
        @endforeach
    </ul>

    <div class="return-button">
        <a href="{{ url('/') }}">
            <i class="fas fa-arrow-left"></i> Retour à l'accueil
        </a>
    </div>
</div>
@endsection
