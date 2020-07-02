<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function ( Blueprint $table )
        {
            $table -> id();
            $table -> uuid('smart_id') -> index();

            $table -> unsignedBigInteger('group_id' );
            $table -> unsignedBigInteger('service_id' );
            $table -> unsignedBigInteger('notification_id' );
            $table -> unsignedBigInteger('personnel_id' );

            $table -> dateTime( 'appointment_date' );
            $table -> integer('interval' );

            $table -> foreign('group_id')       -> references('id') -> on('groups')     -> onDelete('cascade' );
            $table -> foreign('service_id')     -> references('id') -> on('services')   -> onDelete('cascade' );
            $table -> foreign('notification_id')     -> references('id') -> on('notifications')   -> onDelete('cascade' );
            $table -> foreign('personnel_id')   -> references('id') -> on('personnels') -> onDelete('cascade' );

            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}

