<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
    'middleware' => ['auth:admin,web']
//    'middleware' => 'auth'
], function () {
    Route::resource('categories',
        CategoriesController::class);
    Route::get('/profile', function () {
       return 'Secret Profile';
    })->middleware('password.confirm');
});
