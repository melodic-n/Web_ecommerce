document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const productElement = e.target.closest('.rectangle');
            
            if (!productElement) return;

            const productId = productElement.getAttribute('data-id');
            const productName = productElement.querySelector('.product-name').textContent.trim();
            const productPrice = productElement.querySelector('.product-price').textContent.trim();

            let productImage = productElement.querySelector('.image-container').style.backgroundImage
                .replace('url("', '')
                .replace('")', '');

            // If image URL is relative, adjust it to the full URL
            if (!productImage.startsWith('http')) {
                productImage = '/storage/' + productImage.split('/').pop();  // Use the correct base path
            }

            const product = {
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage
            };

            addToCart(product);
        });
    });
    
    displayCart();  // Display the cart when the page loads
});

function addToCart(product) {
    if (!product.id) {
        console.error("Product ID is missing.");
        return;
    }

    console.log('Product being added:', product);

    const payload = {
        produits: [
            {
                id: product.id,
                quantite: 1
            }
        ]
    };

    // Send the data to the backend
    fetch('/customer/panier', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(`${product.name} a été ajouté au panier!`);
            fetch('/customer/paniers')
            .then(response => response.json())
            .then(cartData => {
                console.log('Cart Data:', cartData);  // Check the data here
                if (cartData && cartData.produits) {
                    displayCart(cartData);  // Pass the updated cart to displayCart function
                } else {
                    alert('Erreur lors de la récupération du panier.');
                }
            })
            .catch(error => {
                console.error('Error fetching updated cart:', error);
                alert('Erreur lors de la récupération du panier.');
            });
        
        }
    })
}   function displayCart(panier) {
    const cartContainer = document.querySelector('#cart-items');
    const totalContainer = document.querySelector('#total-price');

    if (!cartContainer) return;

    cartContainer.innerHTML = '';

    if (!panier || !panier.produits || panier.produits.length === 0) {
        cartContainer.innerHTML = '<p>Votre panier est vide</p>';
        totalContainer.textContent = 'Total: 0 MAD';
        return;
    }

    panier.produits.forEach((product) => {
        let productImage = product.img_prod;

        // Check if image URL is relative and fix it
        if (!productImage.startsWith('http://') && !productImage.startsWith('https://')) {
            productImage = 'http://127.0.0.1:8000/' + productImage;  // Prepend the base URL
        }

        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <div class="product-name">${product.nom_prod}</div>
            <div class="product-price">${product.prix} MAD</div>
            <button class="remove-from-cart" onclick="removeFromCart(${product.id})">Supprimer</button>
        `;
        cartContainer.appendChild(cartItem);
    });

    const total = panier.prix_total;
    totalContainer.textContent = `Total: ${total} MAD`;

    // Add "Passer Commande" button
    const orderButton = document.createElement('button');
    orderButton.textContent = 'Passer Commande';
    orderButton.onclick = passerCommande;  // Function to handle the order placement
    cartContainer.appendChild(orderButton);
}
function passerCommande(){
    window.location.href = orderRoute;

}

function calculateTotal() {
    let total = 0;
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    cart.forEach(product => {
        total += parseFloat(product.price.replace(' MAD', '').replace(' ', ''));
    });

    return total.toFixed(2);
}




function removeFromCart(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));  // Update localStorage
    displayCart();  // Re-render the cart display
}
function toggleCart() {
    const cartContainer = document.querySelector('#cart-container');
    console.log('Toggling cart visibility');
    cartContainer.style.display = cartContainer.style.display === 'none' ? 'block' : 'none';
    if (cartContainer.style.display === 'block') {
        displayCart(cartData); // Refresh cart content when opened
    }
}



function closeCart() {
    document.querySelector('#cart-container').style.display = 'none';
}

// function passerCommande() {
//     window.location.href = orderRoute;
// }

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
