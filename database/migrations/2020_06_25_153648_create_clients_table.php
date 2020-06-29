<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function ( Blueprint $table )
        {
            $table -> id();
            $table -> uuid('smart_id') -> index();
//            $table -> unsignedBigInteger('group_id');

            $table -> string('title');
            $table -> string('first_name');
            $table -> string('middle_name');
            $table -> string('last_name');
            $table -> string('gender', 6);
            $table -> date('date_of_birth');

            $table -> string('occupation');
            $table -> string('nationality');

            $table -> string('email') -> unique() -> nullable();
            $table -> string('password') -> nullable();

            $table -> timestamp('email_verified_at') -> nullable();

            $table -> string('status') ->default( 'active' );

            $table -> timestamps();

//            $table -> foreign('group_id' ) -> references('id' ) -> on ('groups' ) -> onDelete('cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
