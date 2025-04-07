![Handies Logo](public/images/logo_handies.png)
# Handies - Artisanat Marocain Traditionnel

Handies est bien plus qu'une simple plateforme de vente en ligne. Nous sommes une équipe passionnée dédiée à la préservation et à la valorisation de l'artisanat marocain traditionnel. En collaborant étroitement avec des artisans locaux issus des différentes régions du Maroc, nous avons pour mission de faire découvrir au monde entier la richesse et la diversité des produits artisanaux marocains.

Nos produits sont fabriqués à la main, chacun avec une attention méticuleuse aux détails et une profonde connaissance des techniques ancestrales. De la poterie des montagnes de l'Atlas aux tissus brodés à la main dans les villes impériales, chaque article que nous proposons est une œuvre d'art qui raconte une histoire. Nous croyons fermement que l'artisanat marocain n'est pas seulement un produit, mais un héritage vivant qui mérite d'être soutenu et transmis de génération en génération.

## Équipe

Notre équipe est composée de trois membres passionnés qui contribuent à la croissance et au succès de Handies.

### Hajar - Développeuse Full Stack

- Responsable du développement du site web et de la base de données.
- S'occupe de la liaison entre le Back-End et le Front-End.

### Salma - UI/UX Designer & Front-End Developer

- Chargée de l'expérience utilisateur et du design visuel du site.
- Responsable de la gestion des tâches liées au développement Front-End.

### Hafssa - Responsable Contenu & Back-End Developer

- Gère la création et la gestion du contenu du site ainsi que la logique serveur.

## Fonctionnalités

- Affichage des produits avec image, description, et prix.
- Ajout des produits au panier.
- Suppression des produits du panier.
- Calcul dynamique du total du panier.
- Option pour passer commande.
- Interface utilisateur réactive et facile à utiliser.

## Technologies Utilisées

- **HTML** pour la structure de la page.
- **CSS** pour la mise en page et la présentation.
- **JavaScript** pour la logique de gestion du panier.
- **LocalStorage** pour sauvegarder les produits dans le panier.
- **Laravel** pour la gestion du back-end.
- **npm** pour la gestion des dépendances front-end.

## Instructions d'Installation

### Pré-requis

1. Assurez-vous d'avoir **Node.js** et **npm** installés sur votre machine.
2. Assurez-vous d'avoir **Composer** installé pour gérer les dépendances Laravel.

### Installation du projet

1. Clonez ce repository sur votre machine locale :

   ```bash
   git clone https://github.com/melodic-n/Web_ecommerce.git
   ```

2. Accédez au répertoire du projet :

   ```bash
   cd Web_ecommerce
   ```

3. Installez les dépendances Laravel :

   ```bash
   composer install
   ```

4. Installez les dépendances front-end avec npm :

   ```bash
   npm install
   ```

5. Exécutez les commandes pour compiler les fichiers front-end :

   ```bash
   npm run dev
   ```

6. Lancez le serveur Laravel pour tester l'application localement :

   ```bash
   php artisan serve
   ```

7. Ouvrez votre navigateur et accédez à `http://localhost:8000` pour voir l'application en action.

## Remerciements

Nous souhaitons remercier tous les contributeurs pour leur travail acharné et leur collaboration. Leur soutien a été essentiel pour améliorer cette application et lui donner forme.

Un remerciement spécial à [Oussama](https://github.com/defaltastra/) pour son soutien précieux et ses contributions au projet.

## Fonctionnement de l'application

- **Affichage des produits** : Les produits sont présentés dans une grille avec des images, des descriptions, des prix et des évaluations.
- **Ajout au panier** : Les utilisateurs peuvent ajouter des produits au panier en cliquant sur le bouton "Ajouter au panier".
- **Affichage du panier** : Le panier est visible lorsqu'un utilisateur clique sur l'icône du panier. Il contient la liste des produits ajoutés ainsi que le total du panier.
- **Suppression du panier** : Les utilisateurs peuvent supprimer des produits individuels de leur panier.
- **Passer commande** : Une fois le panier prêt, les utilisateurs peuvent cliquer sur le bouton "Passer commande" pour finaliser leur achat.


## License

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.

