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
}function displayCart(cartData) {
    const cartContainer = document.querySelector('#cart-items');
    const totalContainer = document.querySelector('#total-price');

    if (!cartContainer) return;

    cartContainer.innerHTML = '';

    // Ensure we have valid products
    if (!cartData || !cartData.produits || cartData.produits.length === 0) {
        cartContainer.innerHTML = '<p>Votre panier est vide</p>';
        totalContainer.textContent = 'Total: 0 MAD';
        return;
    }

    let total = 0;  // Initialize total price
    cartData.produits.forEach((product) => {
        let productImage = product.img_prod;

        // Ensure the image URL is correctly formatted
        if (!productImage.startsWith('http://') && !productImage.startsWith('https://')) {
            productImage = 'http://127.0.0.1:8000/' + productImage;  // Prepend the base URL
        }

        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <div class="product-name">${product.nom_prod}</div>
            <div class="product-price">${product.prix} MAD</div>
            <div class="product-quantity">
                <button onclick="modifyQuantity(${product.id}, ${product.pivot.quantite - 1})">-</button>
                <span>${product.pivot.quantite}</span>
                <button onclick="modifyQuantity(${product.id}, ${product.pivot.quantite + 1})">+</button>
            </div>
            <button class="remove-from-cart" onclick="removeFromCart(${product.id})">Supprimer</button>
        `;
        cartContainer.appendChild(cartItem);

        // Update the total price
        total += parseFloat(product.prix) * product.pivot.quantite;
    });

    totalContainer.textContent = `Total: ${total.toFixed(2)} MAD`;

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




// JavaScript function to remove item from cart
function removeFromCart(productId) {
    fetch(`/customer/panier/retirer/${productId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.panier) {
            // Optionally update the cart UI with the updated panier
            displayCart(data.panier);  // Assuming you have a function to re-render the cart
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to remove item from cart');
    });
}
function modifyQuantity(produitId, quantity) {
    console.log('Modifying quantity for product ID:', produitId, 'to quantity:', quantity);

    // Make API request to update the quantity in the backend
    fetch(`/customer/panier/modifier/${produitId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ quantite: quantity })  // Sending the updated quantity
    })
    .then(response => {
        console.log('Response status:', response.status);  // Log response status

        if (!response.ok) {
            throw new Error('Failed to update quantity');
        }

        return response.json();  // Try to parse the JSON
    })
    .then(data => {
        console.log('Response data:', data);  // Log the response data

        if (data.message === 'Quantité modifiée') {
            // Re-fetch the updated cart data and re-render it
            fetchCartData();
        }
    })
    .catch(error => {
        console.error('Error modifying quantity:', error);
        // Handle errors properly, maybe show an alert to the user
        alert('There was an error modifying the quantity. Please try again.');
    });
}

// Function to re-fetch and display the updated cart after modification
function fetchCartData() {
    fetch('/customer/paniers')  // Adjust the endpoint as needed
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch updated cart data');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.produits && data.produits.length > 0) {
                displayCart(data);  // Update the cart UI with the new data
            }
        })
        .catch(error => {
            console.error('Error fetching updated cart data:', error);
            alert('There was an error fetching the updated cart. Please try again.');
        });
}

function toggleCart() {
    const cartContainer = document.querySelector('#cart-container');
    console.log('Toggling cart visibility');

    // Make API request to fetch the cart data from the server
    fetch('/customer/paniers')  // Ensure the URL is correct
        .then(response => response.json())
        .then(data => {
            if (data && data.produits && data.produits.length > 0) {
                // If panier and its produits exist and are not empty
                cartContainer.style.display = cartContainer.style.display === 'none' ? 'block' : 'none';
                displayCart(data);  // Pass the data directly to the displayCart function
            } else {
                // If no products in the panier
                console.log('Votre panier est vide');
                cartContainer.innerHTML = '<p>Votre panier est vide</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching cart data:', error);
        });
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
