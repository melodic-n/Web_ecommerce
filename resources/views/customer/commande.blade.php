@extends('layouts.app')

@section('content')
<div class="commande-container">
    <h2>Finaliser votre commande</h2>

    <div class="commande-sections">
        <!-- Résumé du panier -->
        <div class="section panier-resume">
            <h3>Votre panier</h3>
            <div id="commande-items">
                <!-- Les articles seront chargés dynamiquement ici -->
            </div>
            <div class="commande-total">
                <strong>Total: <span id="commande-total-price">0 MAD</span></strong>
            </div>
        </div>

        <!-- Informations de livraison -->
        <div class="section livraison-info">
            <h3>Informations de livraison</h3>
            <form id="commande-form">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ Auth::check() ? Auth::user()->nom : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="{{ Auth::check() ? Auth::user()->prenom : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="tel">Téléphone</label>
                    <input type="tel" id="tel" name="tel" value="{{ Auth::check() ? Auth::user()->tel : '' }}" required>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse de livraison</label>
                    <textarea id="adresse" name="adresse" required>{{ Auth::check() ? Auth::user()->adresse : '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" required>
                </div>

                <div class="form-group">
                    <label for="code_postal">Code postal</label>
                    <input type="text" id="code_postal" name="code_postal" required>
                </div>
            </form>
        </div>

        <!-- Mode de paiement -->
        <div class="section mode-paiement">
            <h3>Mode de paiement</h3>
            <div class="payment-options">
                <div class="payment-option">
                    <input type="radio" id="paiement-livraison" name="payment_method" value="livraison" checked>
                    <label for="paiement-livraison">Paiement à la livraison</label>
                </div>

          
            </div>
        </div>

        <div class="commande-actions">
            <button type="button" id="confirmer-commande" class="btn-primary">Confirmer la commande</button>
            <a href="{{ route('home') }}" class="btn-secondary">Continuer mes achats</a>
        </div>
    </div>
</div>

<style>
    .commande-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    .commande-sections {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .section {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    h3 {
        color: #444;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .half {
        flex: 1;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    textarea {
        height: 80px;
    }

    .payment-options {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .payment-option {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .payment-option input[type="radio"] {
        width: auto;
    }

    .hidden {
        display: none;
    }

    .commande-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .commande-item img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 15px;
    }

    .commande-total {
        margin-top: 20px;
        text-align: right;
        font-size: 18px;
    }

    .commande-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .btn-primary {
        background-color: #F4C4B0;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #e4a98a;
    }

    .btn-secondary {
        background-color: white;
        color: #555;
        border: 1px solid #ddd;
        padding: 12px 25px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn-secondary:hover {
        background-color: #f5f5f5;
    }

    @media (min-width: 768px) {
        .commande-sections {
            flex-direction: row;
            flex-wrap: wrap;
        }

        .panier-resume, .livraison-info {
            flex: 1;
            min-width: 300px;
        }

        .mode-paiement, .commande-actions {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const commandeItems = document.getElementById('commande-items');
    const totalPriceElement = document.getElementById('commande-total-price');

    if (cart.length > 0) {
        let totalPrice = 0;

        cart.forEach(product => {
            const productElement = document.createElement('div');
            productElement.classList.add('commande-item');

            const price = parseFloat(product.price.replace(' MAD', '').replace(' ', ''));
            totalPrice += price;

            productElement.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <div>
                    <div><strong>${product.name}</strong></div>
                    <div>${product.price}</div>
                </div>
            `;

            commandeItems.appendChild(productElement);
        });

        totalPriceElement.textContent = `${totalPrice.toFixed(2)} MAD`;
    } else {
        commandeItems.innerHTML = '<p>Votre panier est vide</p>';
    }

    const paiementCarte = document.getElementById('paiement-carte');
    const paiementLivraison = document.getElementById('paiement-livraison');
    const carteDetails = document.getElementById('carte-details');

    paiementCarte.addEventListener('change', function() {
        if (this.checked) {
            carteDetails.classList.remove('hidden');
        }
    });

    paiementLivraison.addEventListener('change', function() {
        if (this.checked) {
            carteDetails.classList.add('hidden');
        }
    });

    const confirmerCommande = document.getElementById('confirmer-commande');
    const commandeForm = document.getElementById('commande-form');

    confirmerCommande.addEventListener('click', function() {

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

        if (paiementCarte.checked) {
            const cardFields = document.querySelectorAll('#carte-details input');
            cardFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                } else {
                    field.classList.remove('error');
                }
            });
        }

        if (isValid) {

            alert('Votre commande a été confirmée! Vous recevrez un email de confirmation.');

            localStorage.removeItem('cart');

            setTimeout(() => {
                window.location.href = "{{ route('home') }}";
            }, 2000);
        } else {
            alert('Veuillez remplir tous les champs obligatoires.');
        }
    });
});
</script>
@endsection