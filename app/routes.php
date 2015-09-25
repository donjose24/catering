<?php

Route::get('t' , function(){
	dd(Session::all());
});
Route::get('f' , function(){
	Session::flush();
});

Route::get('/', ['uses' =>'catering\ReservationsController@home' , 'as' => 'home.index']);
Route::get('/home', 'catering\ReservationsController@home');
Route::get('/equip','catering\ReservationsController@equipments');
Route::get('/contact',['uses' => 'catering\ReservationsController@contact' , 'as' => 'home.contact']);
Route::get('/thanks', 'catering\ReservationsController@thanks');
Route::post('/contact',['uses'=> 'catering\ReservationsController@contactStore' , 'as' => 'home.contact.save']);

Route::get('/misc/list-information/' , ['uses' => 'AdminController@information' , 'as' => 'misc.list']);
Route::get('/misc/set-information/{id}/{value}' , ['uses' => 'AdminController@editInformation' , 'as' => 'misc.edit']);

Route::get('/misc/content/' , ['uses' => 'AdminController@contents' , 'as' => 'misc.content.list']);
Route::get('/misc/content/create/' , ['uses' => 'AdminController@createContent' , 'as' => 'misc.content.create']);
Route::get('/misc/content/edit/{id}' , ['uses' => 'AdminController@editContent' , 'as' => 'misc.content.edit']);
Route::post('/misc/content/save' , ['uses' => 'AdminController@storeContent' , 'as' => 'misc.content.save']);


Route::get('/login' , ['uses' => 'AuthController@getLogin' , 'as' => 'default.login']);

Route::get('/sign-in', 'AuthController@getSignIn');
Route::post('/sign-in', 'AuthController@postSignIn');
Route::get('/sign-out', 'AuthController@getSignOut');
Route::post('/signin', 'AuthController@signIn');
// USER CRUDS
Route::model('user', 'User');
Route::get('/settings/users', 'Settings\UsersController@index');
Route::get('/settings/users/create', 'Settings\UsersController@create');
Route::post('/settings/users', 'Settings\UsersController@store');
Route::get('/settings/users/{user}', 'Settings\UsersController@show');
Route::get('/settings/users/{user}/edit', 'Settings\UsersController@edit');
Route::put('/settings/users/{user}', 'Settings\UsersController@update');
Route::delete('/settings/users/{user}', 'Settings\UsersController@destroy');

// CLIENT CRUDS
Route::model('client', 'Client');
Route::get('/settings/clients', 'Settings\ClientsController@index');
Route::get('/settings/clients/create', 'Settings\ClientsController@create');
Route::post('/settings/clients/storeModal', 'Settings\ClientsController@storeModal');
Route::post('/settings/clients', 'Settings\ClientsController@store');
Route::get('/settings/clients/{client}', 'Settings\ClientsController@show');
Route::get('/settings/clients/{client}/edit', 'Settings\ClientsController@edit');
Route::put('/settings/clients/{client}', 'Settings\ClientsController@update');
Route::delete('/settings/clients/{client}', 'Settings\ClientsController@destroy');
Route::post('/settings/clients/getOne', 'Settings\ClientsController@getOne');

// AGENT CRUDS
Route::model('agent', 'Agent');
Route::get('/settings/agents', 'Settings\AgentsController@index');
Route::get('/settings/agents/create', 'Settings\AgentsController@create');
Route::post('/settings/agents', 'Settings\AgentsController@store');
Route::get('/settings/agents/{agent}', 'Settings\AgentsController@show');
Route::get('/settings/agents/{agent}/edit', 'Settings\AgentsController@edit');
Route::put('/settings/agents/{agent}', 'Settings\AgentsController@update');
Route::delete('/settings/agents/{agent}', 'Settings\AgentsController@destroy');
Route::post('/settings/agents/getOne', 'Settings\AgentsController@getOne');


// QUOTATION CRUDS
Route::model('quotation', 'Quotation');

// LISTS ALL QUOTATIONS IN THE DRAFT AND APPROVED STATUSES
Route::get('/sales/quotations', 'Sales\QuotationsController@index');
Route::get('/sales/quotations/create', 'Sales\QuotationsController@create');
Route::post('/sales/quotations', 'Sales\QuotationsController@store');
Route::get('/sales/quotations/{quotation}', 'Sales\QuotationsController@show');
Route::get('/sales/quotations/{quotation}/edit', 'Sales\QuotationsController@edit');
Route::put('/sales/quotations/{quotation}', 'Sales\QuotationsController@update');
Route::put('/sales/quotations/createSO/{quotation}', 'Sales\QuotationsController@createSO');
Route::delete('/sales/quotations/{quotation}', 'Sales\QuotationsController@destroy');

