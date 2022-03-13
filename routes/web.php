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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('public_forms','FormsDisplayController@get_public_forms')->name('public_forms');
Route::get('public_forms/view/{form_id}','FormsDisplayController@view_public_form')->name('public_forms.show');
//forms resource
Route::resource('forms', "FormsController");

