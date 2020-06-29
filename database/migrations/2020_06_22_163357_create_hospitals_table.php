<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function ( Blueprint $table )
        {
            $table -> bigIncrements('id');
            $table -> uuid('smart_id') -> unique();

            $table -> string( 'name' ) -> unique();
            $table -> string( 'known_as' );
            $table -> string( 'about' );

            $table -> string( 'website' );
            $table -> string( 'email' ) -> unique();

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
        Schema::dropIfExists('hospitals');
    }
}
