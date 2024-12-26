<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;


Auth::routes();
Route::group(['prefix' => \LaravelLocalization::setLocale() , 'middleware' => 'auth'], function() {

    Route::get('/', '\App\Http\Controllers\HomeController@index')->name('dashboard.home');

    Route::get('/logout', '\App\Http\Controllers\UserController@logout')->name('dashboard.logout');

    Route::get('/', '\App\Http\Controllers\HomeController@index')->name('dashboard.home');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Books Routes
    Route::get('books/loadAjax', [BookController::class, 'loadAjax'])->name('books.ajax');
    Route::resource('books', BookController::class);

// Borrows Routes
    Route::get('borrows/loadAjax', [BorrowController::class, 'loadAjax'])->name('borrows.ajax');
    Route::resource('borrows', BorrowController::class);

    Route::get('/borrows/check-availability/{bookId}', [BorrowController::class, 'checkAvailability']);

// Roles Routes
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/ajax', [RoleController::class, 'loadAjax'])->name('roles.ajax');

// User Routes
    Route::resource('users', UserController::class);

    Route::get('loadUsers', [UserController::class, 'loadAjax'])->name('users.ajax');

// Routes for changing user password
    Route::get('users/change-password/{id}', [UserController::class, 'change_password_form'])->name('users.change_password_form');
    Route::put('users/change-password/{id}', [UserController::class, 'change_password'])->name('users.changePassword');

});
