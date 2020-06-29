<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnel_service', function ( Blueprint $table )
        {
            $table -> id();

            $table -> unsignedBigInteger('personnel_id');
            $table -> unsignedBigInteger('service_id');

            $table -> timestamps();

            $table -> foreign('personnel_id') -> references('id') -> on('personnels') -> onDelete('cascade');
            $table -> foreign('service_id') -> references('id') -> on('services') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnel_service');
    }
}
