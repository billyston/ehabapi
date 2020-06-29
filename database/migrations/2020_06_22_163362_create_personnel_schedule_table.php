<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnel_schedule', function ( Blueprint $table )
        {
            $table -> id();

            $table -> unsignedBigInteger('schedule_id');
            $table -> unsignedBigInteger('personnel_id');

            $table -> timestamps();

            $table -> foreign('schedule_id') -> references('id') -> on('schedules') -> onDelete('cascade');
            $table -> foreign('personnel_id') -> references('id') -> on('personnels') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnel_schedule');
    }
}
