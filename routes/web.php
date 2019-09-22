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
    return view('home');
});


   
//login
    Auth::routes();    
    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
    Route::get('/login/user', 'Auth\LoginController@showUserLoginForm');
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
    Route::get('/register/user', 'Auth\RegisterController@showUserRegisterForm');

    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/login/user', 'Auth\LoginController@userLogin');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
    Route::post('/register/user', 'Auth\RegisterController@createUser');

    
    // Route::view('/admin', 'admin.home');
    Route::view('/user', 'home');
   

    Route::group(['middleware' => ['auth:admin'] ], function(){
        //admin
    Route::get('/admin', 'HomeController@homeAdmin')->name('homeadmin');
    Route::resource('/kategori', 'CategoryController')->except([
        'create', 'show'
    ]);
    Route::resource('/produk', 'ProductController');
    Route::get('/transaksi', 'OrderController@addOrder');
    Route::resource('/transaksi', 'TransaksiController');
    Route::resource('admuser', 'AdmuserController');
    });


    

//user

  

    Route::resource('shop', 'ListController', ['only' => ['index', 'show']]);
    Route::resource('cart', 'CartController');
    Route::delete('emptyCart', 'CartController@emptyCart');

    
    
    

Route::post('cekshipping', 'ShippingController@prosesShipping')->name('proses');


Route::get('join_table', 'CustomerController@index');

Route::group(['middleware' => ['auth:user'] ], function(){

    Route::get('/checkout', 'CartController@confirmcheckout')->name('order.checkout');
    Route::post('/buy', 'CartController@storeCheckout')->name('buyorder');
    Route::get('/payment', 'ShippingController@payment')->name('payment');
    Route::post('/addpay','ShippingController@storePayment')->name('addpayment');
    Route::get('/confirmpayment/{id}', 'ShippingController@formPayment')->name('confirmpayment');
    Route::get('/confpay', 'ShippingController@confpay')->name('confpay');
    Route::post('/updatepay/{id}', 'ShippingController@updatePayment')->name('updatepayment');
    Route::get('/order/pdf/{invoice}', 'OrderController@invoicePdf')->name('order.pdf');
//profil
    Route::get('user/profil', 'UserController@index');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::post('user/update/{id}', 'UserController@update');
    Route::get('/user/order', 'UserController@order');
    Route::get('/user/orderdet/{id}', 'UserController@orderDetail')->name('user.orders');

});