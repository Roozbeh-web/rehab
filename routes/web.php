<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sign-in', [UserController::class, 'getSignIn'])->name('login');
Route::post('/sign-in', [UserController::class, 'postSignIn']);

Route::get('/sign-up', [UserController::class, 'getSignUp'])->name('signup');
Route::post('/sign-up', [UserController::class, 'postSignUp']);

Route::group(['middleware'=>['auth']], function(){
    Route::get('/profile', [UserController::class, 'getProfile']);
    Route::post('/profile', [UserController::class, 'postProfile']);
});