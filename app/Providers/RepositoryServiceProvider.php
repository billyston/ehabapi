<?php

namespace App\Providers;

use App\Repositories\AdministratorRepository;
use App\Repositories\AdministratorRepositoryInterface;
use App\Repositories\AppointmentRepository;
use App\Repositories\AppointmentRepositoryInterface;
use App\Repositories\ClientRepository;
use App\Repositories\ClientRepositoryInterface;
use App\Repositories\GroupRepository;
use App\Repositories\GroupRepositoryInterface;
use App\Repositories\HospitalRepository;
use App\Repositories\HospitalRepositoryInterface;
use App\Repositories\PersonnelRepository;
use App\Repositories\PersonnelRepositoryInterface;
use App\Repositories\RegistrarRepository;
use App\Repositories\RegistrarRepositoryInterface;
use App\Repositories\ScheduleRepository;
use App\Repositories\ScheduleRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\ServiceRepositoryInterface;
use App\Repositories\SpecialtyRepository;
use App\Repositories\SpecialtyRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this -> app -> bind( HospitalRepositoryInterface::class, HospitalRepository::class );
        $this -> app -> bind( AdministratorRepositoryInterface::class, AdministratorRepository::class );
        $this -> app -> bind( RegistrarRepositoryInterface::class, RegistrarRepository::class );
        $this -> app -> bind( SpecialtyRepositoryInterface::class, SpecialtyRepository::class );
        $this -> app -> bind( ServiceRepositoryInterface::class, ServiceRepository::class );
        $this -> app -> bind( ScheduleRepositoryInterface::class, ScheduleRepository::class );
        $this -> app -> bind( PersonnelRepositoryInterface::class, PersonnelRepository::class );
        $this -> app -> bind( GroupRepositoryInterface::class, GroupRepository::class );
        $this -> app -> bind( ClientRepositoryInterface::class, ClientRepository::class );
        $this -> app -> bind( AppointmentRepositoryInterface::class, AppointmentRepository::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
