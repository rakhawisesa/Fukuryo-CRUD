<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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

/* ================ INDEX ================= */

Route::get('/', [BookController::class, 'index'])->name('book');
Route::get('/author', [AuthorController::class, 'index'])->name('author');
Route::get('/category', [CategoryController::class, 'index'])->name('category');

/* ================ CREATE ================ */
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
Route::get('/book/create', [BookController::class, 'create'])->name('book.create');

/* ================ SAVE ================== */
Route::post('/author/save', [AuthorController::class, 'save'])->name('author.save');
Route::post('/category/save', [CategoryController::class, 'save'])->name('category.save');
Route::post('/book/save', [BookController::class, 'save'])->name('book.save');

/* ================ Delete ================ */
Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::delete('/book/{id}', [BookController::class, 'delete'])->name('book.delete');
Route::delete('/author/{id}', [AuthorController::class, 'delete'])->name('author.delete');

/* ================ Update ================ */
Route::get('/book/{id}', [BookController::class, 'read'])->name('book.read');
Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
Route::get('/author/{id}', [AuthorController::class, 'read'])->name('author.read');
Route::put('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
Route::get('/category/{id}', [CategoryController::class, 'read'])->name('category.read');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
