const products = [
    // {
    //     name: 'Pack: mini handy+ 6 verres',
    //     image: '/images/customer/Produit1.jpg',  
    //     price: '200 MAD',
    //     rating: 4,
    //     description: 'Pack: mini handy+ 6 verres'
    // },
    // {
    //     name: 'Pack: cuillères, verre et assiette',
    //     image: '/images/customer/Produit2.jpg',  
    //     price: '250 MAD',
    //     rating: 4,
    //     description: 'Pack: cuillères, verre et assiette'
    // },
    // {
    //     name: 'Pack: tasses Weavy et assiettes',
    //     image: '/images/customer/Produit3.jpg',  
    //     price: '150 MAD',
    //     rating: 4,
    //     description: 'Pack: tasses Weavy et assiettes'
    // },
    // {
    //     name: 'Mug',
    //     image: '/images/customer/Produit4.jpg',  
    //     price: '180 MAD',
    //     rating: 4,
    //     description: 'Mug'
    // },
    // {
    //     name: 'Gobelets',
    //     image: '/images/customer/Produit5.jpg',  
    //     price: '220 MAD',
    //     rating: 4,
    //     description: 'Gobelets'
    // },
    // {
    //     name: 'Un pichet',
    //     image: '/images/customer/Produit6.jpg',  
    //     price: '270 MAD',
    //     rating: 4,
    //     description: 'Un pichet'
    // },
    // {
    //     name: 'Assiettes',
    //     image: '/images/customer/Produit7.jpg',  
    //     price: '230 MAD',
    //     rating: 4,
    //     description: 'Assiettes'
    // },
    // {
    //     name: 'Jarre en argile',
    //     image: '/images/customer/Produit8.jpg',  
    //     price: '300 MAD',
    //     rating: 5,
    //     description: 'Jarre en argile'
    // },
    // {
    //     name: 'Bol',
    //     image: '/images/customer/Produit9.jpg',  
    //     price: '210 MAD',
    //     rating: 4,
    //     description: 'Bol'
    // },
    // {
    //     name: 'Presse-agrumes',
    //     image: '/images/customer/Produit10.jpg',  
    //     price: '190 MAD',
    //     rating: 3,
    //     description: 'Presse-agrumes'
    // },
    // {
    //     name: 'Tagra',
    //     image: '/images/customer/Produit11.jpg',  
    //     price: '190 MAD',
    //     rating: 3,
    //     description: 'Tagra'
    // },
    // {
    //     name: 'Tabokalt',
    //     image: '/images/customer/Produit12.jpg',  
    //     price: '190 MAD',
    //     rating: 3,
    //     description: 'Tabokalt'
    // }
];

let cart = JSON.parse(localStorage.getItem('cart')) || [];  // Initialize cart from localStorage or empty array if not found
async function fetchProducts() {
    try {
        const response = await fetch('/api/products');
        const text = await response.text();  // Read as text to inspect it
        console.log('Raw Response:', text);   // Log the raw response
        const products = JSON.parse(text);    // Parse manually if needed
        displayProducts(products);            // Pass the products to the display function
    } catch (error) {
        console.error('Error fetching products:', error);
    }
}


// Function to display the products dynamically
function displayProducts(products) {
    const container = document.querySelector('.products');
    container.innerHTML = '';  // Clear any existing products

    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('rectangle');

        const imageContainer = document.createElement('div');
        imageContainer.classList.add('image-container');
        imageContainer.style.backgroundImage = `url('${product.image}')`; // Assuming 'image' field contains URL

        const infoContainer = document.createElement('div');
        infoContainer.classList.add('info-container');

        // Create the rating stars
        const productRating = document.createElement('div');
        productRating.classList.add('product-rating');
        for (let i = 0; i < 5; i++) {
            const starIcon = document.createElement('i');
            starIcon.classList.add(i < product.rating ? 'fas' : 'far', 'fa-star'); // Display star ratings
            productRating.appendChild(starIcon);
        }

        // Create the Add to Cart button
        const addToCartBtn = document.createElement('button');
        addToCartBtn.classList.add('add-to-cart-btn');
        addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i> Ajouter au panier';
        addToCartBtn.onclick = function() {
            addToCart(product); // Assuming you have an addToCart function implemented
        };

        // Product details
        const productName = document.createElement('div');
        productName.classList.add('product-name');
        productName.textContent = product.name;

        const productPrice = document.createElement('div');
        productPrice.classList.add('product-price');
        productPrice.textContent = product.prix;

        const productDescription = document.createElement('div');
        productDescription.classList.add('product-description');
        productDescription.textContent = product.description;

        // Append elements to the info container
        infoContainer.appendChild(productRating);
        infoContainer.appendChild(addToCartBtn);
        infoContainer.appendChild(productName);
        infoContainer.appendChild(productPrice);
        infoContainer.appendChild(productDescription);

        // Append image container and info container to the product div
        productDiv.appendChild(imageContainer);
        productDiv.appendChild(infoContainer);

        // Append the product div to the main container
        container.appendChild(productDiv);
    });
}



// Call fetchProducts on page load
window.onload = function() {
    fetchProducts();
    displayCart();
};
function displayCart() {
    const cartContainer = document.querySelector('#cart-items');
    const totalContainer = document.querySelector('#total-price');  
    cartContainer.innerHTML = '';  // Clear the cart content

    cart.forEach((product, index) => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <img src="${product.image}" alt="${product.nom_prod}">
            <div class="product-name">${product.nom_prod}</div>
            <div class="product-price">${product.prix}</div>  <!-- Correct field here -->
            <button class="remove-from-cart" onclick="removeFromCart(${index})">Supprimer</button>
        `;
        cartContainer.appendChild(cartItem);
    });

    const total = calculateTotal();  // Get the total price
    totalContainer.textContent = `Total: ${total} MAD`;  // Display the total

    const passerCommandeBtn = document.createElement('button');
    passerCommandeBtn.classList.add('passer-cmd');
    passerCommandeBtn.textContent = "Passer commande";
    passerCommandeBtn.onclick = passerCommande;  // Handle order placement

    cartContainer.appendChild(totalContainer);
    cartContainer.appendChild(passerCommandeBtn);
}function calculateTotal() {
    return cart.reduce((total, product) => {
        if (product && product.prix) {
            const price = parseFloat(product.prix); // No need for replace() here
            return total + price;
        }
        console.warn("Missing price for product:", product);
        return total;
    }, 0);
}

// Function to handle adding product to cart
function addToCart(product) {
    console.log('Adding product to cart:', product);  // Check the product being added
    cart.push(product);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart(); // Update the cart display
}


function removeFromCart(index) {
    cart.splice(index, 1); 
    localStorage.setItem('cart', JSON.stringify(cart)); 
    displayCart(); 
}

function closeCart() {
    document.querySelector('#cart-container').style.display = 'none';
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
}function passerCommande() {
    console.log("Redirecting to order-summary...");
    window.location.href = '/order-summary'; 
}

// Call fetchProducts when the page loads
window.onload = function() {
    fetchProducts();
    displayCart(); // Assuming you have a displayCart function for the cart
};
// Function to toggle the visibility of the cart
function toggleCart() {
    const cartContainer = document.querySelector('#cart-container');
    if (cartContainer.style.display === 'none' || cartContainer.style.display === '') {
        cartContainer.style.display = 'block';  // Show the cart
    } else {
        cartContainer.style.display = 'none';   // Hide the cart
    }
}

// Example usage of toggleCart function
document.querySelector('#cart-button').onclick = toggleCart;  // Assuming you have a button with ID 'cart-button'
