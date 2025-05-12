<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;
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

Route::get('/', function () {
    return view('home');
});

//Route::get('/categories', function () {return "categories";});
//Route::get('/categories',[CategoriesController::class,'index'])->name('categories.index');
//Route::get('/categories.html',[CategoriesController::class,'index']);
//Route::get('/categories/show/{category}',[CategoriesController::class,'show'])->name('categories.show');
//
//Route::get('/categories/create',[CategoriesController::class,'create'])->name('categories.create');
//Route::post('/categories',[CategoriesController::class,'store'])->name('categories.store');;
//
//Route::get('/categories/{category}/edit',[CategoriesController::class,'edit'])->name('categories.edit');
//Route::put('/categories/{category}',[CategoriesController::class,'update'])->name('categories.update');;
//
//Route::delete('/categories/{category}/destroy',[CategoriesController::class,'destroy'])->name('categories.destroy');;
//
Route::group([
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
//    'middleware' => 'auth'
], function () {
    Route::resource('categories',
        CategoriesController::class);
});

