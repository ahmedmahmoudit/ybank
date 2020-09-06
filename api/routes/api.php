<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('accounts/{id}', 'AccountController@show')->name('account.show');
Route::get('accounts/{id}/transactions', 'TransactionController@list')->name('account.transactions.list');

Route::post('accounts/{id}/transactions', 'TransactionController@store')->name('account.transactions.store');

Route::get('currencies', function () {
    $account = DB::table('currencies')
        ->get();

    return $account;
});
