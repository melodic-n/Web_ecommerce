<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    
    .dashboard {
        display: flex;
        min-height: 100vh;
    }
    
    .sidebar {
        width: 250px;
        background-color: #333;
        color: #fff;
        padding: 20px;
    }
    
    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .sidebar ul {
        list-style: none;
        padding: 0;
    }
    
    .sidebar ul li {
        margin: 15px 0;
    }
    
    .sidebar ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        display: block;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    
    .sidebar ul li a:hover {
        background-color: #555;
    }
    
    .sidebar ul li a.active {
        background-color: #ff9800;
        color: #fff;
    }
    
    .content {
        flex: 1;
        padding: 20px;
        background-color: #fff;
    }
    
    header h1 {
        margin-bottom: 20px;
        color: #333;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    button {
        padding: 10px 20px;
        background-color: #ff9800;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    
    button:hover {
        background-color: #e68900;
    }
    
    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }
    
    table th,
    table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    table th {
        background-color: #f4f4f4;
        font-weight: bold;
        color: #333;
    }
    
    table tr:hover {
        background-color: #f9f9f9;
    }
    
    /* Hidden Class for Sections */
    .hidden {
        display: none;
    }
    
    /* Dashboard Section */
    .dashboard-content {
        text-align: center;
    }
    
    .dashboard-image {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
    }
    
    #addAdminButton {
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    
    #addAdminButton:hover {
        background-color: #218838;
    }
    
    /* Admin Form */
    #adminForm {
        margin-top: 20px;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Actions Buttons */
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    
    .action-buttons button {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }
    
    .action-buttons button.edit {
        background-color: #ffc107;
        color: #000;
    }
    
    .action-buttons button.delete {
        background-color: #dc3545;
        color: #fff;
    }
    
    .action-buttons button.edit:hover {
        background-color: #e0a800;
    }
    
    .action-buttons button.delete:hover {
        background-color: #c82333;
    }

    /* Dashboard specific styles */
    .dashboard-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
    }

    header h1 {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    #addAdminButton {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    #addAdminButton:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }
    /* Add to your existing styles */
.customer-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.customer-table th, 
.customer-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.customer-table th {
    background-color: #f4f4f4;
}
.order-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.order-table th, 
.order-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.order-table th {
    background-color: #f4f4f4;
}
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        
.modal {
    display: none; /* Initially hidden */
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(218, 218, 218, 0.96); /* Semi-transparent background */
}

.modal-dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 500px;
}

        /* Sidebar styles - unchanged from your original */
        .sidebar {
            width: 220px;
            background: #1a1a1a; /* Dark background */
            color: white;
            padding: 25px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            padding: 0 15px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            padding: 12px 25px;
            margin: 5px 0;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .sidebar li:hover {
            background: rgba(255,255,255,0.1);
            border-left: 4px solid #ff6d00;
        }

        .sidebar li.active {
            background: rgba(255,255,255,0.15);
            border-left: 4px solid #ff6d00;
        }

        .sidebar li i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            padding: 40px;
            background-color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .welcome-title {
            font-size: 2.5rem;
            color: #1a1a1a;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .welcome-subtitle {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: #1a1a1a;
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            min-width: 200px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        /* Hover effects for stat cards */
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            background: #ff6d00;
        }

        .stat-card:hover .stat-value {
            color: white;
        }

        .stat-card:hover .stat-label {
            color: rgba(255,255,255,0.9);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #ff6d00;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ff6d00;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .stat-label {
            font-size: 1rem;
            color: #aaa;
            transition: color 0.3s;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            border: none;
        }

        .btn-primary {
            background: #ff6d00;
            color: white;
            box-shadow: 0 4px 15px rgba(255, 109, 0, 0.3);
        }

        .btn-primary:hover {
            background: #e65100;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 109, 0, 0.4);
        }

        .btn-secondary {
            background: #1a1a1a;
            color: white;
            border: 2px solid #1a1a1a;
        }

        .btn-secondary:hover {
            background: transparent;
            color: #1a1a1a;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
                align-items: center;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
        }

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script>
document.addEventListener('DOMContentLoaded', function() {
    // Navigation between sections
    const sections = {
        dashboardLink: "dashboardSection",
        productsLink: "productsSection",
        ordersLink: "ordersSection",
        customersLink: "customersSection"
    };

    // Set click handlers for each nav link
    Object.keys(sections).forEach(linkId => {
        document.getElementById(linkId)?.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Hide all sections
            Object.values(sections).forEach(sectionId => {
                const section = document.getElementById(sectionId);
                if (section) section.classList.add('hidden');
            });
            
            // Show the selected section
            const targetSection = document.getElementById(sections[linkId]);
            if (targetSection) targetSection.classList.remove('hidden');
            
            // Update active link styling
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.classList.remove('active');
            });
            e.target.classList.add('active');
        });
    });

    // Default to showing dashboard
    document.getElementById('dashboardSection')?.classList.remove('hidden');
});
</script>
</head>
<body>
  <div class="dashboard">
  <aside class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="#" id="productsLink" class="{{ request()->is('admin/products*') ? 'active' : '' }}">Products</a></li>
        <li><a href="#" id="ordersLink">Orders</a></li>
        <li><a href="#" id="customersLink">Customers</a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            @csrf
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            </form>
        </li>
    </ul>
