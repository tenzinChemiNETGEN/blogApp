<?php

use App\Http\Controllers\BlogPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
/**
 * Home Route
 */
Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Auth route
 */
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

/**
 * Route for list all blogs
 * 
 */
Route::get('/blog',[BlogPostController::class,'index'])->name('blog.index');
Route::get('/blog/{slug}',[BlogPostController::class,'show']);


/**
 *  user blog route
 * 
 */
Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']); //shows create post form
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store'])->name('store'); //saves the created post to the databse
Route::get('edit/{slug}', [\App\Http\Controllers\BlogPostController::class, 'edit'])->name('edit'); //shows edit post form
Route::put('edit/{slug}', [\App\Http\Controllers\BlogPostController::class, 'update'])->name('update'); //commits edited post to the database 
Route::delete('/blog/{slug}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); //deletes post from the database


