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
    Route::group(['namespace' => 'SystemAdmins'], function ()
    {
        Route::post('/login', 'AuthenticationController@login' );

        Route::apiResource( 'sysadmin', 'SystemAdminController' );
        Route::apiResource( 'hospitals', 'HospitalController' );
        Route::apiResource( 'administrators', 'AdministratorController' );
        Route::apiResource( 'specialties', 'SpecialtyController' );
        Route::apiResource( 'services', 'ServiceController' );
        Route::apiResource( 'schedules', 'ScheduleController' );
        Route::apiResource( 'personnel', 'PersonnelController' );
        Route::apiResource( 'groups', 'GroupController' );
        Route::apiResource( 'clients', 'ClientController' );
        Route::apiResource( 'next-of-kins', 'NextOfKinController' );
        Route::apiResource( 'appointments', 'AppointmentController' );
        Route::apiResource( 'registrars', 'RegistrarController' );
    });
});

// Administrator routes
Route::domain( 'administrator.'.env('APP_URL' ) ) -> group( static function ()
{
    Route::group(['namespace' => 'Administrators'], function ()
    {
        Route::post('/login', 'AuthenticationController@login' );
    });
});

// Registrar routes
Route::domain( 'registrar.'.env('APP_URL') ) -> group( static function ()
{
    Route::group(['namespace' => 'Registrars'], function ()
    {
        Route::post('/login', 'AuthenticationController@login' );
    });
});


// Personnel routes
Route::domain( 'personnel.'.env('APP_URL') ) -> group( static function ()
{
    Route::group(['namespace' => 'Personnel'], function ()
    {
        Route::post('/login', 'AuthenticationController@login' );
    });
});
