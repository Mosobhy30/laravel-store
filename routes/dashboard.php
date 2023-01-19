<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\CategoriesController;
use App\Http\Controllers\dashboard\ProductsController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Controllers\dashboard\StoresController;

Route::group(
    [
        'middleware' => ['auth', 'auth.type:admin,super-admin,user' ]
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
        Route::get('/categories/trash', [CategoriesController::class, 'trash'])
            ->name('categories.trash');
        Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])
            ->name('categories.restore');
        Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
            ->name('categories.forceDelete');

        Route::resource('dashboard/categories', CategoriesController::class);

        Route::resource('dashboard/products', ProductsController::class);

        Route::resource('dashboard/stores', StoresController::class);



    }
);
