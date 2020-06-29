<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalPersonnelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_personnel', function ( Blueprint $table )
        {
            $table -> id();

            $table -> unsignedBigInteger('personnel_id');
            $table -> unsignedBigInteger('hospital_id');

            $table -> timestamps();

            $table -> foreign('personnel_id') -> references('id') -> on('personnels') -> onDelete('cascade');
            $table -> foreign('hospital_id') -> references('id') -> on('hospitals') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital_personnel');
    }
}
