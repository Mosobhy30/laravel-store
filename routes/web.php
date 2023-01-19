<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\FrontProductsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
->name('home');

Route::get('/products', [FrontProductsController::class, 'index'])
->name('frontproducts.index');

Route::get('/products/{product:slug}', [FrontProductsController::class, 'show'])
->name('frontproducts.show');

Route::resource('cart', CartController::class);





require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';


