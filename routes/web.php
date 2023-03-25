<?php

use Illuminate\Support\Facades\Route;

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
    return 'index';
});

Route::get('login', 'AuthController@showLoginForm')->name('login');
Route::post('login', 'AuthController@doLogin')->name('do-login');

// authorized
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout', 'AuthController@doLogout')->name('do-logout');

    Route::prefix('master')->group(function () {
        // Menu
        Route::resource('menu', 'Master\MenuController', ['as' => 'master'])->only(['index', 'store']);
        Route::prefix('menu')->group(function () {
            Route::get('{roles}/delete/{id}', 'Master\MenuController@delete')->name('master.menu.delete');
        });
    });
});