// LISTS ALL QUOTATIONS IN THE SALES ORDER STATUS WITH CORRESPONDING 'SO_NUMBER'
Route::get('/sales/salesorders', 'Sales\QuotationsController@salesorders');

// LISTS ALL SALES ORDERS THAT HAVE NOT YET BEEN FULLY PAID WITH THEIR CORRESPONDING BALANCES
Route::get('/sales/receivables', 'Sales\QuotationsController@receivables');
Route::get('/sales/fulfilled', 'Sales\QuotationsController@fulfilled');
Route::post('/sales/quotations/attachItem', 'Sales\QuotationsController@attachItem');
Route::post('/sales/quotations/detachItem', 'Sales\QuotationsController@detachItem');
Route::get('/sales/pendingQuotations', 'Sales\QuotationsController@pendingQuotations');
Route::get('/sales/approvedQuotations', 'Sales\QuotationsController@approvedQuotations');
Route::get('/sales/quotations/salesordershow/{quotation}', 'Sales\QuotationsController@salesordershow');

// DELIVERY CRUDS
Route::model('delivery', 'Delivery');
Route::get('/sales/deliveries', 'Sales\DeliveriesController@index');
Route::get('/sales/deliveries/create/{quotation}', 'Sales\DeliveriesController@create');
Route::post('/sales/deliveries', 'Sales\DeliveriesController@store');
Route::get('/sales/deliveries/{delivery}', 'Sales\DeliveriesController@show');
Route::get('/sales/deliveries/{delivery}/edit', 'Sales\DeliveriesController@edit');
Route::put('/sales/deliveries/{delivery}', 'Sales\DeliveriesController@update');
Route::delete('/sales/deliveries/{delivery}', 'Sales\DeliveriesController@destroy');

// COLLECTION CRUDS
Route::model('collection', 'Collection');
Route::get('/sales/collections', 'Sales\CollectionsController@index');
Route::get('/sales/collections/create/{quotation}', 'Sales\CollectionsController@create');
Route::post('/sales/collections', 'Sales\CollectionsController@store');
Route::get('/sales/collections/{collection}', 'Sales\CollectionsController@show');
Route::get('/sales/collections/{collection}/edit', 'Sales\CollectionsController@edit');
Route::put('/sales/collections/{collection}', 'Sales\CollectionsController@update');
Route::delete('/sales/collections/{collection}', 'Sales\CollectionsController@destroy');

// ITEM CRUDS
Route::model('item', 'Item');
Route::get('/items/items', 'Items\ItemsController@index');
Route::get('/items/items/create', 'Items\ItemsController@create');
Route::post('/items/items', 'Items\ItemsController@store');
Route::get('/items/items/{item}', 'Items\ItemsController@show');
Route::get('/items/items/{item}/edit', 'Items\ItemsController@edit');
Route::put('/items/items/{item}', 'Items\ItemsController@update');
Route::delete('/items/items/{item}', 'Items\ItemsController@destroy');
Route::post('/items/items/getOne', 'Items\ItemsController@getOne');


// ITEM TYPE CRUDS
Route::model('itemtype', 'ItemType');
Route::get('/items/itemtypes', 'Items\ItemTypesController@index');
Route::get('/items/itemtypes/create', 'Items\ItemTypesController@create');
Route::post('/items/itemtypes', 'Items\ItemTypesController@store');
Route::get('/items/itemtypes/{itemtype}', 'Items\ItemTypesController@show');
Route::get('/items/itemtypes/{itemtype}/edit', 'Items\ItemTypesController@edit');
Route::put('/items/itemtypes/{itemtype}', 'Items\ItemTypesController@update');
Route::delete('/items/itemtypes/{itemtype}', 'Items\ItemTypesController@destroy');


// PURCHASE CRUDS
Route::model('purchase', 'Purchase');
Route::get('/purchases/purchaseorders', 'Purchases\PurchasesController@index');
Route::get('/purchases/purchaseorders/create', 'Purchases\PurchasesController@create');
Route::post('/purchases/purchaseorders','Purchases\PurchasesController@store');
Route::get('/purchases/purchaseorders/{purchase}', 'Purchases\PurchasesController@show');
Route::post('/settings/suppliers/getOne', 'Settings\SuppliersController@getOne');
Route::post('/purchases/purchaseorders/attachItem', 'Purchases\PurchasesController@attachItem');
Route::put('/purchases/purchaseorders/{purchase}', 'Purchases\PurchasesController@update');
Route::put('/purchases/purchaseorders/createSI/{purchase}', 'Purchases\PurchasesController@createSI');
Route::delete('/purchases/purchaseorders/{purchase}', 'Purchases\PurchasesController@destroy');
Route::get('/purchases/purchaseorders/{purchase}/edit', 'Purchases\PurchasesController@edit');
Route::post('/purchases/purchaseorders/detachItem', 'Purchases\PurchasesController@detachItem');

