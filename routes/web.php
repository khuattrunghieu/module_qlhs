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
});

Route::get('/admin/index', function () {
    return view('admin.index');
})->middleware('checkLogin')->name('admin.index');

Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@plogin')->name('plogin');
Route::get('register', 'AuthController@register')->name('register');
Route::post('register', 'AuthController@pregister')->name('pregister');
Route::get('logout', 'AuthController@logout')->name('logout');