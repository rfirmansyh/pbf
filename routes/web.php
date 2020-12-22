<?php

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

// Route::group(['prefix' => 'ui/dashboard/mitra'], function () {
//     Route::view('/', 'ui/dashboard/modules/mitra/index');
//     Route::view('/budidaya', 'ui/dashboard/modules/mitra/budidaya/index');
//     Route::view('/budidaya/create', 'ui/dashboard/modules/mitra/budidaya/create');
//     Route::view('/budidaya/edit', 'ui/dashboard/modules/mitra/budidaya/edit');
//     Route::view('/budidaya/show', 'ui/dashboard/modules/mitra/budidaya/show');
// });

// Route::group(['prefix' => 'ui/dashboard/admin'], function () {
//     Route::view('/', 'ui/dashboard/modules/admin/index');
//     Route::view('/users', 'ui/dashboard/modules/admin/users/index');
//     Route::view('/users/create', 'ui/dashboard/modules/admin/users/create');
//     Route::view('/users/show', 'ui/dashboard/modules/admin/users/show');
//     Route::view('/users/edit', 'ui/dashboard/modules/admin/users/edit');
// });

Route::group(['prefix' => 'ui'], function () {
    // Route::view('/login', 'ui/auth/login');
    // Route::view('/register', 'ui/auth/register');
    // Route::view('/verify', 'ui/auth/verify');
    // Route::view('/passwords/confirm', 'ui/auth/passwords/confirm');
    // Route::view('/passwords/email', 'ui/auth/passwords/email');
    // Route::view('/passwords/reset', 'ui/auth/passwords/reset');


    /* ADMIN */
    Route::view('dashboard/admin/books', 'ui/dashboard/modules/admin/books/index');

    /* MEMBER */
    Route::view('dashboard/member/books', 'ui/dashboard/modules/admin/books/index');
});




// Auth::routes();

