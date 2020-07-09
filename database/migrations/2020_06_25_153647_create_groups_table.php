<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function ( Blueprint $table )
        {
            $table -> id();
            $table -> uuid('smart_id') -> index();

            $table -> string('name');
            $table -> string('heading');
            $table -> string( 'client_message' );
            $table -> string( 'personnel_message' );

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
        Schema::dropIfExists('groups' );
    }
}
