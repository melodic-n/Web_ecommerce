<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Handicrafts - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/customer/style.css') }}">
</head>

<body>
    <div class="left-image">
        <img src="{{ asset('images/handies_loginImage.png') }}" alt="Image de login">
    </div>
    <header>
        <div class="logo">
                <img src="images/customer/logo_handies.png" alt="Logo">
            </div>
            <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li> 
            <li><a href="{{ route('dashboard') }}">Service D'achat</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
        </ul>
    </nav>
    
            <div class="icons">
              <script src="{{ asset('js/customer/produits.js') }}"></script>
  <a href="javascript:void(0)" class="cart-icon" onclick="toggleCart()">
                <i class="fas fa-shopping-cart"></i> 
            </a>            
                <a href="wishlist.html" class="icon-link"><i class="fas fa-heart"></i></a>
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
            <div class="create-account-container">
    <a href="{{ route('customer.user') }}" class="create-account-btn">
        <i class="fas fa-user-plus"></i> Vous n'avez pas de compte ? Créez-en un ici
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