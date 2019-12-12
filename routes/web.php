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

Route::get('/', function () {
    return redirect('/dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/signin', "AuthController@signin")->name('signin');
Route::post('/postsignin', "AuthController@postsignin");
Route::get('/signout', "AuthController@signout");

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'DashboardController@index');

    // laman RKO (untuk apoteker)
    Route::get('/rko', 'RkoController@index');
    Route::get('/rko/status', 'RkoController@status');
    Route::post('/rko/create', 'RkoController@create');
    Route::get('/rko/{id}/edit', 'RkoController@edit');
    Route::post('/rko/{id}/update', 'RkoController@update');
    Route::get('/rko/{id}/delete', 'RkoController@delete');
    Route::get('/rko/submit', 'RkoController@submit');

    // export import dari excel
    Route::post('/rko/import', 'RkoController@importExcel');
    Route::get('/rko/export', 'RkoController@exportExcel');

    // laman rumah sakit
    Route::get('/rs', 'HospitalController@index')->name('rs');
    Route::get('/rs/{id}/detail', 'HospitalController@detail')->name('rs');
    Route::get('/rs/{id}/detail/approve', 'HospitalController@approve');
    Route::get('/rs/{id}/detail/decline', 'HospitalController@decline');

    // laman tender produksi (untuk tender produksi)
    Route::get('/produksi', 'TenderController@index');
    Route::get('/produksi/{id}', 'TenderController@detail');

    // laman profil
    Route::get('/profil', 'ProfileController@index')->name('profile');
    Route::post('profil/password/change', 'ProfileController@changePassword');

    // laman khusus admin
    Route::get('users', 'OtherController@index');
    Route::post('users/create', 'OtherController@registerNewUser');

    // route lainnya
    Route::get('/users/all', 'OtherController@getAllUsers');
});