</aside>
    <main class="content">


      <!-- Dashboard Section -->
      
      <div class="main-content">
        <div class="dashboard-container">
            <div class="welcome-section">
                <h1 class="welcome-title">Welcome Back, Admin!</h1>
                <p class="welcome-subtitle">Here's what's happening with your store today. Manage your products, track orders, and connect with customers from this dashboard.</p>
            </div>

            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-value">1,248</div><!--   change this  -!> -->
                    <div class="stat-label">Total Products</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">326</div>
                    <div class="stat-label">New Orders</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">5,892</div>
                    <div class="stat-label">Customers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">$24,760</div>
                    <div class="stat-label">Revenue</div>
                </div>
            </div>

            <div class="action-buttons">
          <!-- Button in your dashboard -->
<button id="showProductsBtn" class="btn btn-primary">
    <i class="fas fa-plus"></i> Add New Product
</button>

<!-- JavaScript solution -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const showBtn = document.getElementById('showProductsBtn');
    const productsSection = document.getElementById('productsSection');
    
    if (showBtn && productsSection) {
        showBtn.addEventListener('click', function() {
            // First remove the hidden class
            productsSection.classList.remove('hidden');
            
            // Then scroll to the section smoothly
            productsSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            
            // Optional: Focus on the first input field
            const firstInput = productsSection.querySelector('input[name="nom_prod"]');
            if (firstInput) {
                firstInput.focus();
            }
        });
    } else {
        console.error('Could not find required elements:', {
            button: showBtn,
            section: productsSection
        });
    }
});
</script>
<button class="btn btn-secondary" id="showOrdersBtn">
    <i class="fas fa-clipboard-list"></i> See Your Orders
