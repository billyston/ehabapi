<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNextOfKinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('next_of_kin', function (Blueprint $table) {
            $table -> id();
            $table -> uuid('smart_id') -> index();
            $table -> unsignedBigInteger('client_id');

            $table -> string('first_name');
            $table -> string('middle_name');
            $table -> string('last_name');
            $table -> string('gender', 6);

            $table -> string('mobile_phone', 12 );
            $table -> string('other_phone', 12 );

            $table -> string('relation');

            $table -> timestamps();

            $table -> foreign('client_id') -> references('id' ) -> on ('clients' ) -> onDelete('cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('next_of_kin');
    }
}
