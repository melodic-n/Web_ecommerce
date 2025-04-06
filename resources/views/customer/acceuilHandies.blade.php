<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Handicrafts</title>
    <link href="{{ asset('css/customer/acceuilHandies.css') }}" rel="stylesheet">
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
        <li><a href="{{ route('contact') }}"></a></li> 
        <li><a href="{{ route('dashboard') }}"></a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
    </ul>
</nav>
        <!-- <div class="search-bar">
            <input type="text" placeholder="Search">
            <button class="search-icon"><i class="fas fa-search"></i></button>
        </div> -->
        <div class="icons">
            <a href="cart.html" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
            <a href="wishlist.html" class="icon-link"><i class="fas fa-heart"></i></a>
        </div>
    </header>

    <main>
        <div class="content">
            <h1>Welcome to our <br> Moroccan Handicrafts shop</h1>
            <p>Moroccan handicrafts are an essential part of the country's heritage, reflecting Berber, Arab, Andalusian, and African influences.</p>
            <!-- <li><a href="{{ route('login') }}">NEXT</a></li> -->
            <li>
    <a href="{{ route('login') }}" class="somo-btn">
        NEXT <i class="fas fa-arrow-right ml-2"></i>
    </a>
</li>

<style>
.somo-btn {
    /* Base styles */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #E77A4B; /* Somo base color */
    color: white;
    padding: 10px 24px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid #E77A4B;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 14px;
    
    /* Hover effects */
    &:hover {
        background-color: transparent;
        color: #E77A4B;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(231, 122, 75, 0.2);
    }
    
    /* Active state */
    &:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Focus state */
    &:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(231, 122, 75, 0.3);
    }
    
    /* Icon animation */
    i {
        transition: transform 0.3s ease;
    }
    
    &:hover i {
        transform: translateX(4px);
    }
}

/* If you want a dark version alternative */
.somo-btn.dark {
    background-color: #333;
    border-color: #333;
    color: white;
    
    &:hover {
        color: #333;
        background-color: transparent;
    }
}
</style>
            <!-- <button class="next-btn">NEXT</button>
             -->
            
<!-- <script>
document.querySelector('.next-btn').addEventListener('click', function() {
    window.location.href = "{{ route('login') }}";

});
</script> -->


            <script>
                // Sélectionner le bouton "NEXT"
                document.querySelector('.next-btn').addEventListener('click', function() {
                    // Rediriger vers une autre page
                    window.location.href = 'auth/login';  // Remplacez par le lien de la page vers laquelle vous voulez aller
                });
            </script>
                    </div>
        <div class="image">
            <img src="images/image_pageAcceuil.png" alt="Moroccan Handicrafts">
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
    </style>
</body>
</html>
