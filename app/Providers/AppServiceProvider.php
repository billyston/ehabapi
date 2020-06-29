<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Administrator;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Group;
use App\Models\Hospital;
use App\Models\NextOfKin;
use App\Models\Personnel;
use App\Models\Phone;
use App\Models\Registrar;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Specialty;
use App\Observers\AddressObserver;
use App\Observers\AdministratorObserver;
use App\Observers\AppointmentObserver;
use App\Observers\ClientObserver;
use App\Observers\GroupObserver;
use App\Observers\HospitalObserver;
use App\Observers\NextOfKinObserver;
use App\Observers\PersonnelObserver;
use App\Observers\PhoneObserver;
use App\Observers\RegistrarObserver;
use App\Observers\ScheduleObserver;
use App\Observers\ServiceObserver;
use App\Observers\SpecialtyObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Hospital::observe( HospitalObserver::class );
        Address::observe( AddressObserver::class );
        Phone::observe( PhoneObserver::class );
        Administrator::observe( AdministratorObserver::class );
        Registrar::observe( RegistrarObserver::class );
        Specialty::observe( SpecialtyObserver::class );
        Service::observe( ServiceObserver::class );
        Schedule::observe( ScheduleObserver::class );
        Personnel::observe( PersonnelObserver::class );
        Group::observe( GroupObserver::class );
        Client::observe( ClientObserver::class );
        NextOfKin::observe( NextOfKinObserver::class );
        Appointment::observe( AppointmentObserver::class );
    }
}
