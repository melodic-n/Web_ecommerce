<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Handicrafts - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Corps de la page */
        body {
            background-color: black;
            color: #977161;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* En-tête */
        header {
            background-color: #F4C4B0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 30px;
            height: 50px;
        }

        /* Logo */
        .logo img {
            width: 130px;
            height: auto;
        }

        /* Navigation */
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        /* Icônes */
        .icons {
            display: flex;
            gap: 15px;
        }

        .icon-link {
            text-decoration: none;
        }

        .icons i {
            font-size: 22px;
            cursor: pointer;
            color: #E77A4B;
            transition: color 0.3s ease-in-out;
        }

        .icons a {
            position: relative;
            z-index: 10;
        }

        .icons i:hover {
            color: #B28672;
        }

        /* Rectangle latéral - FORMULAIRE AGRANDI */
        .side-rectangle {
            position: fixed;
            right: 150px;
            top: 120px; /* Remonté un peu */
            width: 380px; /* Largeur augmentée */
            height: 420px; /* Hauteur augmentée */
            background-color: #B28672;
            color: rgb(26, 24, 24);
            text-align: center;
            padding: 30px; /* Plus d'espace intérieur */
            border-radius: 10px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Titre dans le rectangle */
        .side-rectangle h3 {
            margin-bottom: 30px; /* Plus d'espace */
            font-size: 24px; /* Texte plus grand */
            text-align: left;
            margin-left: 0; /* Alignement corrigé */
            padding-left: 20px; /* Décalage */
            color: white;
            width: 100%;
        }

        /* Formulaire dans le rectangle */
        .side-rectangle form {
            display: flex;
            flex-direction: column;
            gap: 20px; /* Plus d'espace entre les éléments */
            width: 100%;
        }

        /* Conteneur des champs de saisie */
        .input-container {
            display: flex;
            align-items: center;
            gap: 15px; /* Plus d'espace entre label et input */
        }

        /* Label des champs de saisie */
        .side-rectangle label {
            font-size: 16px; /* Texte plus grand */
            font-weight: bold;
            width: 100px; /* Largeur augmentée */
            color: white;
        }

        /* Input des champs de saisie */
        .side-rectangle input {
            width: 200px; /* Champ plus large */
            padding: 12px; /* Plus de rembourrage */
            border: none;
            border-radius: 5px;
            font-size: 16px; /* Texte plus grand */
        }

        /* Bouton de connexion */
        .side-rectangle button {
            width: 150px; /* Bouton plus large */
            background-color: #E77A4B;
            color: white;
            border: none;
            padding: 12px; /* Plus de rembourrage */
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px; /* Texte plus grand */
            transition: background 0.3s ease-in-out;
            margin-top: 20px; /* Plus d'espace au-dessus */
            align-self: center;
        }

        .side-rectangle button:hover {
            background-color: #B24A2C;
        }

        /* Lien pour mot de passe oublié */
        .forgot-password {
            margin-top: 15px; /* Plus d'espace */
            font-size: 16px; /* Texte plus grand */
            color: white;
        }

        .forgot-password a {
            color: #E77A4B;
            text-decoration: none;
            font-weight: bold;
        }

        .forgot-password a:hover {
            color: #B24A2C;
        }

        /* Remember me checkbox */
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px; /* Plus d'espace */
            margin-top: 10px; /* Plus d'espace */
            color: white;
            font-size: 16px; /* Texte plus grand */
        }

        .remember-me input {
            width: auto;
            transform: scale(1.2); /* Case à cocher plus grande */
        }

        /* Error messages */
        .error-message {
            color: #ff6b6b;
            font-size: 14px; /* Texte plus grand */
            margin-top: 5px;
        }

        /* Ajout d'une image à gauche et inclinée */
        .left-image {
            position: fixed;
            left: 200px;
            top: 210px;
            width: 390px;
            height: 100%;
            overflow: hidden;
            transform: rotate(-30deg);
            transform-origin: left top;
        }

        .left-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* Footer - RENDU PLUS PETIT */
        footer {
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
</head>
<body>
    <div class="left-image">
        <img src="{{ asset('images/handies_loginImage.png') }}" alt="Image de login">
    </div>
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo_handies.png') }}" alt="Logo">
        </div>
        <nav>
            <!-- <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">Contact Us</a></li> 
                <li><a href="#">Service d'achat</a></li>
                <li><a href="#">About Us</a></li>
            </ul> -->
        </nav>
        <div class="icons">
            <a href="#" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
            <a href="#" class="icon-link"><i class="fas fa-heart"></i></a>
        </div>
    </header>
    
    <div class="side-rectangle">
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4" style="color: white;">
                {{ session('status') }}
            </div>
        @endif

        <h3 style="padding-left: 150px;">SE CONNECTER</h3>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="input-container">
                <label for="email">Email :</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Votre email">
            </div>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <div class="input-container">
                <label for="password">Mot de passe :</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe">
            </div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <!-- Remember Me -->
            <!-- <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Se souvenir de moi</label>
            </div> -->

            <button type="submit">Se connecter</button>

            @if (Route::has('password.request'))
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">
                        Mot de passe oublié?
                    </a>
                </div>
            @endif
        </form>
    </div>

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
</body>
</html>