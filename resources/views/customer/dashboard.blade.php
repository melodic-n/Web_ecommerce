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
        <div class="product-item" data-id="{{ $produit->id }}" data-name="{{ $produit->nom_prod }}" data-price="{{ $produit->prix }}">
            <div class="image-container" style="background-image: url('{{ asset($produit->img_prod) }}');"></div>
            <div class="product-info">
                <div class="product-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="product-name">{{ $produit->nom_prod }}</div>
                <div class="product-price">{{ $produit->prix }} MAD</div>
                <div class="product-description">{{ $produit->description }}</div>
                
                <!-- Add to Cart Button -->
                <button class="add-to-cart-btn" onclick="addToCart({
                    id: {{ $produit->id }},
                    name: '{{ addslashes($produit->nom_prod) }}',
                    price: {{ $produit->prix }},
                    image: '{{ asset($produit->img_prod) }}',
                    description: '{{ addslashes($produit->description) }}'
                })">
                    <i class="fas fa-cart-plus"></i> Ajouter au panier
                </button>
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
        var orderRoute = "/customer/commande/"
    </script>
    
    <style>
        /* Main Product Grid Layout */
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-item:hover {
            transform: scale(1.05);
        }

        .image-container {
            height: 200px;
            background-size: cover;
            background-position: center;
            background-color: #f0f0f0;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 1.1em;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }

        .product-price {
            font-size: 1.2em;
            color: #E77A4B;
            margin-top: 5px;
        }

        .product-description {
            font-size: 0.9em;
            color: #777;
            margin-top: 10px;
        }

        .product-rating i {
            color: #FFD700;
        }

        .add-to-cart-btn {
            background-color: #E77A4B;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-to-cart-btn:hover {
            background-color: #B28672;
        }

        /* Footer Styles */
        .footer-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #F4C4B0;
            padding: 20px;
        }

        .footer-section {
            text-align: center;
            width: 30%;
            font-size: 14px;
        }

        .footer-divider {
            width: 2px;
            height: 80px;
            background-color: #B28672;
        }

        .footer-bottom {
            text-align: center;
            padding: 10px;
            background-color: #F4C4B0;
            color: black;
            font-size: 12px;
        }
    </style>
<script src="{{ asset('js/customer/produits.js') }}"></script>


</body>
</html>