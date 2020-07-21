<?php

namespace App\Providers;

use App\Repositories\AdministratorRepository;
use App\Repositories\AdministratorRepositoryInterface;
use App\Repositories\Administrators\HospitalAppointmentRepository;
use App\Repositories\Administrators\HospitalAppointmentRepositoryInterface;
use App\Repositories\Administrators\HospitalClientRepository;
use App\Repositories\Administrators\HospitalClientRepositoryInterface;
use App\Repositories\Administrators\HospitalGroupRepository;
use App\Repositories\Administrators\HospitalGroupRepositoryInterface;
use App\Repositories\Administrators\HospitalMessageRepository;
use App\Repositories\Administrators\HospitalMessageRepositoryInterface;
use App\Repositories\Administrators\HospitalPersonnelRepository;
use App\Repositories\Administrators\HospitalPersonnelRepositoryInterface;
use App\Repositories\Administrators\HospitalScheduleRepository;
use App\Repositories\Administrators\HospitalScheduleRepositoryInterface;
use App\Repositories\Administrators\HospitalServiceRepository;
use App\Repositories\Administrators\HospitalServiceRepositoryInterface;
use App\Repositories\Administrators\HospitalSpecialtyRepository;
use App\Repositories\Administrators\HospitalSpecialtyRepositoryInterface;
use App\Repositories\AppointmentRepository;
use App\Repositories\AppointmentRepositoryInterface;
use App\Repositories\ClientRepository;
use App\Repositories\ClientRepositoryInterface;
use App\Repositories\GroupRepository;
use App\Repositories\GroupRepositoryInterface;
use App\Repositories\HospitalRepository;
use App\Repositories\HospitalRepositoryInterface;
use App\Repositories\MessageRepository;
use App\Repositories\MessageRepositoryInterface;
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
        // System admins repo
        $this -> app -> bind( HospitalRepositoryInterface::class, HospitalRepository::class );
        $this -> app -> bind( AdministratorRepositoryInterface::class, AdministratorRepository::class );
        $this -> app -> bind( RegistrarRepositoryInterface::class, RegistrarRepository::class );
        $this -> app -> bind( ServiceRepositoryInterface::class, ServiceRepository::class );
        $this -> app -> bind( SpecialtyRepositoryInterface::class, SpecialtyRepository::class );
        $this -> app -> bind( ScheduleRepositoryInterface::class, ScheduleRepository::class );
        $this -> app -> bind( PersonnelRepositoryInterface::class, PersonnelRepository::class );
        $this -> app -> bind( GroupRepositoryInterface::class, GroupRepository::class );
        $this -> app -> bind( ClientRepositoryInterface::class, ClientRepository::class );
        $this -> app -> bind( AppointmentRepositoryInterface::class, AppointmentRepository::class );
        $this -> app -> bind( MessageRepositoryInterface::class, MessageRepository::class );

        // Administrator's repo
        $this -> app -> bind( HospitalSpecialtyRepositoryInterface::class, HospitalSpecialtyRepository::class );
        $this -> app -> bind( HospitalServiceRepositoryInterface::class, HospitalServiceRepository::class );
        $this -> app -> bind( HospitalScheduleRepositoryInterface::class, HospitalScheduleRepository::class );
        $this -> app -> bind( HospitalPersonnelRepositoryInterface::class, HospitalPersonnelRepository::class );
        $this -> app -> bind( HospitalGroupRepositoryInterface::class, HospitalGroupRepository::class );
        $this -> app -> bind( HospitalClientRepositoryInterface::class, HospitalClientRepository::class );
        $this -> app -> bind( HospitalAppointmentRepositoryInterface::class, HospitalAppointmentRepository::class );
        $this -> app -> bind( HospitalMessageRepositoryInterface::class, HospitalMessageRepository::class );
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
