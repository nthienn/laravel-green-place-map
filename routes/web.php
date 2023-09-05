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
Route::get('/', [HomeController::class, 'home']);
Route::get('/places-outstanding', [HomeController::class, 'show_places'])->name('places-outstanding');
Route::get('/places-type/{name}/{id}', [HomeController::class, 'show_places_type'])->name('places-type');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/place-detail/{id}', [HomeController::class, 'show_place_detail'])->name('place-detail');

// user
Route::resource('/user', UserController::class);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/change_password', [UserController::class, 'change_password'])->name('change_password');
Route::put('/update_password', [UserController::class, 'update_password'])->name('update_password');
Route::post('/forgot_password', [UserController::class, 'forgot_password'])->name('forgot_password');

// place
Route::resource('/place', PlaceController::class);
Route::post('/evaluate/{id}', [EvaluateController::class, 'evaluate'])->name('evaluate');

// admin routes
Route::get('/admin', [AdminController::class, 'home']);
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin-login');
Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin-logout');

Route::get('/places', [AdminPlaceController::class, 'show_places'])->name('places');
Route::get('/place_detail/{id}', [AdminPlaceController::class, 'show_place_detail'])->name('place_detail');
Route::get('/delete_place/{id}', [AdminPlaceController::class, 'delete_place'])->name('delete_place');

Route::get('/approves', [AdminPlaceController::class, 'show_approves'])->name('approves');
Route::get('/approve_detail/{id}', [AdminPlaceController::class, 'show_approve_detail'])->name('approve_detail');
Route::put('/approve/{id}', [AdminPlaceController::class, 'approve_place'])->name('approve');
Route::get('/delete_approve/{id}', [AdminPlaceController::class, 'delete_approve'])->name('delete_approve');

Route::get('/suppliers', [AdminUserController::class, 'show_suppliers'])->name('suppliers');
Route::get('/members', [AdminUserController::class, 'show_members'])->name('members');
Route::put('/authorize_supplier/{id}', [AdminUserController::class, 'authorize_supplier'])->name('authorize_supplier');
Route::get('/delete_member/{id}', [AdminUserController::class, 'delete_member'])->name('delete_member');

Route::get('/comments', [EvaluateController::class, 'show_comments'])->name('comments');
Route::put('/hide_comment/{id}', [EvaluateController::class, 'hide_comment'])->name('hide_comment');
Route::put('/show_comment/{id}', [EvaluateController::class, 'show_comment'])->name('show_comment');
