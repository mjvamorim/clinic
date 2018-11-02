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


Auth::routes();
// URL::forceScheme('https');

Route::get('', 'AdminController@index')->name('home');
Route::get('admin', 'AdminController@index')->name('admin');
Route::get('payments', 'AdminController@payments')->name('payments');



// Checkout Transparente Mercado Pago
// Route::get('mp', 'MercadoPagoController@mp')->name('mp');
// Route::post('mppost', 'MercadoPagoController@mpPost')->name('mppost');

Route::middleware(['auth','checkpayment'])->group(function () {



    Route::get('admin/company', 'CompanyController@index')->name('admin.company');
    Route::get('admin/company/getdata', 'CompanyController@getData')->name('admin.company.getdata');
    Route::get('admin/company/fetchdata', 'CompanyController@fetchData')->name('admin.company.fetchdata');
    Route::post('admin/company/postdata', 'CompanyController@postData')->name('admin.company.postdata');



    Route::get('admin/doctor', 'DoctorController@index')->name('admin.doctor');
    Route::get('admin/doctor/getdata', 'DoctorController@getData')->name('admin.doctor.getdata');
    Route::get('admin/doctor/fetchdata', 'DoctorController@fetchData')->name('admin.doctor.fetchdata');
    Route::post('admin/doctor/postdata', 'DoctorController@postData')->name('admin.doctor.postdata');

    Route::get('admin/user', 'UserController@index')->name('admin.user');
    Route::get('admin/user/getdata', 'UserController@getData')->name('admin.user.getdata');
    Route::get('admin/user/fetchdata', 'UserController@fetchData')->name('admin.user.fetchdata');
    Route::post('admin/user/postdata', 'UserController@postData')->name('admin.user.postdata');
    Route::post('admin/user/storePhoto', 'UserController@storeUserPhoto')->name('admin.user.storephoto');



    Route::get('admin/exam', 'ExamController@index')->name('admin.exam');

    Route::get ('image', 'UploadImagesController@create');
    Route::post('image-save', 'UploadImagesController@store');
    Route::post('image-delete', 'UploadImagesController@destroy');
    Route::get ('image-show', 'UploadImagesController@index');
});