Route::get('/purchases/pendingPurchases', 'Purchases\PurchasesController@pendingPurchases');
Route::get('/purchases/approvedPurchases', 'Purchases\PurchasesController@approvedPurchases');
Route::get('/purchases/orderPurchases', 'Purchases\PurchasesController@purchaseOrders');
Route::get('/purchases/orderPurchases/{purchase}', 'Purchases\PurchasesController@purchaseOrderShow');
//--------------------------------------------------------------------------------
Route::get('/purchases/payables', 'Purchases\PurchasesController@payables');



Route::get('api/search', 'Api\SearchController@index');
Route::get('/printSO', 'FormController@printSalesOrder');
Route::get('/printQuotation', 'FormController@printQuotation');
Route::get('/printDR', 'FormController@printDeliveryReceipt');

//RECEIVING CRUDS
Route::model('receiving', 'Receiving');
Route::get('/purchases/receiving', 'Purchases\ReceivingsController@index');
Route::get('/purchases/receiving/{receiving}', 'Purchases\ReceivingsController@show');
Route::get('/purchases/receivings/create/{purchase}', 'Purchases\ReceivingsController@create');
Route::post('/purchases/receivings/', 'Purchases\ReceivingsController@store');
Route::get('/purchases/receivings/delete/{receiving}', 'Purchases\ReceivingsController@destroy');

//PAYMENT CRUDS
Route::model('payment', 'Payment');
Route::get('/purchases/payments', 'Purchases\PaymentsController@index');
Route::get('/purchases/payments/create/{purchase}', 'Purchases\PaymentsController@create');
Route::post('/purchases/payments/', 'Purchases\PaymentsController@store');


//SUPPLIER CRUDS
Route::model('supplier', 'Supplier');
Route::get('/settings/suppliers', 'Settings\SuppliersController@index');
Route::get('/settings/suppliers/create', 'Settings\SuppliersController@create');
Route::post('/settings/suppliers', 'Settings\SuppliersController@store');
Route::post('/settings/suppliers/modal', 'Settings\SuppliersController@storeModal');
Route::get('/settings/suppliers/{supplier}', 'Settings\SuppliersController@show');
Route::delete('/settings/suppliers/{supplier}', 'Settings\SuppliersController@destroy');
Route::get('/settings/suppliers/{supplier}/edit', 'Settings\SuppliersController@edit');
Route::put('/settings/suppliers/{supplier}', 'Settings\SuppliersController@update');

//Reservation Stuffs

Route::get('reservation/checkGet/reservation/{id}','catering\ReservationsController@checkReservationGet');
Route::get('/reservation/selection/' , ['uses' => 'catering\ReservationsController@showSelection' , 'as' => 'home.reservation.selection']);

Route::resource('reservation','catering\ReservationsController');
/*ADDED STUFFS >after()*/
Route::post('reservation/addReservation','catering\ReservationsController@attachMenu')->after('invalidate-browser-cache');
Route::post('reservation/addPayment','catering\ReservationsController@attachPayment');

Route::get('/pdf/{reservation}', 'catering\ReservationsController@attachPdf');
Route::get('/pdf/{reservation}/full', 'catering\ReservationsController@fullPdf');
Route::get('reservation/checkout','catering\ReservationsController@checkout');
Route::post('reservation/check/reservation','catering\ReservationsController@checkReservation');
Route::post('reservation/message/{id}','catering\ReservationsController@attachMessage');
Route::post('reservation/message/{id}/cancellation','catering\ReservationsController@attachMessageCancellation');
Route::delete('reservation/picture/delete/{id}','catering\ReservationsController@deletePicture');

//Admin Stuffs
Route::get('admin/reservations', 'AdminController@index');
Route::get('admin/reservations/si/generate/{id}', 'AdminController@SI_generate');
Route::get('admin/reservations/{reservation}', 'AdminController@showReservation');
Route::post('/admin/updateStatus', 'AdminController@updateStatus');
Route::post('/admin/deleteReservation/{reservation}', 'AdminController@deleteReservation');
Route::post('/admin/pay/amount','AdminController@payAmount');

