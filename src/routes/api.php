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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::post('login', 'App\Http\Controllers\AuthController@login');

//Route::apiResource('companies', 'CompanyController');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('companies/{company}', 'App\Http\Controllers\CompanyController@show');
    Route::post('companies', 'App\Http\Controllers\CompanyController@store');
    Route::post('invoices', 'App\Http\Controllers\InvoiceController@store');
    Route::put('invoices/{invoice_number}', 'App\Http\Controllers\InvoiceController@update');
});
