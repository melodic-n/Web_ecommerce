<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;



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
    return view('welcome');
});

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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');  // Get request to show the form
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');  // Post request to store data
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');

Route::post('/panier', [PanierController::class, 'store']); // For creating a new Panier
Route::get('/panier/{id}', [PanierController::class, 'show']); // id of user
Route::post('/panier/{id}/ajouter', [PanierController::class, 'ajouterArticle']); // d of panier
Route::delete('/panier/{id}/retirer/{produitId}', [PanierController::class, 'retirerArticle']); // id of panier
Route::put('/panier/{id}/modifier/{produitId}', [PanierController::class, 'modifierQteArticle']); // id of panier



Route::post('/commandes/create/{panierId}', [CommandeController::class, 'createOrder']);
Route::get('/commande/{id}', [CommandeController::class, 'index']); // Corrigez le nom du contrôleur ici