<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Handicrafts</title>
    <link rel="stylesheet" href="{{ asset('css/customer/produits.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/customer/logo_handies.png') }}" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li> 
                <li><a href="{{ route('dashboard') }}">Service d'achat</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </nav>

        <div class="search-bar">
            <input type="text" id="searchBar" placeholder="Recherchez un produit..." onkeyup="filterProducts()">
            <button class="search-icon"><i class="fas fa-search"></i></button>
        </div>

        <div class="icons">
            <a href="javascript:void(0)" class="cart-icon" onclick="toggleCart()">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="#" class="icon-link"><i class="fas fa-heart"></i></a>
        </div>

        <div id="cart-container" class="cart-container" style="display: none;">
            <h2>Votre Panier</h2>
            <div id="cart-items"></div>
            <div id="total-price" style="font-weight: bold;">Total: 0 MAD</div>
            <button onclick="closeCart()">Fermer</button>
        </div>
    </header>

    <main>
        <div class="products">
            @foreach($produits as $produit)
            <div class="rectangle" data-name="{{ $produit->nom }}">
                <div class="image-container" style="background-image: url('{{ $produit->img_prod }}');"></div>
                <div class="info-container">
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </div>
                    <div class="product-name">{{ $produit->nom_prod }}</div>
                    <div class="product-price">{{ $produit->prix }} MAD</div>
                    <div class="product-description">{{ $produit->description }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-section about">
                <h2 style="color: #B28672;">About Us</h2>
                <p style="color: black;">Discover the finest Moroccan handicrafts crafted by talented artisans.</p>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-section contact">
                <h2 style="color: #B28672;">Contact Us</h2>
                <p style="color: black;">Email: info@moroccanhandicrafts.com</p>
                <p style="color: black;">Phone: +212 600 000 000</p>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-section social" style="margin-top: -20px;">
                <h2 style="color: #B28672;">Follow Us</h2>
                <a href="#"><i class="fab fa-facebook" style="font-size: 20px; color: #E77A4B;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="font-size: 20px; color: #E77A4B;"></i></a>
                <a href="#"><i class="fab fa-whatsapp" style="font-size: 20px; color: #E77A4B;"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Moroccan Handicrafts. All rights reserved.</p>
        </div>
    </footer>
    <script>
        var userId = {{ auth()->user()->id }};  
        var orderRoute = "/customer/commande/" + userId;
    </script>
    
    
    <style>
        .footer-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #F4C4B0;
            padding: 3px; /* Réduction de la hauteur */
        }
        .footer-section {
            text-align: center;
            width: 30%;
            font-size: 12px; /* Réduction de la taille du texte */
        }
        .footer-divider {
            width: 2px;
            height: 80px; /* Réduction de la hauteur du séparateur */
            background-color: #B28672;
        }
        .footer-bottom {
            text-align: center;
            padding: 1px;
            background-color: #F4C4B0;
            color: black;
            font-size: 10px; /* Réduction de la taille du texte */
        }
        .logout-container {
    margin-left: 20px; /* Adjust spacing as needed */
}

.logout-btn {
    background-color: #000; /* Black background */
    color: #E77A4B; /* Somo (Moroccan terracotta) text */
    border: 2px solid #E77A4B; /* Pink border */
    border-radius: 25px; /* Rounded corners */
    padding: 8px 15px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.logout-btn:hover {
    background-color: #E77A4B; /* Pink background on hover */
    color: #000; /* Black text on hover */
}

.logout-btn i {
    font-size: 16px;
}
    </style>
   
<script src="{{ asset('js/customer/produits.js') }}"></script>


<script>
    var userId = {{ auth()->user()->id }};  
    var orderRoute = "/customer/commande/" + userId;
</script>

</body>
</html>