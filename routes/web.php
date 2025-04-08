<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Mail\detectlog;


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
    // Dashboard route
    Route::get('/', [CustomerController::class, 'index'])->name('customer.dashboard');

    // Cart routes
    Route::post('/panier', [PanierController::class, 'store']);
    Route::post('/panier/{id}/ajouter', [PanierController::class, 'ajouterArticle']);
    Route::delete('/panier/{id}/retirer/{produitId}', [PanierController::class, 'retirerArticle']);
    Route::put('/panier/{id}/modifier/{produitId}', [PanierController::class, 'modifierQteArticle']);
    Route::get('/paniers', [PanierController::class, 'show']);

    // Order routes
    Route::get('/commande', [CommandeController::class, 'index'])->name('customer.commande');  // Show cart or order view
    Route::get('/commande/reciept/{id}', [CommandeController::class, 'show'])->name('commande.show');  // Show specific order details
    Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store');
});

// Authentication Routes (already included by Breeze/Fortify)
require __DIR__.'/auth.php';
Route::get('/produits', [ProduitController::class, 'index'])->name('produits');
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