</button>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Products Section Toggle (keep your existing code)
    const showProductsBtn = document.getElementById('showProductsBtn');
    const productsSection = document.getElementById('productsSection');
    
    if (showProductsBtn && productsSection) {
        showProductsBtn.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') e.preventDefault();
            productsSection.classList.remove('hidden');
            productsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }

    // New Orders Section Toggle
    const showOrdersBtn = document.getElementById('showOrdersBtn');
    const ordersSection = document.getElementById('ordersSection');
    
    if (showOrdersBtn && ordersSection) {
        showOrdersBtn.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') e.preventDefault();
            
            // Hide products section if visible
            if (productsSection && !productsSection.classList.contains('hidden')) {
                productsSection.classList.add('hidden');
            }
            
            // Show orders section
            ordersSection.classList.remove('hidden');
            ordersSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }
});
</script>

            </div>
        </div>
    </div>

 
        <!-- <div class="dashboard-content">
          <img src="C:\Users\hp\Desktop\dashboard\Welcome-Vector-Graphics-7974449-1-1-580x387 (1).png" alt="Welcome Illustration" class="dashboard-image">
         
          <button id="addAdminButton">Add New Admin</button>
          <div id="adminForm" class="hidden">
            <form id="addAdminForm">
              <div class="form-group">
                <label for="adminName">Full Name</label>
                <input type="text" id="adminName" name="adminName" required>
              </div>
              <div class="form-group">
                <label for="adminAddress">Address</label>
                <input type="text" id="adminAddress" name="adminAddress" required>
              </div>
              <div class="form-group">
                <label for="adminEmail">Email</label>
                <input type="email" id="adminEmail" name="adminEmail" required>
              </div>
              <div class="form-group">
                <label for="adminPassword">Password</label>
                <input type="password" id="adminPassword" name="adminPassword" required>
              </div>
              <button type="submit">Save Admin</button>
            </form>
          </div>
        </div> i dont think we need tus ne -->
      </section>






      <!-- Products Section -->
      <section id="productsSection" class="hidden">
    <header>
        <h1>Manage Products</h1>
    </header>
    <div class="product-form">
    <form id="addProductForm"
      action="{{ route('admin.products.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="nom_prod">Product Name</label>
        <input type="text" class="form-control" id="nom_prod" name="nom_prod" required>
    </div>

    <div class="form-group">
        <label for="prix">Price</label>
        <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" required>
    </div>

    <div class="form-group">
        <label for="quantite">Quantity</label>
        <input type="number" class="form-control" id="quantite" name="quantite" required>
    </div>

    <div class="form-group">
        <label for="img_prod">Product Image</label>
        <input type="file" class="form-control" id="img_prod" name="img_prod">
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>



    </div>
    <div class="product-list">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>
  <span style="display:inline-block; width: 400px;"></span>Actions
</th>

                </tr>
            </thead>
            <tbody>
            @foreach($produits as $produit) 
<tr>
    <td>{{ $produit->nom_prod }}</td>
    <td>{{ $produit->prix }}</td>
    <td>{{ $produit->description }}</td>

    <td class="action-buttons">
        <!-- Edit Button -->
        <button class="btn btn-primary" onclick="openEditModal({{ $produit->id }}, '{{ $produit->nom_prod }}', {{ $produit->prix }}, '{{ $produit->description }}')">Edit</button>
        <div class="modal" id="editModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeEditModal()"></button>
            </div>
            <form id="editProductForm" action="{{ route('admin.products.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH') <!-- This is needed to simulate a PATCH request -->

    <div class="modal-body">
        <div class="form-group">
            <label for="nom_prod">Product Name</label>
            <input type="text" id="nom_prod" name="nom_prod" class="form-control" value="{{ old('nom_prod', $produit->nom_prod) }}" >
        </div>

        <div class="form-group">
            <label for="prix">Price</label>
            <input type="number" id="prix" name="prix" class="form-control" value="{{ old('prix', $produit->prix) }}" >
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $produit->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $produit->category) }}">
        </div>

        <div class="form-group">
            <label for="quantite">Quantity</label>
            <input type="number" id="quantite" name="quantite" class="form-control" value="{{ old('quantite', $produit->quantite) }}">
        </div>

        <div class="form-group">
            <label for="img_prod">Product Image</label>
            <input type="file" id="img_prod" name="img_prod" class="form-control">
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeEditModal()">Close</button>
        <button type="submit" class="btn btn-success">Update Product</button>
    </div>
</form>

        </div>
    </div>
</div>


        <!-- Delete Form -->
        <form class="delete-form" method="POST" action="{{ route('admin.products.destroy', $produit->id) }}">
            @csrf @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach

    </tbody>
        </table>
    </div>
