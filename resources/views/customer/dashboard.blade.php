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
            <img src="images/customer/logo_handies.png" alt="Logo">
        </div>
        <nav>
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li> 
        <li><a href="{{ route('dashboard') }}">Service d'achat</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
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
            <a href="wishlist.html" class="icon-link"><i class="fas fa-heart"></i></a>
        </div>

        <div id="cart-container" class="cart-container" style="display: none;">
            <h2>Votre Panier</h2>
            <div id="cart-items"></div>
            <div id="total-price" style="font-weight: bold;">Total: 0 MAD</div>
            <button onclick="closeCart()">Fermer</button>

        </div>
    </header>

    <main>
        <!-- Liste de produits (rectangles côte à côte) -->
        <div class="products">
            <!-- Rectangle produit 1 -->
            <div class="rectangle" data-name="Nom du produit 1">
            <div class="image-container" style="background-image: url(images/customer/Produit1.jpg);"></div>
                <div class="info-container">
                    <!-- Section des étoiles et icône Ajouter au panier -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </div>
                    <div class="product-name">Pack:mini handy+ 6 verres</div>
                    <div class="product-price">200 MAD</div>
                </div>
            </div>

            <!-- Rectangle produit 2 -->
            <div class="rectangle" data-name="Nom du produit 2">
            <div class="image-container" style="background-image: url(images/customer/Produit2.jpg);"></div>
                <div class="info-container">
                    <!-- Section des étoiles et icône Ajouter au panier -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </div>
                    <div class="product-name">Pack: cuillères, verre et assiette</div>
                    <div class="product-price">250 MAD</div>
                </div>
            </div>

            <!-- Rectangle produit 3 -->
            <div class="rectangle" data-name="Nom du produit 3">
            <div class="image-container" style="background-image: url(images/customer/Produit3.jpg);"></div>
                <div class="info-container">
                    <!-- Section des étoiles et icône Ajouter au panier -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </div>
                    <div class="product-name">Pack: tasses Weavy et assiettes</div>
                    <div class="product-price">150 MAD</div>
                </div>
            </div>

            <!-- Rectangle produit 4 -->
            <div class="rectangle" data-name="Nom du produit 4">
            <div class="image-container" style="background-image: url(images/customer/produit4.jpg);"></div>
                <div class="info-container">
                    <!-- Section des étoiles et icône Ajouter au panier -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </div>
                    <div class="product-name"> Mug  </div>
                    <div class="product-price">180 MAD</div>
                </div>
            </div>

            <!-- Rectangle produit 5 -->
            <div class="rectangle" data-name="Nom du produit 5">
            <div class="image-container" style="background-image: url(images/customer/produit5.jpg);"></div>
                <div class="info-container">
                    <!-- Section des étoiles et icône Ajouter au panier -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </div>
                    <div class="product-name"> Gobelets</div>
                    <div class="product-price">220 MAD</div>
                </div>
            </div>

            <!-- Rectangle produit 6 -->
            <div class="rectangle" data-name="Nom du produit 6">
            <div class="image-container" style="background-image: url(images/customer/produit6.jpg);"></div>
                <div class="info-container">
                    <!-- Section des étoiles et icône Ajouter au panier -->
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
                    </div>
                    <div class="product-name">Un pichet </div>
                    <div class="product-price">270 MAD</div>
                </div>
            </div>

            <!-- Rectangle produit 7 -->
<div class="rectangle" data-name="Nom du produit 7">
<div class="image-container" style="background-image: url(images/customer/produit7.jpg);"></div>
    <div class="info-container">
        <div class="product-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
        </div>
        <div class="product-name">Assiettes</div>
        <div class="product-price">230 MAD</div>
    </div>
</div>

<!-- Rectangle produit 8 -->
<div class="rectangle" data-name="Nom du produit 8">
<div class="image-container" style="background-image: url(images/customer/produit8.jpg);"></div>
    <div class="info-container">
        <div class="product-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
        </div>
        <div class="product-name">Jarre en argile</div>
        <div class="product-price">300 MAD</div>
    </div>
</div>

<!-- Rectangle produit 9 -->
<div class="rectangle" data-name="Nom du produit 9">
<div class="image-container" style="background-image: url(images/customer/produit9.jpg);"></div>
    <div class="info-container">
        <div class="product-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
        </div>
        <div class="product-name">bol</div>
        <div class="product-price">210 MAD</div>
    </div>
</div>

<!-- Rectangle produit 10 -->
<div class="rectangle" data-name="Nom du produit 10">
<div class="image-container" style="background-image: url(images/customer/produit10.jpg);"></div>
    <div class="info-container">
        <div class="product-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
        </div>
        <div class="product-name"> presse-agrumes </div>
        <div class="product-price">190 MAD</div>
    </div>
</div>
<!-- Rectangle produit 11 -->
<div class="rectangle" data-name="Nom du produit 11">
<div class="image-container" style="background-image: url(images/customer/produit11.jpg);"></div>
    <div class="info-container">
        <div class="product-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
        </div>
        <div class="product-name"> Tagra</div>
        <div class="product-price">190 MAD</div>
    </div>
</div>
<!-- Rectangle produit 12 -->
<div class="rectangle" data-name="Nom du produit 12">
<div class="image-container" style="background-image: url(images/customer/produit12.jpg);"></div>
    <div class="info-container">
        <div class="product-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i> Ajouter au panier</button>
        </div>
        <div class="product-name"> Tabokalt</div>
        <div class="product-price">190 MAD</div>
    </div>
</div>


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



<div class="logout-container">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</div>
</body>
</html>

