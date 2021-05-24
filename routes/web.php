<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'App\Http\Controllers\IndexController')->name('index');

Route::get('/catalog/index', 'App\Http\Controllers\CatalogController@index')->name('catalog.index');
Route::get('/catalog/category/{slug}', 'App\Http\Controllers\CatalogController@category')->name('catalog.category');
Route::get('/catalog/brand/{slug}', 'App\Http\Controllers\CatalogController@brand')->name('catalog.brand');
Route::get('/catalog/product/{slug}', 'App\Http\Controllers\CatalogController@product')->name('catalog.product');

Route::get('/basket/index', 'App\Http\Controllers\BasketController@index')->name('basket.index');
Route::get('/basket/checkout', 'App\Http\Controllers\BasketController@checkout')->name('basket.checkout');
Route::post('/basket/add/{id}', 'App\Http\Controllers\BasketController@add')
    ->where('id', '[0-9]+')
    ->name('basket.add');
Route::post('/basket/plus/{id}', 'App\Http\Controllers\BasketController@plus')
    ->where('id', '[0-9]+')
    ->name('basket.plus');
Route::post('/basket/minus/{id}', 'App\Http\Controllers\BasketController@minus')
    ->where('id', '[0-9]+')
    ->name('basket.minus');
Route::post('/basket/remove/{id}', 'App\Http\Controllers\BasketController@remove')
    ->where('id', '[0-9]+')
    ->name('basket.remove');
Route::post('/basket/clear', 'App\Http\Controllers\BasketController@clear')->name('basket.clear');

Route::name('user.')->prefix('user')->group(function () {
    Route::get('index', 'App\Http\Controllers\UserController@index')->name('index');
    Auth::routes();
});
