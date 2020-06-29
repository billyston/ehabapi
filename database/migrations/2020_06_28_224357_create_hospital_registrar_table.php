<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalRegistrarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_registrar', function ( Blueprint $table )
        {
            $table -> id();

            $table -> unsignedBigInteger('registrar_id') -> index();
            $table -> unsignedBigInteger('hospital_id') -> index();

            $table -> timestamps();

            $table -> foreign('registrar_id') -> references('id') -> on('registrars') -> onDelete('cascade');
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
        Schema::dropIfExists('hospital_registrar');
    }
}
