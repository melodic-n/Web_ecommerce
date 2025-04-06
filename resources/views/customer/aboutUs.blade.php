<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page avec Header</title>

    
    <link href="{{ asset('css/customer/aboutUs.css') }}" rel="stylesheet">
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
    </ul>
</nav>
        
        <div class="icons">
            <a href="#"><i class="fas fa-shopping-cart"></i></a>
            <a href="#"><i class="fas fa-heart"></i></a>
        </div>
    </header>

    <!-- Section "Qui sommes-nous ?" -->
    <section class="about-us">
        <div class="question">
            <h2>Qui sommes-nous ?</h2>
        </div>
        
        <div class="about-content">
            <div class="text-content">
                <p>
                    <strong>Handies</strong> est bien plus qu'une simple plateforme de vente en ligne. Nous sommes une équipe passionnée dédiée à la préservation et à la valorisation de l'artisanat marocain traditionnel. En collaborant étroitement avec des artisans locaux issus des différentes régions du Maroc, nous avons pour mission de faire découvrir au monde entier la richesse et la diversité des produits artisanaux marocains. 
                </p>
                <p>
                    Nos produits sont fabriqués à la main, chacun avec une attention méticuleuse aux détails et une profonde connaissance des techniques ancestrales. De la poterie des montagnes de l'Atlas aux tissus brodés à la main dans les villes impériales, chaque article que nous proposons est une œuvre d'art qui raconte une histoire. Nous croyons fermement que l'artisanat marocain n'est pas seulement un produit, mais un héritage vivant qui mérite d'être soutenu et transmis de génération en génération.
                </p>
              
            </div>
            <div class="image-content">
                <div class="orbit">
                <!-- <div class="image-container" style="background-image: url(images/customer/Produit1.jpg);"></div> -->
                    <img src="images/customer/aboutUs_img1.jpg" class="about-us-image" alt="Image circulaire" />
                    <div class="star star1"></div>
                    <div class="star star2"></div>
                    <div class="star star3"></div>
                    <div class="star star4"></div>
                    <div class="star star5"></div>
                    <div class="star star6"></div>
                  </div>
                  
              </div>
              
        </div>
    </section>

    <!-- Section Équipe -->
<!-- Section Équipe -->
<section class="team">
    <h2 class="team-title">Équipe composée de 3 personnes</h2>
    <div class="team-members">
        <div class="member">
            <img src="images/customer/Full stack developer.jpeg" alt="Membre 1">
            <h3>Hajar</h3>
            <p class="role">Développeuse Full Stack</p>
            <p>Responsable du développement du site web et de la base de données.</p>
            <p>S'occupe de la liaison entre le Back-End et le Front-End .</p>

        </div>
        <div class="member">
            <img src="images/customer/designer.jpeg" alt="Membre 2">
            <h3>Salma</h3>
            <p class="role">UI/UX Designer & Front-End Developer</p>
            <p>Chargée de l'expérience utilisateur et du design visuel du site.</p>
            <p>Chargée de la gestion des tâches.</p>
        </div>
        <div class="member">
            <img src="images/customer/aboutUs_img1.jpg" alt="Membre 3">
            <h3>Hafssa</h3>
            <p class="role">Responsable Contenu & Back-End Developer</p>
            <p>Gère la création et la gestion du contenu du site ainsi que la logique serveur.</p>
        </div>
    </div>
</section>

<!-- Section "Parmi nos produits" -->
<section class="products">
    <h2 class="products-title">Parmi nos produits</h2>
    <div class="product-items">
        <div class="product-item">
            <img src="images/customer/Produit1.jpg" alt="Produit 1">
            <div class="product-description">
                <h3>Produit 1</h3>
                <p>Découvrez notre magnifique produit fait à la main, représentant l'artisanat marocain traditionnel. Chaque pièce est unique.</p>
                <a href="{{ route('home') }}" class="discover-more-btn">Discover More</a>
            </div>
        </div>
        <div class="product-item">
            <img src="images/customer/produit12.jpg" alt="Produit 2">
            <div class="product-description">
                <h3>Produit 2</h3>
                <p>Un autre produit artisanal d'exception, façonné par nos artisans locaux. Parfait pour ajouter une touche traditionnelle à votre intérieur.</p>
                <a href="{{ route('home') }}"  class="discover-more-btn">Discover More</a>
            </div>
        </div>
    </div>
</section>


</body>
</html>
