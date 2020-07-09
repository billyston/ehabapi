<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function ( Blueprint $table )
        {
            $table -> id();
            $table -> uuid('smart_id') -> index();

            $table -> string('title');
            $table -> string('first_name');
            $table -> string('middle_name');
            $table -> string('last_name');
            $table -> string('gender', 6);

            $table -> string('role') -> index();

            $table -> string('facebook' ) -> nullable();
            $table -> string('twitter' ) -> nullable();
            $table -> string('linkedin' ) -> nullable();

            $table -> string('email') -> unique();
            $table -> timestamp('email_verified_at') -> nullable();

            $table -> string('password') -> nullable();
            $table -> string('status') ->default( 'active' );

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
        Schema::dropIfExists('personnels');
    }
}
