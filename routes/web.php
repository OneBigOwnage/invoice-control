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


// Auth
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');


// Dashboard
Route::view('/dashboard', 'dashboard')->name('dashboard');


// Entities
Route::resource('customers', 'CustomersController');
Route::resource('payrates', 'PayRatesController')->parameters(['payrates' => 'payRate']);
Route::resource('invoices', 'InvoicesController');