</section>

<script>
  function openEditModal(id, name, price, description, category, quantity) {
    const form = document.getElementById('editProductForm');
    form.action = '/admin/products/' + id;

    // Get the current values in the fields before setting new ones
    const currentName = document.getElementById('nom_prod').value;
    const currentPrice = document.getElementById('prix').value;
    const currentDescription = document.getElementById('description').value;
    const currentCategory = document.getElementById('category').value;
    const currentQuantity = document.getElementById('quantite').value;

    // Set new values or retain the previous ones if no new values are provided
    document.getElementById('nom_prod').value = name || currentName;
    document.getElementById('prix').value = price || currentPrice;
    document.getElementById('description').value = description || currentDescription;
    document.getElementById('category').value = category || currentCategory;
    document.getElementById('quantite').value = quantity || currentQuantity;

    // Show the modal
    document.getElementById('editModal').style.display = 'block';
}

    


    function closeEditModal() {
        // Hide the modal
        document.getElementById('editModal').style.display = 'none';
    }

// // Edit Product
// function loadProductToForm(productId) {
//     // Fetch product data from the server
//     fetch(`/produits/${productId}/edit`)
//         .then(response => response.json())
//         .then(product => {
//             // Fill the form fields with the fetched product data
//             document.getElementById('nom_prod').value = product.nom_prod;
//             document.getElementById('prix').value = product.prix;
//             document.getElementById('description').value = product.description;
//             document.getElementById('category').value = product.category;
//             document.getElementById('quantite').value = product.quantite;
            
//             // Set the form action to update the product (PATCH/PUT)
//             const form = document.getElementById('addProductForm');
//             form.action = `/produits/${productId}`;
            
//             // Add or ensure _method field for PUT (for updating the product)
//             let methodInput = form.querySelector('input[name="_method"]');
//             if (!methodInput) {
//                 methodInput = document.createElement('input');
//                 methodInput.type = 'hidden';
//                 methodInput.name = '_method';
//                 methodInput.value = 'PUT';
//                 form.appendChild(methodInput);
//             }
            
//             // Change the button text to 'Update Product'
//             const submitButton = form.querySelector('button[type="submit"]');
//             submitButton.textContent = 'Update Product';
//         })
//         .catch(error => {
//             console.error('Failed to load product data:', error);
//             alert('Failed to load product data for editing.');
//         });
// }

// Add event listener to all edit buttons dynamically
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');
            loadProductToForm(productId); // Call the function to load the product data into the form
        });
    });
});


// Reset form when adding new product
function resetProductForm() {
  document.getElementById('addProductForm').reset();
  const form = document.getElementById('addProductForm');
  form.action = '/produits';
  form.querySelector('button[type="submit"]').textContent = 'Add Product';
  const methodInput = form.querySelector('input[name="_method"]');
  if (methodInput) form.removeChild(methodInput);
}
</script>





   
      

      <!-- Orders Section -->
     <!-- Orders Section -->
