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


Route::get('', 'AdminController@index')->name('home');
Route::get('admin', 'AdminController@index')->name('admin');

Route::get('admin/company', 'CompanyController@index')->name('admin.company');
Route::get('admin/company/getdata', 'CompanyController@getData')->name('admin.company.getdata');
Route::get('admin/company/fetchdata', 'CompanyController@fetchData')->name('admin.company.fetchdata');
Route::post('admin/company/postdata', 'CompanyController@postData')->name('admin.company.postdata');
Route::get('admin/company/{company}', 'TenantController@select')->name('selectcompany');


Route::get('admin/doctor', 'DoctorController@index')->name('admin.doctor');
Route::get('admin/doctor/getdata', 'DoctorController@getData')->name('admin.doctor.getdata');
Route::get('admin/doctor/fetchdata', 'DoctorController@fetchData')->name('admin.doctor.fetchdata');
Route::post('admin/doctor/postdata', 'DoctorController@postData')->name('admin.doctor.postdata');
