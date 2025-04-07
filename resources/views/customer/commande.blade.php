@extends('layouts.app')

@section('content')
<div class="commande-container">
    <h2>Finaliser votre commande</h2>

    <div class="commande-sections">
        <!-- Résumé du panier -->
        <div class="section panier-resume">
            <h3>Votre panier</h3>
            <div id="commande-items">
                <!-- Articles dynamically loaded here -->
            </div>
            <div class="commande-total">
            <strong>Total: <span id="commande-total-price">{{ $totalAmount }} MAD</span></strong>
            </div>
        </div>

        <!-- Informations de livraison -->
        <div class="section livraison-info">
            <h3>Informations de livraison</h3>
            <form id="commande-form" action="{{ route('commande.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ $customer ? $customer->nom : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="{{ $customer ? $customer->prenom : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="tel">Téléphone</label>
                    <input type="tel" id="tel" name="tel" value="{{ $customer ? $customer->tel : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse de livraison</label>
                    <textarea id="adresse" name="adresse" required>{{ $customer ? $customer->adresse : '' }}</textarea>
                </div>


               <!-- Hidden fields for cart data -->
<input type="hidden" name="cart_data" id="cart-data">
<input type="hidden" name="total_amount" id="total-amount">
<input type="hidden" name="payment_method" value="paypal">
<input type="hidden" name="panier_id" value="{{ isset($panier) ? $panier->id : '' }}">

            </form>
        </div>

        <!-- Mode de paiement -->
        <!-- <div class="section mode-paiement">
            <h3>Mode de paiement</h3>
            <div class="payment-options">
                <div class="payment-option">
                    <input type="radio" id="paiement-livraison" name="payment_method" value="livraison" checked>
                    <label for="paiement-livraison">Paiement à la livraison</label>
                </div>
            </div>
        </div> -->

        <div class="commande-actions">
            <button type="button" id="confirmer-commande" class="btn-primary">Confirmer la commande</button> <!-- recu -->
            <a href="{{ route('customer.dashboard') }}" class="btn-secondary">Continuer mes achats</a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<script>document.addEventListener('DOMContentLoaded', function() {
    const confirmerCommande = document.getElementById('confirmer-commande');
    const commandeForm = document.getElementById('commande-form');

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    confirmerCommande.addEventListener('click', function() {
    document.getElementById('cart-data').value = JSON.stringify(cart);

    let totalAmount = cart.reduce((sum, item) => sum + parseFloat(item.price.replace(' MAD', '').trim()), 0);
    document.getElementById('total-amount').value = totalAmount.toFixed(2);
        
    const required = commandeForm.querySelectorAll('[required]');
    let isValid = true;
        
        required.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });
        
        if (isValid) {
            commandeForm.submit();
        } else {
            alert('Veuillez remplir tous les champs obligatoires.');
        }
    });
});

</script>


@endsection

<style>
    /* Commande Container */
    .commande-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 28px;
    }

    .commande-sections {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    /* Section Style */
    .section {
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .section h3 {
        color: #444;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #555;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #007bff;
        outline: none;
    }

    .commande-total {
        margin-top: 20px;
        text-align: right;
        font-size: 18px;
    }

    .commande-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn-primary {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        padding: 10px 20px;
        background-color: #f8f9fa;
        color: #007bff;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background-color: #e2e6ea;
    }

    .payment-options {
        display: flex;
        flex-direction: column;
    }

    .payment-option {
        margin-bottom: 10px;
    }

    .payment-option input[type="radio"] {
        margin-right: 10px;
    }

    .alert-success {
        padding: 15px;
        margin-top: 20px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
    }
</style>
