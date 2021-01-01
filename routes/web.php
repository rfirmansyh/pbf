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


Auth::routes();

Route::group(['namespace' => 'Frontpage', 'as' => 'frontpage.'], function() {
    Route::get('/', 'FrontpageController@index')->name('index');
    Route::get('/about', 'FrontpageController@about')->name('about');
    Route::get('/documentation', 'FrontpageController@documentation')->name('documentation');
});

///============== THIS IS BACKEND ROUTES ==============\\\

// ADMIN
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'dashboard/admin', 'namespace' => 'Dashboard\Admin', 'as' => 'dashboard.admin.'], function() {

    Route::get('/', 'AdminController@index')->name('index');

    Route::get('profile/', 'AdminController@indexProfile')->name('profile.index');
    Route::get('profile/edit', 'AdminController@editProfile')->name('profile.edit');
    Route::put('profile/{user}/update', 'AdminController@updateProfile')->name('profile.update');
    Route::put('profile/{user}/changepassword', 'AdminController@changepassword')->name('profile.changepassword');

    Route::resource('books', 'BookController');

    Route::delete('peminjamans/deletewhere', 'PeminjamanController@deletewhere')->name('peminjamans.deletewhere');
    Route::put('peminjamans/returnwhere', 'PeminjamanController@returnwhere')->name('peminjamans.returnwhere');
    Route::resource('peminjamans', 'PeminjamanController')->except('destroy');
    
    Route::delete('pengembalians/deletewhere', 'PengembalianController@deletewhere')->name('pengembalians.deletewhere');
    Route::resource('pengembalians', 'PengembalianController')->only('index');

    Route::put('users/{user}/changepassword', 'UserController@changepassword')->name('users.changepassword');
    Route::resource('users', 'UserController');

    Route::resource('raks', 'RakController')->except('destroy');
});

Route::group(['middleware' => ['auth', 'role:member'], 'prefix' => 'dashboard/member', 'namespace' => 'Dashboard\Member', 'as' => 'dashboard.member.'], function(){

    Route::get('/', 'MemberController@index')->name('index');

    Route::get('profile/', 'MemberController@indexProfile')->name('profile.index');
    Route::get('profile/edit', 'MemberController@editProfile')->name('profile.edit');
    Route::put('profile/{user}/update', 'MemberController@updateProfile')->name('profile.update');
    Route::put('profile/{user}/changepassword', 'MemberController@changepassword')->name('profile.changepassword');

    Route::get('peminjamans', 'PeminjamanController@index')->name('peminjamans.index');

    Route::resource('books', 'BookController')->only(['index', 'show']);
});


Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'as' => 'ajax.'], function() {
    Route::get('users', 'AjaxController@getUsers')->name('getUsers');
    Route::get('peminjamans/{member_id?}', 'AjaxController@getPeminjamansByMemberId')->name('getPeminjamansByMemberId');
    Route::get('peminjamans', 'AjaxController@getPeminjamans')->name('getPeminjamans');
    Route::get('pengembalians', 'AjaxController@getPengembalians')->name('getPengembalians');
    Route::get('users/{id?}', 'AjaxController@getUserById')->name('getUserById');
    Route::get('books/{id?}', 'AjaxController@getBookById')->name('getBookById');
});
// MEMBER

///============== THIS IS END OF BACKEND ROUTES ==============\\\


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
    Route::view('dashboard/admin/books/show', 'ui/dashboard/modules/admin/books/show');
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
    //Dashboards
    Route::view('dashboard/admin', 'ui/dashboard/modules/admin/index');



    /* MEMBER */
    // Books
    Route::view('dashboard/member/books', 'ui/dashboard/modules/member/books/index');
    Route::view('dashboard/member/books/show', 'ui/dashboard/modules/member/books/show');
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






