<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdministratorHospital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator_hospital', static function ( Blueprint $table )
        {
            $table -> id();

            $table -> unsignedBigInteger('administrator_id') -> index();
            $table -> unsignedBigInteger('hospital_id') -> index();

            $table -> timestamps();

            $table -> foreign('administrator_id') -> references('id') -> on('administrators') -> onDelete('cascade');
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
        Schema::dropIfExists('administrator_hospital');
    }
}
