// Tableau des produits
const products = [
    {
        name: 'Pack: mini handy+ 6 verres',
        image: 'Produit1.jpg',
        price: '200 MAD',
        rating: 4,
        description: 'Pack: mini handy+ 6 verres'
    },
    {
        name: 'Pack: cuillères, verre et assiette',
        image: 'Produit2.jpg',
        price: '250 MAD',
        rating: 4,
        description: 'Pack: cuillères, verre et assiette'
    },
    {
        name: 'Pack: tasses Weavy et assiettes',
        image: 'Produit3.jpg',
        price: '150 MAD',
        rating: 4,
        description: 'Pack: tasses Weavy et assiettes'
    },
    {
        name: 'Mug',
        image: 'Produit4.jpg',
        price: '180 MAD',
        rating: 4,
        description: 'Mug'
    },
    {
        name: 'Gobelets',
        image: 'Produit5.jpg',
        price: '220 MAD',
        rating: 4,
        description: 'Gobelets'
    },
    {
        name: 'Un pichet',
        image: 'Produit6.jpg',
        price: '270 MAD',
        rating: 4,
        description: 'Un pichet'
    },
    {
        name: 'Assiettes',
        image: 'Produit7.jpg',
        price: '230 MAD',
        rating: 4,
        description: 'Assiettes'
    },
    {
        name: 'Jarre en argile',
        image: 'Produit8.jpg',
        price: '300 MAD',
        rating: 5,
        description: 'Jarre en argile'
    },
    {
        name: 'Bol',
        image: 'Produit9.jpg',
        price: '210 MAD',
        rating: 4,
        description: 'Bol'
    },
    {
        name: 'Presse-agrumes',
        image: 'Produit10.jpg',
        price: '190 MAD',
        rating: 3,
        description: 'Presse-agrumes'
    },
    {
        name: 'Tagra',
        image: 'Produit11.jpg',
        price: '190 MAD',
        rating: 3,
        description: 'Tagra'
    },
    {
        name: 'Tabokalt',
        image: 'Produit12.jpg',
        price: '190 MAD',
        rating: 3,
        description: 'Tabokalt'
    }
];

