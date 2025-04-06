<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Handicrafts</title>
    <link href="{{ asset('css/customer/ContactUs.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Add these styles to fix the alignment */
        .contact-info-container {
            display: flex;
            justify-content: space-between;
            position: fixed;
            bottom: 20px;
            width: 90%;
            left: 5%;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            background: white;
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .contact-item i {
            margin-right: 10px;
            color: #B28672;
            font-size: 1.2rem;
        }
        
        .contact-item span {
            color: #333;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="left-image">
        <img src="{{ asset('images/handies_loginImage.png') }}" alt="Image de login">
    </div>
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
            </ul>
        </nav>
        <div class="icons">
            <a href="cart.html" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
            <a href="wishlist.html" class="icon-link"><i class="fas fa-heart"></i></a>
        </div>
    </header>
    
    <!-- Formulaire dans la page HTML -->
    <div class="side-rectangle">
        <h3>Contactez-nous</h3>
        <form>
            <div class="input-container">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" placeholder="Votre nom" required>
            </div>
            <div class="input-container">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="input-container">
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" placeholder="Votre téléphone" required>
            </div>
            <div class="input-container">
                <label for="message">Message :</label>
                <textarea id="message" placeholder="Votre message" rows="4" required></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>

    <!-- Contact information container -->
    <div class="contact-info-container">
        <!-- Phone contact -->
        <div class="contact-item">
            <i class="fas fa-phone"></i>
            <span><strong>+212 123 466 789</strong></span>
        </div>
        
        <!-- Email contact -->
        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <span><strong>contact@handies.com</strong></span>
        </div>
    </div>
</body>
</html>