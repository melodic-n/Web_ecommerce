<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaypalController; // Make sure this use statement is present

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('customer.acceuilHandies'); // Home page
})->name('home');

Route::get('/about', function () {
    return view('customer.aboutUs');
})->name('about');

Route::get('/contact', function () {
    return view('customer.contactUs');
})->name('contact');

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/redirect');
    })->name('dashboard');

    Route::get('/redirect', function () {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin');
        } else {
            return redirect('/customer');
        }
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('admin.commandes');

    // Product Management Routes for Admin
    Route::get('/products', [ProduitController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProduitController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProduitController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{produit}', [ProduitController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{produit}/edit', [ProduitController::class, 'edit'])->name('admin.products.edit');
    Route::patch('/products/{produit}', [ProduitController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{produit}', [ProduitController::class, 'destroy'])->name('admin.products.destroy');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::post('/panier', [PanierController::class, 'store']);
    Route::post('/panier/{id}/ajouter', [PanierController::class, 'ajouterArticle']);
    Route::delete('/panier/{id}/retirer/{produitId}', [PanierController::class, 'retirerArticle']);
    Route::put('/panier/{id}/modifier/{produitId}', [PanierController::class, 'modifierQteArticle']);
    Route::get('/commande/{id}', [CommandeController::class, 'index']);
    Route::post('/commandes/create', [CommandeController::class, 'createOrder']);
    Route::get('/paniers', [PanierController::class, 'show']);
});

// Authentication Routes (already included by Breeze/Fortify)
require __DIR__.'/auth.php';

// Specific Routes that were outside the groups
Route::get('/acceuilHandies', function () {
    return view('customer.acceuilHandies');
})->name('acceuilHandies');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/user/register', function () {
    return view('customer.user');
})->name('customer.user');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Redundant route - already handled within the admin group
// Route::get('/produits/{id}/edit', [ProduitController::class, 'edit']);
// Route::put('/produits/{id}', [ProduitController::class, 'update']);
// Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
// Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
// Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
// Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
// Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
// Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
// Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');

// Redundant route - already handled within the admin group
// Route::get('produits/{id}/edit', [ProduitController::class, 'edit']);

//         return 'Test insert successful!';
//     } catch (\Exception $e) {
//         return 'Test insert failed: ' . $e->getMessage();
//     }
// });

// routes/web.php or routes/api.php

Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


Route::get('/payment/success-page', function () {
    return view('payment.success');
})->name('payment.success');

Route::get('/payment/cancel-page', function () {
    return view('payment.cancel');
})->name('payment.cancel');

Route::get('/payment/error-page', function () {
    return view('payment.error');
})->name('payment.error');

Route::get('/payment/form', function () {
    return view('payment.form');
})->name('payment.form');

Route::post('/paypal/create', [PaypalController::class, 'createPayment'])->name('paypal.create');

