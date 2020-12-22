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

// Route::group(['prefix' => 'ui'], function () {
//     Route::view('/login', 'ui/auth/login');
//     Route::view('/register', 'ui/auth/register');
//     Route::view('/verify', 'ui/auth/verify');
//     Route::view('/passwords/confirm', 'ui/auth/passwords/confirm');
//     Route::view('/passwords/email', 'ui/auth/passwords/email');
//     Route::view('/passwords/reset', 'ui/auth/passwords/reset');
// });




Auth::routes();

Route::group(['namespace' => 'Frontpage', 'as' => 'frontpage.'], function() {
    Route::get('/', 'FrontpageController@home')->name('home');
});

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'dashboard/admin', 'namespace' => 'Dashboard\Admin', 'as' => 'dashboard.admin.'], function() {
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/profile', 'DashboardController@profile')->name('profile');
    
    // Modules : users
    Route::get('users/{user}/delete', 'UserController@delete')->name('users.delete');
    Route::resource('users', 'UserController');

    // Modules : posts
    Route::get('posts/{post}/delete', 'PostController@delete')->name('posts.delete');
    Route::get('posts/table/{post}', 'PostController@tableShow')->name('posts.table.show');
    Route::get('posts/table', 'PostController@table')->name('posts.table');
    Route::resource('posts', 'PostController')->except('destroy');

    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'as' => 'ajax.'], function () {
        Route::get('users', 'AdminController@getUsers')->name('users');
        Route::get('posts', 'AdminController@getPosts')->name('posts');
    });
});

Route::group(['middleware' => ['auth', 'role:pekerja'], 'prefix' => 'dashboard/pekerja', 'namespace' => 'Dashboard\Pekerja', 'as' => 'dashboard.pekerja.'], function() {
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/profile', 'DashboardController@profile')->name('profile');

    Route::get('productions', 'ProductionController@index')->name('productions.index');
    Route::post('productions', 'ProductionController@store')->name('productions.store');
    Route::put('productions/inputdata/{production?}', 'ProductionController@inputdata')->name('productions.inputdata');
    Route::put('productions/updatestatus/{production?}', 'ProductionController@updatestatus')->name('productions.updatestatus');

    // Modules : posts
    Route::resource('posts', 'PostController');

    // Ajax
    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'as' => 'ajax.'], function () {
        Route::get('kebutuhans/{kebutuhan?}', 'PekerjaController@getKebutuhanTypeById')->name('getKebutuhanTypeById');
    });
});

Route::group(['middleware' => ['auth', 'role:mitra'], 'prefix' => 'dashboard/mitra', 'namespace' => 'Dashboard\Mitra', 'as' => 'dashboard.mitra.'], function() {
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/profile', 'DashboardController@profile')->name('profile');
    
    // Modules : budidaya
    Route::delete('budidaya/{maintener}', 'BudidayaController@destroyBudidaya')->name('budidaya.maintener.destroy');
    Route::resource('budidaya', 'BudidayaController');

    // Modules : kumbung
    Route::resource('kumbung', 'KumbungController');

    // Modules : kebutuhan type
    Route::resource('kebutuhantypes', 'KebutuhantypeController')->except('show');

    // Modules : production type
    Route::resource('productiontypes', 'ProductiontypeController')->except('show');

    // Modules : productions
    Route::get('productions/table', 'ProductionController@indextable')->name('productions.index.table');
    Route::get('productions/panen', 'ProductionController@indexpanen')->name('productions.index.panen');
    Route::get('productions/panen/analysis', 'ProductionController@panenAnalysis')->name('productions.index.panen.analysis');
    Route::get('productions/{budidaya?}', 'ProductionController@index')->name('productions.index');
    Route::post('productions', 'ProductionController@store')->name('productions.store');
    Route::put('productions/inputdata/{production?}', 'ProductionController@inputdata')->name('productions.inputdata');
    Route::put('productions/updatestatus/{production?}', 'ProductionController@updatestatus')->name('productions.updatestatus');

    // Modules : pekerjas
    Route::put('pekerjas/update/password/{pekerja}', 'PekerjaController@updatePassword')->name('pekerjas.updatePassword');
    Route::resource('pekerjas', 'PekerjaController');

    // Modules : keuangan
    Route::get('keuangans/analysis', 'KeuanganController@analysis')->name('keuangans.analysis');
    Route::get('keuangans', 'KeuanganController@index')->name('keuangans.index');

    // Modules : posts
    Route::resource('posts', 'PostController');

    // Ajax
    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'as' => 'ajax.'], function () {
        Route::get('users/{user?}', 'MitraController@getUserById')->name('users.show');
        Route::get('kebutuhans/{kebutuhan?}', 'MitraController@getKebutuhanTypeById')->name('getKebutuhanTypeById');
        Route::get('productions', 'MitraController@getProductions')->name('getProductions');
        Route::get('pekerjas', 'MitraController@getPekerjas')->name('getPekerjas');
        Route::get('keuangan-bulanans', 'MitraController@getKeuanganBulanans')->name('getKeuanganBulanans');
        Route::get('panen-bulanans', 'MitraController@getPanenBulanans')->name('getPanenBulanans');
    });
});




// Route::get('test', 'Dashboard\Admin\DashboardController@test');

