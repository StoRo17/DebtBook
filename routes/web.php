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

Route::get('/', function () {
    return view('master');
});
Route::get('/verify-email/{token}', 'Auth\RegisterController@verify');

Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\RegisterController@register')->name('register');
    Route::post('login', 'Auth\LoginController@login')->name('login');
});

Route::get('/users/{id}', function ($id) {
    return \App\User::find($id)->toArray();
});

Route::get('/{vue?}', function () { return view('master'); })->where('vue', '[\/\w\.-]*');