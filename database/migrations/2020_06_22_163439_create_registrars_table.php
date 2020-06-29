<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrars', function (Blueprint $table)
        {
            $table -> bigIncrements('id');
            $table -> uuid('smart_id');

            $table -> string('first_name');
            $table -> string('middle_name');
            $table -> string('last_name');
            $table -> string('gender', 6);

            $table -> string('email') -> unique();
            $table -> timestamp('email_verified_at') -> nullable();

            $table -> string('password');
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
        Schema::dropIfExists('registrars');
    }
}
