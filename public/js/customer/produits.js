// Cart functionality
let cart = JSON.parse(localStorage.getItem('cart')) || [];

document.addEventListener('DOMContentLoaded', function() {
    // Attach event listeners to all add-to-cart buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const productElement = e.target.closest('.rectangle');
            const productName = productElement.querySelector('.product-name').textContent;
            const productPrice = productElement.querySelector('.product-price').textContent;
            
            // Extract image URL correctly
            let productImage = productElement.querySelector('.image-container').style.backgroundImage
                .replace('url("', '')
                .replace('")', '');
            
            // Ensure the image URL has the correct path
            if (!productImage.startsWith('http')) {
                // Prepend the correct base path
                productImage = '/images/customer/' + productImage.split('/').pop(); // Get the file name and prepend the base path
            }
            
            const product = {
                name: productName,
                price: productPrice,
                image: productImage
            };
            
            addToCart(product);
            
            // Show confirmation message
            alert(`${productName} a été ajouté au panier!`);
        });
    });
    
    // Display cart on page load
    displayCart();
});

function displayCart() {
    const cartContainer = document.querySelector('#cart-items');
    const totalContainer = document.querySelector('#total-price');
    
    if (!cartContainer) return; // Guard clause in case elements aren't loaded yet
    
    cartContainer.innerHTML = '';
    
    if (cart.length === 0) {
        cartContainer.innerHTML = '<p>Votre panier est vide</p>';
        totalContainer.textContent = 'Total: 0 MAD';
        return;
    }
    
    cart.forEach((product, index) => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <img src="${product.image}" alt="${product.name}" style="width: 50px; height: 50px; object-fit: cover;">
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
    cartContainer.appendChild(passerCommandeBtn);
}

function calculateTotal() {
    return cart.reduce((total, product) => {
        const price = parseFloat(product.price.replace(' MAD', '').replace(' ', ''));
        return total + price;
    }, 0);
}

function addToCart(product) {
    // Check if the product already exists in the cart
    const existingProductIndex = cart.findIndex(item => item.name === product.name && item.price === product.price && item.image === product.image);
    
    if (existingProductIndex === -1) {
        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart();
    } else {
        alert(`${product.name} est déjà dans votre panier.`);
    }
}

function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}

function toggleCart() {
    const cartContainer = document.querySelector('#cart-container');
    cartContainer.style.display = cartContainer.style.display === 'none' ? 'block' : 'none';
    if (cartContainer.style.display === 'block') {
        displayCart(); // Refresh cart content when opened
    }
}

function closeCart() {
    document.querySelector('#cart-container').style.display = 'none';
}

function passerCommande() {
    window.location.href = orderRoute;
}

// Filter products functionality
function filterProducts() {
    const searchValue = document.getElementById('searchBar').value.trim().toLowerCase();
    const products = document.querySelectorAll('.rectangle');
    
    products.forEach(product => {
        const productName = product.getAttribute('data-name').toLowerCase();
        if (productName.includes(searchValue)) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}
