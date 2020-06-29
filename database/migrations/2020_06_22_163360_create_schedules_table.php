<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function ( Blueprint $table )
        {
            $table -> id();
            $table -> uuid('smart_id') -> index();
            $table -> unsignedBigInteger('service_id');

            $table -> time('starts_at');
            $table -> time('ends_at');

            $table -> timestamps();

            $table -> foreign('service_id') -> references('id' ) -> on ('services' ) -> onDelete('cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
