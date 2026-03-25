<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes des produits
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Panier (accessible à tous)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
});

// Commandes (authentification requise + vérification banni)
Route::middleware(['auth', 'check.banned'])->prefix('orders')->name('orders.')->group(function () {
    // Toutes les routes qui nécessitent d'être connecté et non banni
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
});

// Routes administrateur
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des produits (CRUD complet)
    Route::resource('products', AdminProductController::class);
    
    // Gestion des catégories
    Route::resource('categories', AdminCategoryController::class);
    
    // Gestion des clients/utilisateurs
    // we keep the URI prefix "clients" for clarity but expose route names as "users" to
    // match the controller and views
    Route::prefix('clients')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/ban', [AdminUserController::class, 'ban'])->name('ban');
        Route::post('/{user}/unban', [AdminUserController::class, 'unban'])->name('unban');
    });
    
    // Gestion des commandes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [DashboardController::class, 'orders'])->name('index');
        Route::get('/{id}', [DashboardController::class, 'showOrder'])->name('show');
        Route::post('/{id}/status', [DashboardController::class, 'updateOrderStatus'])->name('update-status');
    });
    
    // Alternative : si vous préférez utiliser resource pour les commandes
    // Route::resource('orders', AdminOrderController::class)->except(['create', 'store', 'edit']);
});