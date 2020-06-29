<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_client', function ( Blueprint $table )
        {
            $table -> id();

            $table -> unsignedBigInteger('appointment_id');
            $table -> unsignedBigInteger('client_id');

            $table -> timestamps();

            $table -> foreign('appointment_id') -> references('id') -> on('appointments') -> onDelete('cascade');
            $table -> foreign('client_id') -> references('id') -> on('clients') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_client');
    }
}
