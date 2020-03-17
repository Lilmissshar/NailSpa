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
  Route::middleware('guest:admin')->group(function(){

    //register
    Route::middleware('register.access')->group(function(){
      Route::get('register', "Admin\AuthController@viewRegister")->name('admin.register.show');
      Route::post('register', "Admin\AuthController@register")->name('admin.register');
    });

    //login
    Route::get('login','Admin\AuthController@viewLogin')->name('admin.login.show');
    Route::post('login','Admin\AuthController@login')->name('admin.login');
  });

  Route::middleware('auth:admin')->group(function(){

    Route::get('/', 'Admin\DashboardController@dashboard');
    //dashboard
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');

		Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');

		//Settings
    Route::get('settings', "Admin\AccountSettingsController@viewAccount")->name("admin.account.show");
    Route::post('settings', "Admin\AccountSettingsController@updateAccount")->name("admin.account.update");
    Route::put('settings/password', "Admin\AccountSettingsController@updatePassword")->name("admin.password.change");

    Route::name('admin.')->group(function(){
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
      //Leaves
      Route::resource('leaves', 'Admin\LeavesController', ['parameters' => [
        'leaves' => 'leave'
      ]]);
    });
  });
});


Route::get('/', 'Client\HomeController@home')->name('root');
Route::get('/home', 'Client\HomeController@home')->name('home');

Route::resource('services', 'Client\ServicesController');

Route::get('services/{service}/staffs', 'Client\StaffsController@index')->name('staffs.index');
Route::get('services/{service}/staffs/{staff}/appointments', 'Client\AppointmentsController@index')->name('appointments.index');

//register(client)
Route::get('register', "Client\AuthController@viewRegister")->name('client.register.show');
Route::post('register', "Client\AuthController@register")->name('client.register');

//login(client)
Route::get('login','Client\AuthController@viewLogin')->name('client.login.show');
Route::post('login','Client\AuthController@login')->name('client.login');

Route::middleware('auth')->group(function(){
  Route::get('services/{service}/staffs/{staff}/appointments/details', 'Client\AppointmentsController@show')->name('appointments.show');
  Route::post('services/{service}/staffs/{staff}/appointments', 'Client\AppointmentsController@submitForm')->name('appointments.store'); 
  Route::get('logout', 'Client\AuthController@logout')->name('client.logout');
  Route::get('reviews/{appointment}', 'Client\ReviewsController@index')->name('reviews.index');
  Route::post('reviews/{appointment}/store', 'Client\ReviewsController@store')->name('reviews.store');
  Route::get('appointments', 'Client\AppointmentsController@showAppointments')->name('appointments.showAppointments');
  Route::get('appointments/{appointment}/review', 'Client\AppointmentsController@edit')->name('appointments.edit');
  Route::post('appointments/{appointment}/update', 'Client\AppointmentsController@update')->name('appointments.update');
});

//Staff Routes
Route::prefix('staff')->group(function(){
  Route::middleware('guest:staff')->group(function(){

    Route::middleware('staff.register.access')->group(function(){
      //Staff register
      Route::get('register', 'Staff\AuthController@viewRegister')->name('staff.register.show');
      Route::post('register', 'Staff\AuthController@register')->name('staff.register');
    });
    //Staff login
    Route::get('login', 'Staff\AuthController@viewLogin')->name('staff.login.show');
    Route::post('login', 'Staff\AuthController@login')->name('staff.login');
  });

  Route::middleware('auth:staff')->group(function(){
    Route::get('/', 'Staff\DashboardController@dashboard');
    Route::get('dashboard', 'Staff\DashboardController@dashboard')->name('staff.dashboard');
    Route::get('logout', 'Staff\AuthController@logout')->name('staff.logout');
    Route::get('settings', 'Staff\AccountSettingsController@viewAccount')->name('staff.account.show');
    Route::post('settings', 'Staff\AccountSettingsController@updateAccount')->name('staff.account.update');
    Route::put('setting/passord', 'Staff\AccountSettingsController@updatePassword')->name('staff.password.change');

    Route::name('staff.')->group(function(){
      Route::resource('appointments', 'Staff\AppointmentsController');
      Route::resource('leaves', 'Staff\LeavesController', ['parameters' => [
        'leaves' => 'leave']]);
    });
  });
});



