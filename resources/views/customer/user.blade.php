<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Handicrafts</title>
    <link rel="stylesheet" href="{{ asset('css/customer/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div class="left-image">
        <img src="{{ asset('images/handies_loginImage.png') }}" alt="Image de login">
    </div>
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo_handies.png') }}" alt="Logo">
        </div>
        <ul>
        <!-- <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li> 
        <li><a href="{{ route('dashboard') }}">Service d'achat</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li> -->
    </ul>
        
        <div class="icons">
            <a href="cart.html" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
            <a href="wishlist.html" class="icon-link"><i class="fas fa-heart"></i></a>
        </div>
    </header>
    <div class="side-rectangle">
        <h3>Créer un compte</h3>
        <form>
            <div class="input-container">
                <label for="email">Email :</label>
                <input type="email" id="email" placeholder="Votre email" required>
            </div>
            
            <div class="input-container">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" placeholder="Votre mot de passe" required>
            </div>
            
            <button type="submit">S'inscrire</button>
    
            <!-- Nouveau texte en bas -->
            <!-- <div class="signin-link">
                <p>Avez-vous déjà un compte ? <a href="login.html">Se connecter</a></p>
            </div> -->
            <a href="{{ route('login') }}" class="create-account-btn">
        <i class="fas fa-user-plus"></i> Avez-vous déjà un compte ? Se connecter
    </a>
        </form>
    </div>
    
   
</body>
<footer>
        <div class="footer-content">
            <div class="footer-section">
                <p>Moroccan Handicrafts</p>
                <p>Artisanat traditionnel</p>
            </div>
            <div class="footer-section">
                <p>contact@handies.ma</p>
            </div>
            <div class="footer-section">
                <p>&copy; 2023 Tous droits réservés</p>
            </div>
        </div>
    </footer>
    <style> footer {
            background-color: #F4C4B0; /* Même couleur que le header */
            color: black;
            padding: 8px 0; /* Rembourrage réduit */
            margin-top: auto;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            font-size: 13px; /* Texte plus petit */
        }

        .footer-content {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section {
            text-align: center;
            padding: 0 15px; /* Rembourrage réduit */
        }

        .footer-section p {
            margin: 3px 0; /* Marges réduites */
        }

        .footer-bottom {
            text-align: center;
            padding-top: 5px; /* Rembourrage réduit */
            font-size: 11px; /* Texte plus petit */
        }
        </style>
</html>