Route::get('admin/menu', 'AdminController@menu');
Route::get('admin/menu/getPicture', 'AdminController@getPicture');
Route::delete('admin/menu/deletePicture/{file}', 'AdminController@deletePicture');
Route::put('admin/menu/updatePicture/{id}', 'AdminController@updatePicture');
Route::get('admin/delete/deleteMenu/{id}', 'AdminController@deleteMenu');
Route::post('admin/addMenu', 'AdminController@addMenu');
Route::post('admin/editMenu/{id}', 'AdminController@editMenu');
Route::get('admin/menuCategory', 'AdminController@menuCategory');
Route::post('admin/addCategory', 'AdminController@addCategory');
Route::get('admin/deleteCategory/{id}', 'AdminController@deleteCategory');
Route::get('admin/update/reservaton/{id}', 'AdminController@updateReservation');
Route::get('admin/packages', 'AdminController@packages');
Route::post('admin/packages/add', 'AdminController@addPackage');

Route::get('admin/cancel/reservaton/{id}', 'AdminController@cancelReservation');

Route::get('admin/messages', 'AdminController@messages');
Route::get('admin/cancellations', 'AdminController@cancellations');
Route::post('admin/status/update/change', 'catering\ReservationsController@changeStatus');

Route::get('menu/getOne/{menu}', 'catering\ReservationsController@getMenu');
Route::get('package/getOne/{package}', 'catering\ReservationsController@getPackage');
Route::get('equip/getOne/{package}', 'catering\ReservationsController@getEquip');
Route::get('menu/getDetails/{menu}', 'AdminController@getDetails');

Route::get('admin/packages/{package}', 'AdminController@showPackage');
Route::get('admin/maintenance', 'AdminController@maintenance');
Route::get('admin/maintenance/update/{id}', 'AdminController@updateMaintenance');
Route::post('admin/maintenance/update/', 'AdminController@editMaintenance');
Route::post('admin/resevation/update/menu/reservation', 'AdminController@updateMenuReservation');

Route::get('admin/reservation/update/{id}/additional', 'AdminController@additionalReservation');
Route::post('admin/reservation/update/additional/attachItem', 'AdminController@attachAdditionalMenu');
Route::post('admin/reservation/update/additional/attachItem/item', 'AdminController@attachAdditionalItem');
Route::post('menu/getPrice', 'AdminController@getPrice');
Route::post('item/getPrice', 'AdminController@ItemGetPrice');
Route::post('admin/return/item/detach', 'AdminController@detachReturnItem');
#Route::post('admin/return/item/detach', 'AdminController@detachBrokenItem');

Route::get('admin/return/item/yeah/{id}','AdminController@returnReservation');
Route::get('admin/return/item/broken/{id}','AdminController@brokenReservation');
Route::post('admin/reservation/update/additional/detachItem', 'AdminController@detachAdditionalMenu');
Route::post('admin/reservation/update/additional/returnItem/item', 'AdminController@returnAdditionalItem');
Route::post('admin/reservation/update/additional/brokenItem/item', 'AdminController@brokenAdditionalItem');
Route::get('/menu/home', 'catering\ReservationsController@homeMenu');

/*
Route::get('/contact', 'catering\ReservationsController@contact');
Route::get('/thanks', 'catering\ReservationsController@thanks');
Route::post('/contact', 'catering\ReservationsController@contactStore');
*/


Route::get('admin/contact', 'AdminController@contact');
Route::get('admin/contact/delete/message/{id}', 'AdminController@deleteMessage');
Route::get('admin/termsncon', 'AdminController@termsncon');
Route::get('admin/deleteTerm/{id}', 'AdminController@deleteTerm');
Route::get('admin/updateTerm/{id}', 'AdminController@updateTerm');
Route::post('admin/editTerm','AdminController@editTerm');
Route::get('admin/addTerm', 'AdminController@addTerm');
Route::post('admin/addTerm2', 'AdminController@addTerm2');

Route::get('admin/addReservation', 'AdminController@addReservation');
Route::post('admin/storeRes','AdminController@storeRes');
Route::post('admin/attachMenu/low','AdminController@attachMenu');
Route::post('admin/addPayment','AdminController@attachPayment');

Route::get('admin/carousel', 'AdminController@carousel');
Route::delete('admin/carousel/deletePicture/{file}', 'AdminController@deleteCarousel');
Route::put('admin/carousel/updatePicture/{id}', 'AdminController@updateCarousel');
Route::post('admin/carousel/add/addulet','AdminController@addCarousel');
Route::get('admin/carousel/delete/{id}', 'AdminController@deleteCarouselTotal');
Route::get('admin/sales/report','AdminController@salesReports');
Route::post('admin/sales/report/post','AdminController@generateReport');
Route::get('admin/inventory/report','AdminController@inventoryReports');
Route::post('admin/inventory/report/post','AdminController@generateInventoryReport');
