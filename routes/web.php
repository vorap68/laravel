<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/','App\Http\Controllers\MainController@index')->name('index');
Route::get('categories','App\Http\Controllers\MainController@categories')->name('categories');
Route::get('product/{product?}','App\Http\Controllers\MainController@product')->name('product');
Route::get('category/{category}','App\Http\Controllers\MainController@category')->name('category');

Route::middleware('basket_is_empty')->group(function(){
    Route::get('/basket','App\Http\Controllers\BasketController@basket')->name('basket');
Route::get('/basket/place','App\Http\Controllers\BasketController@basketPlace')->name('basket.place');
Route::post('/basket/remove/{id}','App\Http\Controllers\BasketController@basketRemove')->name('basket.remove');
Route::post('basket/confirm','App\Http\Controllers\BasketController@basketConfirm')->name('basket.confirm');
});

Route::post('/basket/add/{id}','App\Http\Controllers\BasketController@basketAdd')->name('basket.add');

Auth::routes(
        [
            'reset'=> false,
            'confirm'=> false,
        ]);

Route::middleware('auth')->group(function(){
    Route::middleware('is_admin')->group(function(){
        Route::get('/orders', 'App\Http\Controllers\Admin\OrderController@index')->name('home');
        Route::get('/orders/show/{order}','App\Http\Controllers\Admin\OrderController@show')->name('admin.orders.show');
        Route::resource('/admin/categories','App\Http\Controllers\Admin\CategoryController');
        Route::resource('/admin/products','App\Http\Controllers\Admin\ProductController');
    });
   
        Route::get('/person/orders','App\Http\Controllers\Person\OrderController@index')->name('person.orders.index');
        
        Route::get('/person/orders/{order}','App\Http\Controllers\Person\OrderController@show')->name('person.orders.show');
   });

   Route::get('logout','App\Http\Controllers\Auth\LoginController@logout')->name('get.logout');


