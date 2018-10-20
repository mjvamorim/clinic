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


Route::get('admin', 'AdminController@index')->name('admin');
Route::get('home', 'AdminController@index')->name('home');
Route::get('', 'AdminController@index')->name('home');
Route::get('doctor/{doctor}', 'AdminController@doctor')->name('doctor')->middleware(['tenant']);
Route::get('doctorModel/{doctor}', 'AdminController@doctorViaModel')->name('doctorModel')->middleware(['tenant']);
Route::get('company/{company}', 'SelectTenantController@select')->name('selectcompany');
Route::resource('admin/company','CompanyController');

Route::get('admin/doctor', 'DoctorController@index')->name('admin.doctor');
Route::get('admin/doctor/getdata', 'DoctorController@getdata')->name('admin.doctor.getdata');
Route::post('admin/doctor/postdata', 'DoctorController@postdata')->name('admin.doctor.postdata');
Route::get('admin/doctor/fetchdata', 'DoctorController@fetchdata')->name('admin.doctor.fetchdata');
