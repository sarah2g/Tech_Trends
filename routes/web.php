<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\userController;
use App\Http\Controllers\dashboard\postController;
use App\Http\Controllers\dashboard\categoryController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
  Route::get('/user', [userController::class, 'index'])->name('user');
  Route::get('/user/add', [userController::class, 'addUser'])->name('adduser');
  Route::post('/user/add', [userController::class, 'add'])->name('adduser.post');
  Route::get('/user/edit/{id}', [userController::class, 'editUser'])->name('edituser');
  Route::post('/user/edit/{id}', [userController::class, 'update'])->name('update');
  Route::delete('/user/delete/{id}', [userController::class, 'delete'])->name('deleteuser');
  Route::get('/post', [postController::class, 'index'])->name('post');
  Route::get('/post/add', [postController::class, 'addPost'])->name('addpost');
  Route::post('/post/add', [postController::class, 'add'])->name('addpost.post');
  Route::get('/post/edit/{id}', [postController::class, 'editPost'])->name('editpost');
  Route::post('/post/edit/{id}', [postController::class, 'update'])->name('update.post');
  Route::delete('/post/delete/{id}', [postController::class, 'delete'])->name('deletepost');
  Route::get('/category', [categoryController::class, 'index'])->name('category');
  Route::get('/category/add', [categoryController::class, 'addCategory'])->name('addcategory');
  Route::post('/category/add', [categoryController::class, 'add'])->name('addcategory.post');
  Route::get('/category/edit/{id}', [categoryController::class, 'editCategory'])->name('editcategory');
  Route::post('/category/edit/{id}', [categoryController::class, 'update'])->name('update.category');
  Route::delete('/category/delete/{id}', [categoryController::class, 'delete'])->name('deletecategory');
  Route::get('/category/{id}', [categoryController::class, 'show'])->name('showcategory');
  Route::get('/post/{id}', [postController::class, 'show'])->name('showpost');
  Route::get('/user/{id}', [userController::class, 'show'])->name('showuser');

});
require __DIR__.'/auth.php';