<section id="ordersSection" class="hidden">
    <header>
        <h1>Manage Orders</h1>
    </header>
    <div class="order-list">
        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->user->name ?? 'N/A' }}</td>
                    <td>{{ number_format($commande->montant, 2) }} €</td>
                    <td>{{ ucfirst($commande->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

      <!-- Customers Section -->
      <!-- Customers Section -->
<section id="customersSection" class="hidden">
    <header>
        <h1>Manage Customers</h1>
        
    </header>
    <div class="customer-list">
        <table class="customer-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->prenom }}</td>
                    <td>{{ $customer->nom }}</td>
                    <td>{{ $customer->tel }}</td>
                    <td>{{ Str::limit($customer->adresse, 30) }}</td>
                </tr>
                @endforeach

               
            </tbody>
        </table>
    </div>
</section>
    </main>
  </div>
  <script>
    // Mock API using Local Storage
    const PRODUCTS_KEY = "products";
    const ORDERS_KEY = "orders";
    const CUSTOMERS_KEY = "customers";
    const ADMINS_KEY = "admins";
    // In your section toggle code
const sections = {
    dashboardLink: "dashboardSection",
    productsLink: "productsSection",
    customersLink: "customersSection", // Add this
    ordersLink: "ordersSection"
};

    // // Function to fetch data from local storage
    // function getData(key) {
    //   const data = localStorage.getItem(key);
    //   return data ? JSON.parse(data) : [];
    // }

    // // Function to save data to local storage
    // function saveData(key, data) {
    //   localStorage.setItem(key, JSON.stringify(data));
    // }

    // // Function to render products in the table
    // function renderProducts() {
    //   const products = getData(PRODUCTS_KEY);
    //   const tableBody = document.querySelector("#productTable tbody");
    //   tableBody.innerHTML = "";

    //   products.forEach((product, index) => {
    //     const row = document.createElement("tr");
    //     row.innerHTML = `
    //       <td>${product.name}</td>
    //       <td>$${product.price}</td>
    //       <td>${product.description}</td>
    //       <td class="action-buttons">
    //         <button class="edit" onclick="editProduct(${index})">Edit</button>
    //         <button class="delete" onclick="deleteProduct(${index})">Delete</button>
    //       </td>
    //     `;
    //     tableBody.appendChild(row);
    //   });
    // }

    // Function to render orders in the table
    function renderOrders() {
      const orders = getData(ORDERS_KEY);
      const tableBody = document.querySelector("#orderTable tbody");
      tableBody.innerHTML = "";

      orders.forEach((order, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${order.orderId}</td>
          <td>${order.customerName}</td>
          <td>$${order.orderTotal}</td>
          <td class="action-buttons">
            <button class="edit" onclick="editOrder(${index})">Edit</button>
            <button class="delete" onclick="deleteOrder(${index})">Delete</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    // Function to render customers in the table
    function renderCustomers() {
      const customers = getData(CUSTOMERS_KEY);
      const tableBody = document.querySelector("#customerTable tbody");
      tableBody.innerHTML = "";

      customers.forEach((customer, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${customer.name}</td>
          <td>${customer.email}</td>
          <td>${customer.phone}</td>
          <td class="action-buttons">
            <button class="edit" onclick="editCustomer(${index})">Edit</button>
            <button class="delete" onclick="deleteCustomer(${index})">Delete</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    // // Add Product
    // document.getElementById("addProductForm").addEventListener("submit", (e) => {
    //   e.preventDefault();
    //   const product = {
    //     name: document.getElementById("productName").value,
    //     price: parseFloat(document.getElementById("productPrice").value),
    //     description: document.getElementById("productDescription").value,
    //   };
    //   const products = getData(PRODUCTS_KEY);
    //   products.push(product);
    //   saveData(PRODUCTS_KEY, products);
    //   renderProducts();
    //   document.getElementById("addProductForm").reset();
    // });

    // // Add Order
    // document.getElementById("addOrderForm").addEventListener("submit", (e) => {
    //   e.preventDefault();
    //   const order = {
    //     orderId: document.getElementById("orderId").value,
    //     customerName: document.getElementById("customerName").value,
    //     orderTotal: parseFloat(document.getElementById("orderTotal").value),
    //   };
    //   const orders = getData(ORDERS_KEY);
    //   orders.push(order);
    //   saveData(ORDERS_KEY, orders);
    //   renderOrders();
    //   document.getElementById("addOrderForm").reset();
    // });

    // // Add Customer
    // document.getElementById("addCustomerForm").addEventListener("submit", (e) => {
    //   e.preventDefault();
    //   const customer = {
    //     name: document.getElementById("customerName").value,
    //     email: document.getElementById("customerEmail").value,
    //     phone: document.getElementById("customerPhone").value,
    //   };
    //   const customers = getData(CUSTOMERS_KEY);
    //   customers.push(customer);
    //   saveData(CUSTOMERS_KEY, customers);
    //   renderCustomers();
    //   document.getElementById("addCustomerForm").reset();
    // });

    // // Add Admin
    // document.getElementById("addAdminForm").addEventListener("submit", (e) => {
    //   e.preventDefault();
    //   const admin = {
    //     name: document.getElementById("adminName").value,
    //     address: document.getElementById("adminAddress").value,
    //     email: document.getElementById("adminEmail").value,
    //     password: document.getElementById("adminPassword").value,
    //   };
    //   const admins = getData(ADMINS_KEY);
    //   admins.push(admin);
    //   saveData(ADMINS_KEY, admins);
    //   alert("New admin added successfully!");
    //   document.getElementById("addAdminForm").reset();
    //   document.getElementById("adminForm").classList.add("hidden");
    // });

    // // Edit Product
    // function editProduct(index) {
    //   const products = getData(PRODUCTS_KEY);
    //   const product = products[index];
    //   document.getElementById("productName").value = product.name;
    //   document.getElementById("productPrice").value = product.price;
    //   document.getElementById("productDescription").value = product.description;
    //   products.splice(index, 1);
    //   saveData(PRODUCTS_KEY, products);
    //   renderProducts();
    // }

    // Delete Product
    function deleteProduct(index) {
      const products = getData(PRODUCTS_KEY);
      products.splice(index, 1);
      saveData(PRODUCTS_KEY, products);
      renderProducts();
    }

    // Edit Order
    function editOrder(index) {
      const orders = getData(ORDERS_KEY);
      const order = orders[index];
      document.getElementById("orderId").value = order.orderId;
      document.getElementById("customerName").value = order.customerName;
      document.getElementById("orderTotal").value = order.orderTotal;
      orders.splice(index, 1);
      saveData(ORDERS_KEY, orders);
      renderOrders();
    }

    // Delete Order
    function deleteOrder(index) {
      const orders = getData(ORDERS_KEY);
      orders.splice(index, 1);
      saveData(ORDERS_KEY, orders);
      renderOrders();
    }

    // Edit Customer
    function editCustomer(index) {
      const customers = getData(CUSTOMERS_KEY);
      const customer = customers[index];
      document.getElementById("customerName").value = customer.name;
      document.getElementById("customerEmail").value = customer.email;
      document.getElementById("customerPhone").value = customer.phone;
      customers.splice(index, 1);
      saveData(CUSTOMERS_KEY, customers);
      renderCustomers();
    }

    // Delete Customer
    function deleteCustomer(index) {
      const customers = getData(CUSTOMERS_KEY);
      customers.splice(index, 1);
      saveData(CUSTOMERS_KEY, customers);
      renderCustomers();
    }

    // Sign Out
    document.getElementById("signOutLink").addEventListener("click", (e) => {
      e.preventDefault();
      alert("You have been signed out.");
      window.location.href = "login.html"; // Redirect to login page
    });

    // Show Admin Form
    document.getElementById("addAdminButton").addEventListener("click", (e) => {
      e.preventDefault();
      document.getElementById("adminForm").classList.remove("hidden");
    });

    

    Object.keys(sections).forEach((linkId) => {
      document.getElementById(linkId).addEventListener("click", (e) => {
        e.preventDefault();
        // Hide all sections
        Object.values(sections).forEach((sectionId) => {
          document.getElementById(sectionId).classList.add("hidden");
        });
        // Show the selected section
        document.getElementById(sections[linkId]).classList.remove("hidden");
        
        // Update active link
        document.querySelectorAll(".sidebar ul li a").forEach(link => {
          link.classList.remove("active");
        });
        e.target.classList.add("active");
      });
    });

    // Initial render
    document.addEventListener("DOMContentLoaded", function() {
      renderProducts();
      renderOrders();
      renderCustomers();
    });
  </script>
</body>
</html>