// Tableau du panier (stocké dans localStorage pour persistance)
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Fonction pour afficher les produits dans le panier
function displayCart() {
    const cartContainer = document.querySelector('#cart-items');
    const totalContainer = document.querySelector('#total-price');  // Élément pour afficher le total
    cartContainer.innerHTML = ''; // Vider le panier à chaque affichage

    cart.forEach((product, index) => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <div class="product-name">${product.name}</div>
            <div class="product-price">${product.price}</div>
            <button class="remove-from-cart" onclick="removeFromCart(${index})">Supprimer</button>
        `;
        cartContainer.appendChild(cartItem);
    });

    // Calculer et afficher le total
    const total = calculateTotal();
    totalContainer.textContent = `Total: ${total} MAD`; // Mettre à jour le texte du total

    // Ajouter le bouton "Passer commande"
    const passerCommandeBtn = document.createElement('button');
    passerCommandeBtn.classList.add('passer-cmd');
    passerCommandeBtn.textContent = "Passer commande";
    passerCommandeBtn.onclick = passerCommande;

    // Ajouter le total avant le bouton "Passer commande"
    cartContainer.appendChild(totalContainer);
    cartContainer.appendChild(passerCommandeBtn); // Ajouter le bouton à la fin
}

// Fonction pour calculer le total du panier
function calculateTotal() {
    return cart.reduce((total, product) => {
        // Extraire le prix numérique de la chaîne (en enlevant le ' MAD')
        const price = parseFloat(product.price.replace(' MAD', '').replace(' ', ''));
        return total + price; // Additionner les prix
    }, 0);
}

// Fonction pour ajouter un produit au panier
function addToCart(product) {
    cart.push(product); // Ajouter le produit au panier
    localStorage.setItem('cart', JSON.stringify(cart)); // Sauvegarder le panier dans le localStorage
    displayCart(); // Afficher les produits du panier
}

// Fonction pour supprimer un produit du panier
function removeFromCart(index) {
    cart.splice(index, 1); // Retirer l'élément à l'index donné
    localStorage.setItem('cart', JSON.stringify(cart)); // Mettre à jour le panier dans le localStorage
    displayCart(); // Mettre à jour l'affichage du panier
}

// Fonction pour afficher ou masquer le panier
function toggleCart() {
    const cartContainer = document.querySelector('#cart-container');
    cartContainer.style.display = cartContainer.style.display === 'none' ? 'block' : 'none';
}

// Fonction pour fermer le panier
function closeCart() {
    document.querySelector('#cart-container').style.display = 'none';
}

// Fonction pour afficher les produits
function displayProducts() {
    const container = document.querySelector('.products');
    container.innerHTML = ''; // Vider le conteneur pour un nouvel affichage

    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('rectangle');

        // Conteneur de l'image
        const imageContainer = document.createElement('div');
        imageContainer.classList.add('image-container');
        imageContainer.style.backgroundImage = `url('${product.image}')`; // Assurez-vous que l'image est bien utilisée

        // Conteneur des informations
        const infoContainer = document.createElement('div');
        infoContainer.classList.add('info-container');

        // Section des étoiles
        const productRating = document.createElement('div');
        productRating.classList.add('product-rating');
        for (let i = 0; i < 5; i++) {
            const starIcon = document.createElement('i');
            starIcon.classList.add(i < product.rating ? 'fas' : 'far', 'fa-star');
            productRating.appendChild(starIcon);
        }

        // Bouton Ajouter au panier
        const addToCartBtn = document.createElement('button');
        addToCartBtn.classList.add('add-to-cart-btn');
        addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i> Ajouter au panier';
        addToCartBtn.onclick = function() {
            addToCart(product); // Ajouter au panier quand on clique
        };

        // Nom du produit
        const productName = document.createElement('div');
        productName.classList.add('product-name');
        productName.textContent = product.name;

        // Prix du produit
        const productPrice = document.createElement('div');
        productPrice.classList.add('product-price');
        productPrice.textContent = product.price;

        // Description
        const productDescription = document.createElement('div');
        productDescription.classList.add('product-description');
        productDescription.textContent = product.description;

        // Ajouter les éléments dans le conteneur d'information
        infoContainer.appendChild(productRating);
        infoContainer.appendChild(addToCartBtn);
        infoContainer.appendChild(productName);
        infoContainer.appendChild(productPrice);
        infoContainer.appendChild(productDescription);

        // Ajouter l'image et les informations dans le rectangle produit
        productDiv.appendChild(imageContainer);
        productDiv.appendChild(infoContainer);

        // Ajouter le produit dans le conteneur des produits
        container.appendChild(productDiv);
    });
}

// Fonction pour filtrer les produits
function filterProducts() {
    let searchTerm = document.querySelector('.search-bar input').value.toLowerCase();
    let productRectangles = document.querySelectorAll('.rectangle');

    // Parcours tous les produits
    productRectangles.forEach(function(rectangle) {
        let productName = rectangle.querySelector('.product-name').textContent.toLowerCase();

        // Si le nom du produit correspond à la recherche, on l'affiche, sinon on le cache
        if (productName.includes(searchTerm)) {
            rectangle.style.display = 'block'; // Affiche le produit
        } else {
            rectangle.style.display = 'none'; // Cache le produit
        }
    });

    // Si la barre de recherche est vide, afficher tous les produits
    if (searchTerm === '') {
        productRectangles.forEach(function(rectangle) {
            rectangle.style.display = 'block';
        });
    }
}

// Fonction pour rediriger vers une autre page lorsqu'on clique sur "Passer commande"
function passerCommande() {
    window.location.href = 'page_commande.html'; // Remplacez par l'URL de la page de commande
}

// Affiche les produits au chargement de la page
window.onload = function() {
    displayProducts(); // Afficher les produits
    displayCart(); // Afficher les produits du panier existants
};
