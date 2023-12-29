<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPlaceController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;

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

// home
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('/places-outstanding', 'show_places')->name('places-outstanding');
    Route::get('/places-type/{name}/{id}', 'show_places_type')->name('places-type');
    Route::get('/search', 'search')->name('search');
    Route::get('/place-detail/{id}', 'show_place_detail')->name('place-detail');
});

// user
Route::controller(UserController::class)->group(function () {
    Route::resource('/user');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/change_password', 'change_password')->name('change_password');
    Route::put('/update_password', 'update_password')->name('update_password');
    Route::post('/forgot_password', 'forgot_password')->name('forgot_password');
});

// place
Route::resource('/place', PlaceController::class);
Route::post('/evaluate/{id}', [EvaluateController::class, 'evaluate'])->name('evaluate');

// admin routes
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'home');
    Route::post('/admin-login', 'login')->name('admin-login');
    Route::get('/admin-logout', 'logout')->name('admin-logout');
});

// admin places
Route::controller(AdminPlaceController::class)->group(function () {
    Route::get('/places', 'show_places')->name('places');
    Route::get('/place_detail/{id}', 'show_place_detail')->name('place_detail');
    Route::get('/delete_place/{id}', 'delete_place')->name('delete_place');

    Route::get('/approves', 'show_approves')->name('approves');
    Route::get('/approve_detail/{id}', 'show_approve_detail')->name('approve_detail');
    Route::put('/approve/{id}', 'approve_place')->name('approve');
    Route::get('/delete_approve/{id}', 'delete_approve')->name('delete_approve');
});

// admin users
Route::controller(AdminUserController::class)->group(function () {
    Route::get('/suppliers', 'show_suppliers')->name('suppliers');
    Route::get('/members', 'show_members')->name('members');
    Route::put('/authorize_supplier/{id}', 'authorize_supplier')->name('authorize_supplier');
    Route::get('/delete_member/{id}', 'delete_member')->name('delete_member');
});

// admin comments
Route::controller(EvaluateController::class)->group(function () {
    Route::get('/comments', 'show_comments')->name('comments');
    Route::put('/hide_comment/{id}', 'hide_comment')->name('hide_comment');
    Route::put('/show_comment/{id}', 'show_comment')->name('show_comment');
});
