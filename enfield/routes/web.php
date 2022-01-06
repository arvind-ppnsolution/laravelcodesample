<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Unuthenticated Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admindeauth'], function () {
    //Admin login form
    Route::get('/login', 'Admin\RegistrationController@loginForm')->name('admin.login');
    Route::post('/login', ['as' => 'admin.login.post', 'uses' => 'Admin\RegistrationController@login']);

    // Password reset routes
    Route::get('/password/email', 'Admin\ForgetPasswordController@showLinkRequestForm')->name('admin.password.email.show');
});

//Authenticated Admin
Route::group(['prefix' => 'admin', 'middleware' => 'adminauth'], function () {

    //dashboard
    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard.root');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    
    //profile
    Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');
    Route::post('/profile-update', 'Admin\ProfileController@update')->name('admin.profile.update');
    Route::post('/profile-upload', 'Admin\ProfileController@uploadSingleImage')->name('admin.profile.upload');

    //logout
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Admin\RegistrationController@logout']);

    //change password
    Route::get('/change-password', 'Admin\PasswordController@changePassword')->name('admin.password.change');
    Route::post('/change-password', 'Admin\PasswordController@changePasswordSubmit')->name('admin.password.change.submit');

    //mechanic
    Route::resource('mechanic', 'Admin\MechanicController');
    Route::post('/mechanic/status', 'Admin\MechanicController@status')->name('mechanic.status');
    Route::get('mechanic-list', 'Admin\MechanicController@listMechanic')->name('mechanic.list');
    Route::delete('/delete-mechanic', 'Admin\MechanicController@delete')->name('mechanic.delete');
    Route::post('/mechanic-export', 'Admin\ExportController@exportMechanic')->name('mechanic.export');
    Route::post('/mechanic-import', 'Admin\ImportController@importMechanic')->name('mechanic.import');
    Route::post('/mechanic-upload', 'Admin\MechanicController@uploadSingleImage')->name('admin.mechanic.upload');

});

