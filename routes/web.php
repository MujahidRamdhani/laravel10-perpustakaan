<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\bookController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\publicController;
use App\Http\Controllers\rentLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [publicController::class, 'index']);

Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'authenticating']);
Route::get('register', [AuthController::class,'register']);
Route::Post('register', [AuthController::class,'registerProcess']);

Route::get('logout', [AuthController::class, 'logout']);
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('profile', [UserController::class, 'profile'])->middleware('auth');
Route::get('books', [bookController::class, 'index'])->middleware('auth');
Route::get('book-add', [bookController::class, 'create'])->middleware('auth');
Route::post('book-add', [bookController::class, 'store'])->middleware('auth');
Route::get('book-edit/{slug}', [bookController::class, 'edit'])->middleware('auth');
Route::put('book-edit/{slug}', [bookController::class, 'update'])->middleware('auth');
Route::delete('/book-deleted/{slug}', [bookController::class, 'destroy'])->middleware('auth');
Route::get('book-deleted', [bookController::class, 'deletedbook'])->middleware('auth');
Route::get('book-restore/{slug}', [bookController::class, 'restore'])->middleware('auth');

Route::get('book-rent', [BookRentController::class, 'index'])->middleware('auth');
Route::post('book-rent', [BookRentController::class, 'store'])->middleware('auth');



Route::get('categories', [categoryController::class, 'index'])->middleware('auth');
Route::get('category-add', [categoryController::class, 'create'])->middleware('auth');
Route::post('category-add', [categoryController::class, 'store'])->middleware('auth');
Route::get('category-edit/{slug}', [categoryController::class, 'edit'])->middleware('auth');
Route::put('category-edit/{slug}', [categoryController::class, 'update'])->middleware('auth');
Route::delete('/category-deleted/{slug}', [categoryController::class, 'destroy'])->middleware('auth');
Route::get('category-deleted', [categoryController::class, 'deletedCategory'])->middleware('auth');
Route::get('category-restore/{slug}', [categoryController::class, 'restore'])->middleware('auth');

Route::get('users', [UserController::class, 'index'])->middleware('auth');
Route::get('registered-users', [UserController::class, 'registeredUser'])->middleware('auth');
Route::get('user-detail/{slug}', [UserController::class, 'show'])->middleware('auth');
Route::get('user-approve/{slug}', [UserController::class, 'approve'])->middleware('auth');
Route::delete('/user-banned/{slug}', [UserController::class, 'destroy'])->middleware('auth');
Route::get('user-banned', [UserController::class, 'bannedUser'])->middleware('auth');
Route::get('user-restore/{slug}', [UserController::class, 'restore'])->middleware('auth');


Route::get('rent-logs', [rentLogController::class, 'index'])->middleware('auth');;
Route::get('rent-return', [BookRentController::class, 'returnBook'])->middleware('auth');
Route::post('rent-return', [BookRentController::class, 'saveReturnBook'])->middleware('auth');