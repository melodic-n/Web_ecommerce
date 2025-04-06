<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Handicrafts</title>
    <link rel="stylesheet" href="ContactUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="left-image">
        <img src="handies_loginImage.png" alt="Image de login">
    </div>
    <header>
        <div class="logo">
            <img src="logo_handies.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="acceuilHandies.html">Home</a></li>
                <li><a href="#">Contact Us</a></li> 
                <li><a href="pdoduits.html">Service d'achat</a></li>
                <li><a href="#">About Us</a></li>
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
<div class="bottom-circle"></div>
<!-- Cercle avec icône de téléphone -->
<div class="bottom-circle-container">
    <div class="bottom-circle">
        <i class="fas fa-phone"></i>
    </div>
    <div class="phone-number">
        <span> <strong>+212 123 456 789</strong></span>
    </div>
</div>

<!-- Cercle avec icône Gmail -->
<div class="bottom-circle-right">
    <i class="fas fa-envelope"></i> <!-- Icône d'email Gmail -->
</div>
<div class="bottom-circle-background"></div> <!-- Cercle noir derrière -->
<div class="bottom-circle-right-background"></div>
<div class="location-text">
    <span class="location">Email : contact@handies.com</span> <!-- Adresse email -->
</div>


       
</body>
</html>
