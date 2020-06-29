<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_admins', function ( Blueprint $table )
        {
            $table -> bigIncrements('id');
            $table -> uuid('smart_id') -> unique();

            $table -> string('first_name', 20);
            $table -> string('middle_name', 20);
            $table -> string('last_name', 20);
            $table -> string('gender', 6);

            $table -> string('department');
            $table -> string('position');

            $table -> string('email') -> unique();
            $table -> timestamp('email_verified_at') -> nullable();

            $table -> string('password');
            $table -> string('status');

            $table -> rememberToken();
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
        Schema::dropIfExists('system_admins');
    }
}
