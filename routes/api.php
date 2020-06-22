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

// Admin routes
Route::domain('system.'.env('APP_URL') ) -> group( static function ()
{
//    Route::post('/login', '');

    Route::apiResource( 'sysadmin', 'SystemAdminController' );
    Route::apiResource( 'hospitals', 'HospitalController' );
    Route::apiResource( 'administrators', 'AdministratorController' );
    Route::apiResource( 'personnel', 'PersonnelController' );
    Route::apiResource( 'registrars', 'RegistrarController' );
});

// Administrator routes
Route::domain('administrator.'.env('APP_URL') ) -> group( static function ()
{
//    Route::post('/login', '');

    Route::get('/profile/{profile}', 'AdministratorController@show');
    Route::put('/update/{profile}', 'AdministratorController@update');
    Route::patch('/update/{profile}', 'AdministratorController@update');

    Route::apiResource( 'personnel', 'PersonnelController' );
    Route::apiResource( 'registrars', 'RegistrarController' );
});

// Personnel routes
Route::domain('personnel.'.env('APP_URL') ) -> group( static function ()
{
//    Route::post('/login', '');

    Route::get('/profile/{profile}', 'PersonnelController@show');
    Route::put('/update/{profile}', 'PersonnelController@update');
    Route::patch('/update/{profile}', 'PersonnelController@update');
});

// Registrar routes
Route::domain('registrar.'.env('APP_URL') ) -> group( static function ()
{
//    Route::post('/login', '');

    Route::get('/profile/{profile}', 'RegistrarController@show');
    Route::put('/update/{profile}', 'RegistrarController@update');
    Route::patch('/update/{profile}', 'RegistrarController@update');
});
