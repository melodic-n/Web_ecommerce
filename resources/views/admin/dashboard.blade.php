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
  </style>
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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>
    <main class="content">
      <!-- Dashboard Section -->
      <section id="dashboardSection">
        <header>
          <h1>Welcome to the Admin Dashboard</h1>
        </header>
        <div class="dashboard-content">
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
        </div>
      </section>




      <!-- Products Section -->
      <section id="productsSection" class="hidden">
    <header>
        <h1>Manage Products</h1>
    </header>
    <div class="product-form">
        <form id="productForm" action="{{ isset($product) ? route('produits.update', $product->id) : route('produits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($product) @method('PUT') @endisset
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="nom_prod" value="{{ $product->nom_prod ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="prix" step="0.01" value="{{ $product->prix ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required>{{ $product->description ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="{{ $product->category ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantite" value="{{ $product->quantite ?? '' }}" required>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="img_prod">
                @isset($product->img_prod)
                    <img src="{{ asset('storage/'.$product->img_prod) }}" width="100">
                @endisset
            </div>
            <button type="submit">{{ isset($product) ? 'Update' : 'Add' }} Product</button>
        </form>
    </div>
    <div class="product-list">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                <tr>
                    <td>{{ $produit->nom_prod }}</td>
                    <td>${{ number_format($produit->prix, 2) }}</td>
                    <td>{{ Str::limit($produit->description, 50) }}</td>
                    <td>
                        
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit">Delete</button>
                            <button href="{{ route('produits.edit', $produit->id) }}">Edit</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


   
      

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

    // Function to fetch data from local storage
    function getData(key) {
      const data = localStorage.getItem(key);
      return data ? JSON.parse(data) : [];
    }

    // Function to save data to local storage
    function saveData(key, data) {
      localStorage.setItem(key, JSON.stringify(data));
    }

    // Function to render products in the table
    function renderProducts() {
      const products = getData(PRODUCTS_KEY);
      const tableBody = document.querySelector("#productTable tbody");
      tableBody.innerHTML = "";

      products.forEach((product, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${product.name}</td>
          <td>$${product.price}</td>
          <td>${product.description}</td>
          <td class="action-buttons">
            <button class="edit" onclick="editProduct(${index})">Edit</button>
            <button class="delete" onclick="deleteProduct(${index})">Delete</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

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

    // Add Product
    document.getElementById("addProductForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const product = {
        name: document.getElementById("productName").value,
        price: parseFloat(document.getElementById("productPrice").value),
        description: document.getElementById("productDescription").value,
      };
      const products = getData(PRODUCTS_KEY);
      products.push(product);
      saveData(PRODUCTS_KEY, products);
      renderProducts();
      document.getElementById("addProductForm").reset();
    });

    // Add Order
    document.getElementById("addOrderForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const order = {
        orderId: document.getElementById("orderId").value,
        customerName: document.getElementById("customerName").value,
        orderTotal: parseFloat(document.getElementById("orderTotal").value),
      };
      const orders = getData(ORDERS_KEY);
      orders.push(order);
      saveData(ORDERS_KEY, orders);
      renderOrders();
      document.getElementById("addOrderForm").reset();
    });

    // Add Customer
    document.getElementById("addCustomerForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const customer = {
        name: document.getElementById("customerName").value,
        email: document.getElementById("customerEmail").value,
        phone: document.getElementById("customerPhone").value,
      };
      const customers = getData(CUSTOMERS_KEY);
      customers.push(customer);
      saveData(CUSTOMERS_KEY, customers);
      renderCustomers();
      document.getElementById("addCustomerForm").reset();
    });

    // Add Admin
    document.getElementById("addAdminForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const admin = {
        name: document.getElementById("adminName").value,
        address: document.getElementById("adminAddress").value,
        email: document.getElementById("adminEmail").value,
        password: document.getElementById("adminPassword").value,
      };
      const admins = getData(ADMINS_KEY);
      admins.push(admin);
      saveData(ADMINS_KEY, admins);
      alert("New admin added successfully!");
      document.getElementById("addAdminForm").reset();
      document.getElementById("adminForm").classList.add("hidden");
    });

    // Edit Product
    function editProduct(index) {
      const products = getData(PRODUCTS_KEY);
      const product = products[index];
      document.getElementById("productName").value = product.name;
      document.getElementById("productPrice").value = product.price;
      document.getElementById("productDescription").value = product.description;
      products.splice(index, 1);
      saveData(PRODUCTS_KEY, products);
      renderProducts();
    }

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