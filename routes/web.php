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
        Route::prefix('menu')->group(function () {
            Route::get('{roles}/delete/{id}', 'Master\MenuController@delete')->name('master.menu.delete');
        });
        Route::resource('menu', 'Master\MenuController', ['as' => 'master'])->only(['index', 'store']);

        // Category
        Route::prefix('category')->group(function () {
            Route::get('json', 'Master\CategoryController@json')->name('master.category.json');
            Route::get('{category}/delete', 'Master\CategoryController@delete')->name('master.category.delete');
        });
        Route::resource('category', 'Master\CategoryController', ['as' => 'master'])->except(['destroy']);

        // Wilayah
        Route::prefix('wilayah')->group(function () {
            // Kabupaten
            Route::prefix('kabupaten')->group(function () {
                Route::get('json', 'Master\Wilayah\KabupatenController@json')->name('master.wilayah.kabupaten.json');
            });
            Route::resource('kabupaten', 'Master\Wilayah\KabupatenController', ['as' => 'master.wilayah'])->only(['index']);

            // Kemantren
            Route::prefix('{kabupaten}/kemantren')->group(function () {
                Route::get('json', 'Master\Wilayah\KemantrenController@json')->name('master.wilayah.kemantren.json');
                Route::get('{kemantren}/delete', 'Master\Wilayah\KemantrenController@delete')->name('master.wilayah.kemantren.delete');
            });
            Route::resource('{kabupaten}/kemantren', 'Master\Wilayah\KemantrenController', ['as' => 'master.wilayah'])->except(['destroy']);
        });
    });
});