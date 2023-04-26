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

Auth::routes(
        [
            'reset'=> false,
            'confirm'=> false,
        ]);
  Route::get('logout','App\Http\Controllers\Auth\LoginController@logout')->name('get.logout');

  Route::get('currency/{currency}','App\Http\Controllers\MainController@changeCurrency')->name('currency');

Route::middleware('set_locale')->group(function(){
 
    
Route::get('/','App\Http\Controllers\MainController@index')->name('index');
Route::get('categories','App\Http\Controllers\MainController@categories')->name('categories');
Route::get('product/{product?}','App\Http\Controllers\MainController@product')->name('product');
Route::get('category/{category}','App\Http\Controllers\MainController@category')->name('category');

 Route::get('locale/{locale}','App\Http\Controllers\MainController@changeLocale')->name('locale');

Route::middleware('basket_is_empty')->group(function(){
    Route::get('/basket','App\Http\Controllers\BasketController@basket')->name('basket');
Route::get('/basket/place','App\Http\Controllers\BasketController@basketPlace')->name('basket.place');
Route::post('/basket/remove/{product}','App\Http\Controllers\BasketController@basketRemove')->name('basket.remove');
Route::post('basket/confirm','App\Http\Controllers\BasketController@basketConfirm')->name('basket.confirm');
Route::get('basket/clear','App\Http\Controllers\BasketController@basketClear')->name('basket.clear');
});

Route::post('/basket/add/{product}','App\Http\Controllers\BasketController@basketAdd')->name('basket.add');



Route::middleware('auth')->group(function(){
    Route::middleware('is_admin')->group(function(){
        Route::get('/orders', 'App\Http\Controllers\Admin\OrderController@index')->name('home');
        Route::get('/orders/show/{order}','App\Http\Controllers\Admin\OrderController@show')->name('admin.orders.show');
        Route::resource('/admin/categories','App\Http\Controllers\Admin\CategoryController');
        Route::resource('/admin/products','App\Http\Controllers\Admin\ProductController');
         Route::resource('/admin/property','App\Http\Controllers\Admin\PropertyController');
     Route::resource('/admin/property/{property}/property-options','App\Http\Controllers\Admin\PropertyOptionsController');
      Route::resource('/product/{product}/skus','App\Http\Controllers\Admin\SkuController');
    });
   
        Route::get('/person/orders','App\Http\Controllers\Person\OrderController@index')->name('person.orders.index');
        
        Route::get('/person/orders/{order}','App\Http\Controllers\Person\OrderController@show')->name('person.orders.show');
   });

 })  ;


