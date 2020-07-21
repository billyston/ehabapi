<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function ( Blueprint $table )
        {
            $table -> id();
            $table -> uuid('smart_id') -> index();

            $table -> unsignedBigInteger('service_id' );

            $table -> string('message_header' );
            $table -> string('client_message' );
            $table -> string('personnel_message' );

            $table -> foreign('service_id')   -> references('id') -> on('services') -> onDelete('cascade' );

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
        Schema::dropIfExists('messages');
    }
}
