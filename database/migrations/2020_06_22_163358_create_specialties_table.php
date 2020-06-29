<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function ( Blueprint $table )
        {
            $table -> bigIncrements('id');
            $table -> uuid('smart_id') -> unique();
            $table -> unsignedBigInteger('hospital_id');

            $table -> string('name') -> unique();
            $table -> string('known_as') -> unique();
            $table -> string('description') -> nullable();

            $table -> timestamps();

            $table -> foreign('hospital_id') -> references('id' ) -> on ('hospitals' ) -> onDelete('cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialties');
    }
}
