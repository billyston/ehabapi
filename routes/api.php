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

//Route::middleware('auth:api')->get('/user', function ( Request $request)
//{
//    return $request->user();
//});


// Admin routes
Route::domain('system.'.env('APP_URL') ) -> group( static function ()
{
    Route::apiResource( '', 'SystemAdminController' );
});

// Administrator routes
Route::domain('administrator.'.env('APP_URL') ) -> group( static function ()
{
    Route::apiResource( '', 'AdministratorController' );
});

// Personnel routes
Route::domain('personnel.'.env('APP_URL') ) -> group( static function ()
{
    Route::apiResource( '', 'PersonnelController' );
});

// Registrar routes
Route::domain('registrar.'.env('APP_URL') ) -> group( static function ()
{
    Route::apiResource( '', 'RegistrarController' );
});
