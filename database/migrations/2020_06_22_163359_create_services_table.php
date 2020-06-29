<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table)
        {
            $table -> bigIncrements('id');
            $table -> uuid('smart_id') -> unique();
            $table -> unsignedBigInteger('specialty_id');

            $table -> string('name') -> unique();
            $table -> string('known_as') -> unique();
            $table -> string('description') -> nullable();

            $table -> timestamps();

            $table -> foreign('specialty_id') -> references('id' ) -> on ('specialties' ) -> onDelete('cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
