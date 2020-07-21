<?php

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
Route::domain('system.' . env('APP_URL') ) -> group( static function ()
{
    Route::group(['namespace' => 'SystemAdmins'], function ()
    {
        Route::post('/login', 'SystemAdminController@login');
        Route::group(['middleware' => 'auth:system'], function ()
        {
            Route::post('/logout', 'SystemAdminController@logout');
            Route::apiResource('sysadmin', 'SystemAdminController');
            Route::apiResource('hospitals', 'HospitalController');
            Route::apiResource('administrators', 'AdministratorController');
            Route::apiResource('specialties', 'SpecialtyController');
            Route::apiResource('services', 'ServiceController');
            Route::apiResource('schedules', 'ScheduleController');
            Route::apiResource('personnel', 'PersonnelController');
            Route::apiResource('groups', 'GroupController');
            Route::apiResource('clients', 'ClientController');
            Route::apiResource('next-of-kins', 'NextOfKinController');
            Route::apiResource('messages', 'MessageController');
            Route::apiResource('appointments', 'AppointmentController');
            Route::apiResource('registrars', 'RegistrarController');
        });
    });
} );

// Administrator routes
Route::domain('administrator.' . env( 'APP_URL' ) ) -> group( static function ()
{
    Route::group(['namespace' => 'Administrators'], function ()
    {
        Route::post( '/login', 'AdministratorController@login' );
        Route::group(['middleware' => 'auth:administrator'], function ()
        {
            Route::post('/logout', 'AdministratorController@logout');
            Route::apiResource('hospital.specialties', 'HospitalSpecialtyController' );
            Route::apiResource('hospital.services', 'HospitalServiceController' );
            Route::apiResource('hospital.schedules', 'HospitalScheduleController' );
            Route::apiResource('hospital.personnel', 'HospitalPersonnelController' );
            Route::apiResource('hospital.groups', 'HospitalGroupController' );
            Route::apiResource('hospital.clients', 'HospitalClientController' );
            Route::apiResource('hospital.messages', 'HospitalMessageController' );
            Route::apiResource('hospital.appointments', 'HospitalAppointmentController' );
        });
    });
} );

// Registrar routes
Route::domain('registrar.' . env( 'APP_URL' ) ) -> group( static function ()
{
    Route::group(['namespace' => 'Registrars'], function ()
    {
        Route::post('/login', 'RegistrarController@login');

        Route::group(['middleware' => 'auth:registrar'], function ()
        {
            Route::post('logout', 'RegistrarController@logout');
            Route::apiResource('profile', 'RegistrarController')->only('show', 'update');
        });
    });
} );

// Personnel routes
Route::domain('personnel.' . env( 'APP_URL' ) ) -> group( static function ()
{
    Route::group(['namespace' => 'Personnel'], function ()
    {
        Route::post('/login', 'PersonnelController@login');

        Route::group(['middleware' => 'auth:personnel'], function ()
        {
            Route::post('logout', 'PersonnelController@logout');
            Route::apiResource('profile', 'PersonnelController')->only('show', 'update');
        });
    });
} );

// Client routes
Route::domain('client.' . env( 'APP_URL' ) ) -> group( static function ()
{
    Route::group(['namespace' => 'Clients'], function ()
    {
        Route::post('/login', 'ClientController@login');

        Route::group(['middleware' => 'auth:client'], function ()
        {
            Route::post('logout', 'ClientController@logout');
            Route::apiResource('profile', 'ClientController')->only('show', 'update');
        });
    });
} );
