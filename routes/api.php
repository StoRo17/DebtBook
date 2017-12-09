<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/verify-email/{token}', 'Auth\RegisterController@verify')->name('verifyEmail');

Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users/{id}', 'UserController@show')->name('getUser');
    Route::put('/users/{id}/profile', 'ProfileController@update')->name('updateProfile');

    Route::group(['prefix' => '/users/{userId}'], function () {
        Route::get('/debts', 'DebtController@index')->name('getDebts');
        Route::get('/debts/{debtId}', 'DebtController@show')->name('getDebt');
        Route::post('/debts', 'DebtController@create')->name('createDebt');
        Route::delete('/debts/{debtId}', 'DebtController@delete')->name('deleteDebt');

        Route::get('/debts/{debtId}/history', 'DebtsHistoryController@index')->name('getDebtHistory');
        Route::post('/debts/{debtId}/history', 'DebtsHistoryController@create')->name('createDebtHistory');
        Route::put('/debts/{debtId}/history/{debtHistoryId}', 'DebtsHistoryController@update')
            ->name('updateDebtHistory');
        Route::delete('/debts/{debtId}/history/{debtHistoryId}', 'DebtsHistoryController@delete')
            ->name('deleteDebtHistory');
    });
});
