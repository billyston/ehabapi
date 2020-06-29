<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function ( Blueprint $table )
        {
            $table -> bigIncrements('id');
            $table -> uuid('smart_id') -> unique();

            $table -> string('mobile_phone', 12 );
            $table -> string('other_phone', 12 );

            $table -> morphs('phoneable');

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
        Schema::dropIfExists('phones');
    }
}
