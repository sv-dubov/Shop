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
/*
 * Main page
 */
Route::get('/', 'App\Http\Controllers\IndexController')->name('index');
/*
 * Catalog: category, brand, product
 */
Route::get('/catalog/index', 'App\Http\Controllers\CatalogController@index')->name('catalog.index');
Route::get('/catalog/category/{category:slug}', 'App\Http\Controllers\CatalogController@category')->name('catalog.category');
Route::get('/catalog/brand/{brand:slug}', 'App\Http\Controllers\CatalogController@brand')->name('catalog.brand');
Route::get('/catalog/product/{product:slug}', 'App\Http\Controllers\CatalogController@product')->name('catalog.product');
/*
 * Basket
 */
Route::get('/basket/index', 'App\Http\Controllers\BasketController@index')->name('basket.index');
Route::get('/basket/checkout', 'App\Http\Controllers\BasketController@checkout')->name('basket.checkout');
Route::post('/basket/add/{id}', 'App\Http\Controllers\BasketController@add')->where('id', '[0-9]+')->name('basket.add');
Route::post('/basket/plus/{id}', 'App\Http\Controllers\BasketController@plus')->where('id', '[0-9]+')->name('basket.plus');
Route::post('/basket/minus/{id}', 'App\Http\Controllers\BasketController@minus')->where('id', '[0-9]+')->name('basket.minus');
Route::post('/basket/remove/{id}', 'App\Http\Controllers\BasketController@remove')->where('id', '[0-9]+')->name('basket.remove');
Route::post('/basket/clear', 'App\Http\Controllers\BasketController@clear')->name('basket.clear');
Route::post('/basket/saveorder', 'App\Http\Controllers\BasketController@saveOrder')->name('basket.saveorder');
Route::get('/basket/success', 'App\Http\Controllers\BasketController@success')->name('basket.success');
Route::post('/basket/profile', 'App\Http\Controllers\BasketController@profile')->name('basket.profile');
/*
 * Pages: Delivery, Contacts and others
 */
Route::get('page/{page:slug}', 'App\Http\Controllers\PageController')->name('page.show');
/*
 * Authorisation
 */
Route::name('user.')->prefix('user')->group(function () {
    Auth::routes();
});
/*
 * Personal cabinet
 */
Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('index', 'App\Http\Controllers\UserController@index')->name('index');
    Route::resource('profile', 'App\Http\Controllers\ProfileController');
    Route::get('order', 'App\Http\Controllers\OrderController@index')->name('order.index');
    Route::get('order/{order}', 'App\Http\Controllers\OrderController@show')->name('order.show');
});
/*
 * Admin panel
 */
Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('index', 'IndexController')->name('index');
    Route::resource('category', 'CategoryController');
    Route::resource('brand', 'BrandController');
    Route::resource('product', 'ProductController');
    Route::get('product/category/{category}', 'ProductController@category')->name('product.category');
    Route::resource('order', 'OrderController', ['except' => ['create', 'store', 'destroy']]);
    Route::resource('user', 'UserController', ['except' => ['create', 'store', 'show', 'destroy']]);
    Route::resource('page', 'PageController');
    Route::post('page/upload/image', 'PageController@uploadImage')->name('page.upload.image');
    Route::delete('page/remove/image', 'PageController@removeImage')->name('page.remove.image');
});
