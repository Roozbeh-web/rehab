<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/new-user-profile', [ProfileController::class, 'getNewUserProfile'])->name('new-profile');
    Route::post('/new-user-profile', [ProfileController::class, 'postNewUserProfile']);
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/edit-profile', [ProfileController::class, 'getEditProfile'])->name('edit-profile');

    Route::get('/leaders', [UserController::class , 'getLeaders'])->name('leaders');

    Route::get('/requests', [UserController::class, 'helpseekersRequest'])->name('requests');
    Route::get('/helpseekers', [UserController::class, 'helpseekers'])->name('helpseekers');

    Route::get('/messages', [MessageController::class, 'getMessages'])->name('messages');

    Route::get('new-plan', [PlansController::class, 'newPlan'])->name('newPlan');
    Route::get('/leader-plans', [PlansController::class, 'leadersPlan'])->name('leaderPlans');
    
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});