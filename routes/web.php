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

Route::get('/', 'Auth\\LoginController@showLoginForm');
Route::get('/home', 'HomeController@index_farmacia')->name('home');
Route::get('/home/admin', 'HomeController@index_admin')->name('home.admin');
Route::get('/logout', 'Auth\\LoginController@logout')->name('logout');

Auth::routes();


// ================== || Ajax Routes Reusability || ====================== //

	Route::get('municipios_ajax','AjaxController@traer_municipios')->name('municipios.ajax');
	Route::get('parroquias_ajax','AjaxController@traer_parroquias')->name('parroquias.ajax');
	Route::get('products/by/provee','AjaxController@products_by_provee')->name('products.by.provee');
	

// ================== || Users || ======================================== //

	Route::resource('users','UserController');

// ================== || Providers || ==================================== //

	Route::resource('providers','ProvidersController');

// ================== || Configs || ==================================== //

	Route::resource('config','ConfigController');
	Route::resource('config_currency','CurrencyController');

// ================== || StockTaking || ==================================== //

	Route::resource('stocktaking','StockTakingController');
	Route::get('stocktaking_pdf','StockTakingController@pdf_stocktaking')->name('stocktaking.pdf');
	Route::get('stocktaking_excel','StockTakingController@excel_stocktaking')->name('stocktaking.excel');
	Route::get('search_products/all','StockTakingController@allproducts')->name('search.products.all');

// ================== || Trademark || ==================================== //

	Route::resource('trademark','TradeMarkController');

// ================== || Group || ==================================== //

	Route::resource('group','GroupController');

// ================== || Sales || ==================================== //

	Route::get('sale','SalesController@index')->name('sale.index');
	Route::get('sale/{id}/details','SalesController@show')->name('sale.show.details');
	Route::get('sale/sell','SalesController@sell')->name('sale.sell');
	Route::get('sale/products-temp','SalesController@search_products_temp')->name('sales.products.temp');
	Route::get('sale/invoice/{id}','SalesController@invoice_pdf');
	Route::post('sale/products-temp/remove','SalesController@remove_products_temp')->name('sales.products.remove.temp');
	Route::post('sale/store','SalesController@store')->name('sale.store');
	Route::get('sale/client','ClientController@search_clients')->name('search.clients');

// ================== || Clients || ==================================== //	
	
	Route::get('client/search','ClientController@search_clients')->name('search.clients');
	Route::get('client/search/all','ClientController@search_clients_all')->name('search.clients.all');

// ================== || Buys || ==================================== //

	Route::get('/buy','BuyController@index')->name('buy.index');
	Route::get('/buy/{id}/details','BuyController@show')->name('buy.details');
	Route::get('/buy/make','BuyController@make_buy')->name('buy.make');
	Route::post('/buy/stored','BuyController@stored')->name('buy.stored');
	Route::get('/buy/stored/temp','BuyController@stored_temp')->name('buy.save.temp');
	Route::post('/buy/stored/remove/temp','BuyController@stored_temp_remove')->name('buys.products.remove.temp');
	Route::delete('/buy/{id}','BuyController@destroy')->name('buy.destroy');