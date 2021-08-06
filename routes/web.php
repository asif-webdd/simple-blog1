<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('frontend.home');
});*/


Route::get('/', [BlogController::class, 'index'])->name('home');

Route::get('/category/{slug}', [BlogController::class, 'category_post'])->name('category.post');

Route::get('/sign-up', [BlogController::class, 'signup'])->name('signup');
Route::post('/sign-up', [BlogController::class, 'register'])->name('register');

Route::get('/login', [BlogController::class, 'login_form'])->name('login_form');
Route::post('/login', [BlogController::class, 'login'])->name('login');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::post('logout', [BlogController::class,'logout'])->name('logout');

    Route::resources([
        'category' => CategoryController::class,
        'post' => PostController::class,
    ]);

});
