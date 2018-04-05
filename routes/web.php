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

Route::get('/da','Login\logController@GetForm');
Route::post('/register','Login\logController@PostRegisterUser');
Route::post('/Log','Login\logController@PostLogUser');
Route::get('/','admincontroller@getAdmin');
