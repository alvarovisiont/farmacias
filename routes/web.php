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
Route::get('/logout', 'Auth\\LoginController@logout')->name('logout');
Route::get('/lostPassword', 'MailController@index')->name('mail.index');
Route::post('/mailRecover', 'MailController@send_mailer')->name('mail.recover');
Route::get('/overwritePassword/{token}', 'MailController@overwrite_password_view');
Route::post('/mail/overwritePassword', 'MailController@overwrite_password');




Auth::routes();

Route::group(['middleware' => ['isAthenticated'] ], function(){

	Route::get('/home', 'HomeController@index_farmacia')->name('home');
	Route::get('/home/admin', 'HomeController@index_admin')->name('home.admin');

// ================== || Ajax Routes Reusability || ====================== //

	Route::get('municipios_ajax','AjaxController@traer_municipios')->name('municipios.ajax');
	Route::get('parroquias_ajax','AjaxController@traer_parroquias')->name('parroquias.ajax');
	Route::get('products/by/provee','AjaxController@products_by_provee')->name('products.by.provee');
	

// ================== || Users || ======================================== //

	Route::resource('users','UserController');
	Route::post('user/change/password','UserController@change_password_default')->name('user.change.password');
	

// ================== || Providers || ==================================== //

	Route::resource('providers','ProvidersController');

// ================== || Configs || ==================================== //

	Route::resource('config','ConfigController');
	Route::resource('config_currency','CurrencyController');

// ================== || StockTaking || ==================================== //

	Route::resource('stocktaking','StockTakingController');
	Route::get('stocktaking/pdf/{id}','StockTakingController@pdf_stocktaking')->name('stocktaking.pdf');
	Route::get('stocktaking/excel/{id}','StockTakingController@excel_stocktaking')->name('stocktaking.excel');
	Route::get('search_products/all','StockTakingController@allproducts')->name('search.products.all');
	Route::get('stocktaking/import/view','StockTakingController@stocktaking_view');
	Route::get('/download/stocktaking/excel/example','StockTakingController@download_excel_stock_example')->name('download.stocktaking.example.excel');
	
	Route::post('/stocktaking/import/stored_products','StockTakingController@stocktaking_import');
	
	

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

	Route::get('/sales/import_sale','SalesController@import_sale')->name('sales.import_sale');
	Route::get('/sales/download/example/import_sale','SalesController@export_excel_example')->name('sales.download.example.import_sale');
	
	Route::post('/sales/import/sales','SalesController@sales_import_excel')->name('sales.import.excel');

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

	
// ================== || Administrador || ==================================== //

	Route::group(['middleware' => ['profileUsers'] ], function(){

		Route::get('/admin/stocktaking','AdminController@stocktaking')->name('admin.stocktaking');
		Route::get('/admin/stocktaking/pharmacy','AdminController@stocktaking_pharmacy')->name('admin.stocktaking.pharmacy');
		Route::get('/admin/stocktaking/pharmacy/view/{id}','AdminController@stocktaking_pharmacy_view')->name('admin.stocktaking.pharmacy.view');

		Route::get('/admin/medicines','AdminController@medicines')->name('admin.medicines');
		Route::get('/admin/medicines/filter','AdminController@medicines_filter')->name('admin.medicines.filter');

		Route::get('/admin/sales','AdminController@sales')->name('admin.sales');
		Route::get('/admin/sales/pharmacy/view/{id}','AdminController@sales_pharmacy_view')->name('admin.sale.pharmacy.view');

		Route::get('/admin/buy','AdminController@buy')->name('admin.buy');
		Route::get('/admin/buy/pharmacy/view/{id}','AdminController@buy_pharmacy_view')->name('admin.buy.pharmacy.view');

		Route::get('/admin/find_pharmacy','AdminController@find_pharmacy')->name('admin.find_pharmacys');
		Route::get('/admin/buys/view_clients','AdminController@view_buys_clients')->name('admin.buys.view.clients');

		Route::get('/admin/configs','AdminController@configs')->name('admin.configs');
	});
		

});

	
	
	
	
	