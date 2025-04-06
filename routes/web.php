<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactController;


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


Route::get('/dashboard', function () {
    
    return redirect('/redirect');  
})->middleware(['auth'])->name('dashboard');

Route::get('/redirect', function () {
    if (Auth::user()->role === 'admin') {
        return redirect('/admin');
    } else {
        return redirect('/customer');
    }
})->middleware('auth');



// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::prefix('admin')->group(function () {
//         Route::get('/products', [ProduitController::class, 'apiIndex']); // New method
//         Route::post('/products', [ProduitController::class, 'store']) ->middleware(['auth', 'role:admin']);
//         Route::delete('/products/{produit}', [ProduitController::class, 'destroy']);
//     });
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers');
        
        Route::get('/admin/commandes', [CommandeController::class, 'index'])->name('admin.commandes');
        Route::put('/produits/{id}', [ProduitController::class, 'update']);
        Route::get('/produits/{id}/edit', [ProduitController::class, 'edit']);
        Route::resource('produits', ProduitController::class)->except(['show']);
    });
    Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/', function () {
        return view('customer.acceuilHandies'); // Home page
    })->name('home');
    
    Route::get('/about', function () {
        return view('customer.aboutUs');
    })->name('about');
    
    Route::get('/contact', function () {
        return view('customer.contactUs');
    })->name('contact');
    Route::get('/produits/{id}/edit', [ProduitController::class, 'edit']);
Route::put('/produits/{id}', [ProduitController::class, 'update']);
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');  // Get request to show the form
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');  // Post request to store data
    Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
    Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');

    Route::get('produits/{id}/edit', [ProduitController::class, 'edit']);

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::post('/panier', [PanierController::class, 'store']);
    Route::post('/panier/{id}/ajouter', [PanierController::class, 'ajouterArticle']);
    Route::delete('/panier/{id}/retirer/{produitId}', [PanierController::class, 'retirerArticle']);
    Route::put('/panier/{id}/modifier/{produitId}', [PanierController::class, 'modifierQteArticle']);
    Route::get('/commande/{id}', [CommandeController::class, 'index']);
    Route::post('/commandes/create', [CommandeController::class, 'createOrder']);
        Route::get('/paniers', [PanierController::class, 'show']);
});
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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');



Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');