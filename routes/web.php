<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'admin\AdminController@index')->name('dashboard');
Route::get('/edit/{id}', 'admin\AdminController@edit')->name('counsellor.edit');
Route::get('/update', 'admin\AdminController@update')->name('counsellor.update');
Route::post('/selectC', 'HomeController@choose')->name('counsellor.choose');
Route::get('/detail/{id}', 'HomeController@detail')->name('counsellor.detail');
