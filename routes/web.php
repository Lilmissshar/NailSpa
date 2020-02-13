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


//Admin Routes
Route::prefix('admin')->group(function(){

  //register
  Route::middleware('register.access')->group(function(){
    Route::get('register', "Admin\AuthController@viewRegister")->name('admin.register.show');
    Route::post('register', "Admin\AuthController@register")->name('admin.register');
  });
  //login
  Route::get('login','Admin\AuthController@viewLogin')->name('admin.login.show');
  Route::post('login','Admin\AuthController@login')->name('admin.login');

  Route::middleware('admin.auth')->group(function(){

    Route::get('/', 'Admin\DashboardController@dashboard');
    //dashboard
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');

		Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');

		//Settings
    Route::get('settings', "Admin\AccountSettingsController@viewAccount")->name("admin.account.show");
    Route::post('settings', "Admin\AccountSettingsController@updateAccount")->name("admin.account.update");
    Route::put('settings/password', "Admin\AccountSettingsController@updatePassword")->name("admin.password.change");

Route::name('admin.')->group(function(){

    //delete and view all Users ( client )
    Route::resource('clients','Admin\ClientsController', ['only' => ['index','destroy']]);
    //Branch index, create, delete, update, 
    Route::resource('branch', 'Admin\BranchController');

    //Users/Admin
    Route::resource('admins', 'Admin\AdminsController');

    //Users/Customer
    Route::resource('customers', 'Admin\CustomersController');

    //Appointments
    Route::resource('appointments', 'Admin\AppointmentsController');

    //Reviews
    Route::resource('reviews', 'Admin\ReviewsController');

    //Staffs
    Route::resource('staffs', 'Admin\StaffsController');

    //Services
    Route::resource('services', 'Admin\ServicesController');

    //Payment
    Route::resource('payments', 'Admin\PaymentsController');

    //PromoCode
    Route::resource('promocodes', 'Admin\PromoCodesController');
  });
});
});


Route::get('/', 'Client\HomeController@home')->name('root');
Route::get('/home', 'Client\HomeController@home')->name('home');

Route::resource('branch', 'Client\BranchController');
Route::resource('staffs', 'Client\StaffsController');
// Route::resource('services', 'Client\ServicesController');

Route::get('branch/{branch}/services', 'Client\ServicesController@index')->name('services.index');
Route::get('branch/{branch}/services/{service}/staffs', 'Client\StaffsController@index')->name('staffs.index');
Route::get('branch/{branch}/services/{service}/staffs/{staff}/appointments/', 'Client\AppointmentsController@index')->name('appointments.index');
Route::get('/datetimepicker', 'Client\DateTimeController@index')->name('datetime.index');
Route::get('branch/{branch}/services/{service}/staffs/{staff}/appointments/details', 'Client\DetailsController@index')->name('details.index'); //non member registration page
Route::post('branch/{branch}/services/{service}/staffs/{staff}/appointments/details', 'Client\DetailsController@submitForm')->name('details.store'); //store non member registration
Route::get('branch/{branch}/services/{service}/staffs/{staff}/appointments/details/member', 'Client\DetailsController@signIn')->name('details.signIn'); //member sign in page
Route::post('branch/{branch}/services/{service}/staffs/{staff}/appointments/details/member', 'Client\DetailsController@submitSignIn')->name('details.storeSignIn'); //sign in member
Route::get('branch/{branch}/services/{service}/staffs/{staff}/appointments/details/customerDetail', 'Client\DetailsController@showDetails')->name('details.showDetails'); //might delete soon, does nothing
Route::get('payments/{appointment}', 'Client\PaymentsController@index')->name('payments.index');
// Route::get('branch/{branch}/services/{service}/staffs/{staff}/appointments/details/member/{appointments}/payments/member', 'Client\PaymentsController@index')->name('')
Route::post('payments/{appointment}', 'Client\PaymentsController@store')->name('payments.store');

