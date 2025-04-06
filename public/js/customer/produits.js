const products = [
    {
        name: 'Pack: mini handy+ 6 verres',
        image: '/images/customer/Produit1.jpg',  
        price: '200 MAD',
        rating: 4,
        description: 'Pack: mini handy+ 6 verres'
    },
    {
        name: 'Pack: cuillères, verre et assiette',
        image: '/images/customer/Produit2.jpg',  
        price: '250 MAD',
        rating: 4,
        description: 'Pack: cuillères, verre et assiette'
    },
    {
        name: 'Pack: tasses Weavy et assiettes',
        image: '/images/customer/Produit3.jpg',  
        price: '150 MAD',
        rating: 4,
        description: 'Pack: tasses Weavy et assiettes'
    },
    {
        name: 'Mug',
        image: '/images/customer/Produit4.jpg',  
        price: '180 MAD',
        rating: 4,
        description: 'Mug'
    },
    {
        name: 'Gobelets',
        image: '/images/customer/Produit5.jpg',  
        price: '220 MAD',
        rating: 4,
        description: 'Gobelets'
    },
    {
        name: 'Un pichet',
        image: '/images/customer/Produit6.jpg',  
        price: '270 MAD',
        rating: 4,
        description: 'Un pichet'
    },
    {
        name: 'Assiettes',
        image: '/images/customer/Produit7.jpg',  
        price: '230 MAD',
        rating: 4,
        description: 'Assiettes'
    },
    {
        name: 'Jarre en argile',
        image: '/images/customer/Produit8.jpg',  
        price: '300 MAD',
        rating: 5,
        description: 'Jarre en argile'
    },
    {
        name: 'Bol',
        image: '/images/customer/Produit9.jpg',  
        price: '210 MAD',
        rating: 4,
        description: 'Bol'
    },
    {
        name: 'Presse-agrumes',
        image: '/images/customer/Produit10.jpg',  
        price: '190 MAD',
        rating: 3,
        description: 'Presse-agrumes'
    },
    {
        name: 'Tagra',
        image: '/images/customer/Produit11.jpg',  
        price: '190 MAD',
        rating: 3,
        description: 'Tagra'
    },
    {
        name: 'Tabokalt',
        image: '/images/customer/Produit12.jpg',  
        price: '190 MAD',
        rating: 3,
        description: 'Tabokalt'
    }
];

let cart = JSON.parse(localStorage.getItem('cart')) || [];

function displayCart() {
    const cartContainer = document.querySelector('#cart-items');
    const totalContainer = document.querySelector('#total-price');  
    cartContainer.innerHTML = ''; 

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

    const total = calculateTotal();
    totalContainer.textContent = `Total: ${total} MAD`; 

    const passerCommandeBtn = document.createElement('button');
    passerCommandeBtn.classList.add('passer-cmd');
    passerCommandeBtn.textContent = "Passer commande";
    passerCommandeBtn.onclick = passerCommande;

    cartContainer.appendChild(totalContainer);
    cartContainer.appendChild(passerCommandeBtn); 
}

function calculateTotal() {
    return cart.reduce((total, product) => {

        const price = parseFloat(product.price.replace(' MAD', '').replace(' ', ''));
        return total + price; 
    }, 0);
}

function addToCart(product) {
    cart.push(product); 
    localStorage.setItem('cart', JSON.stringify(cart)); 
    displayCart(); 
}

function removeFromCart(index) {
    cart.splice(index, 1); 
    localStorage.setItem('cart', JSON.stringify(cart)); 
    displayCart(); 
}

function toggleCart() {
    const cartContainer = document.querySelector('#cart-container');
    cartContainer.style.display = cartContainer.style.display === 'none' ? 'block' : 'none';
}

function closeCart() {
    document.querySelector('#cart-container').style.display = 'none';
}

function displayProducts() {
    const container = document.querySelector('.products');
    container.innerHTML = ''; 

    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('rectangle');

        const imageContainer = document.createElement('div');
        imageContainer.classList.add('image-container');
        imageContainer.style.backgroundImage = `url('${product.image}')`; 

        const infoContainer = document.createElement('div');
        infoContainer.classList.add('info-container');

        const productRating = document.createElement('div');
        productRating.classList.add('product-rating');
        for (let i = 0; i < 5; i++) {
            const starIcon = document.createElement('i');
            starIcon.classList.add(i < product.rating ? 'fas' : 'far', 'fa-star');
            productRating.appendChild(starIcon);
        }

        const addToCartBtn = document.createElement('button');
        addToCartBtn.classList.add('add-to-cart-btn');
        addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i> Ajouter au panier';
        addToCartBtn.onclick = function() {
            addToCart(product); 
        };

        const productName = document.createElement('div');
        productName.classList.add('product-name');
        productName.textContent = product.name;

        const productPrice = document.createElement('div');
        productPrice.classList.add('product-price');
        productPrice.textContent = product.price;

        const productDescription = document.createElement('div');
        productDescription.classList.add('product-description');
        productDescription.textContent = product.description;

        infoContainer.appendChild(productRating);
        infoContainer.appendChild(addToCartBtn);
        infoContainer.appendChild(productName);
        infoContainer.appendChild(productPrice);
        infoContainer.appendChild(productDescription);

        productDiv.appendChild(imageContainer);
        productDiv.appendChild(infoContainer);

        container.appendChild(productDiv);
    });
}

function filterProducts() {
    let searchTerm = document.querySelector('.search-bar input').value.toLowerCase();
    let productRectangles = document.querySelectorAll('.rectangle');

    productRectangles.forEach(function(rectangle) {
        let productName = rectangle.querySelector('.product-name').textContent.toLowerCase();

        if (productName.includes(searchTerm)) {
            rectangle.style.display = 'block'; 
        } else {
            rectangle.style.display = 'none'; 
        }
    });

    if (searchTerm === '') {
        productRectangles.forEach(function(rectangle) {
            rectangle.style.display = 'block';
        });
    }
}

function passerCommande() {
    window.location.href = 'page_commande.html'; 
}

window.onload = function() {
    displayProducts(); 
    displayCart(); 
};