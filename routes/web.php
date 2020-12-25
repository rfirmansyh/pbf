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

Route::group(['prefix' => 'back'], function() {

    // ADMIN

    // MEMBER

});

Route::group(['prefix' => 'ui'], function () {
    // Route::view('/login', 'ui/auth/login');
    // Route::view('/register', 'ui/auth/register');
    // Route::view('/verify', 'ui/auth/verify');
    // Route::view('/passwords/confirm', 'ui/auth/passwords/confirm');
    // Route::view('/passwords/email', 'ui/auth/passwords/email');
    // Route::view('/passwords/reset', 'ui/auth/passwords/reset');


    /* ADMIN */
    // Books
    Route::view('dashboard/admin/books', 'ui/dashboard/modules/admin/books/index');
    Route::view('dashboard/admin/books/create', 'ui/dashboard/modules/admin/books/create');
    Route::view('dashboard/admin/books/edit', 'ui/dashboard/modules/admin/books/edit');
    // Peminjamans
    Route::view('dashboard/admin/peminjamans', 'ui/dashboard/modules/admin/peminjamans/index');
    Route::view('dashboard/admin/peminjamans/create', 'ui/dashboard/modules/admin/peminjamans/create');
    Route::view('dashboard/admin/peminjamans/edit', 'ui/dashboard/modules/admin/peminjamans/edit');
    //Pengembalians
    Route::view('dashboard/admin/pengembalians', 'ui/dashboard/modules/admin/pengembalians/index');
    Route::view('dashboard/admin/pengembalians/create', 'ui/dashboard/modules/admin/pengembalians/create');
    //user
    Route::view('dashboard/admin/users', 'ui/dashboard/modules/admin/users/index');
    Route::view('dashboard/admin/users/create', 'ui/dashboard/modules/admin/users/create');
    Route::view('dashboard/admin/users/edit', 'ui/dashboard/modules/admin/users/edit');
    Route::view('dashboard/admin/users/show', 'ui/dashboard/modules/admin/users/show');



    /* MEMBER */
    // Books
    Route::view('dashboard/member/books', 'ui/dashboard/modules/member/books/index');
    // Peminjamans
    Route::view('dashboard/member/peminjamans', 'ui/dashboard/modules/member/peminjamans/index');
    // Pengembalians
    Route::view('dashboard/member/pengembalians', 'ui/dashboard/modules/member/pengembalians/index');
    //Dashboards
    Route::view('dashboard/member', 'ui/dashboard/modules/member/index');
    //Profile
    Route::view('dashboard/member/profile', 'ui/dashboard/modules/member/profile/index');
    Route::view('dashboard/member/profile/edit', 'ui/dashboard/modules/member/profile/edit');
});




// Auth::routes();

