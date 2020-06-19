<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function ( Blueprint $table )
        {
            $table -> id();
            $table -> uuid('smart_id') -> unique();

            $table -> string('country');
            $table -> string('postal_code');

            $table -> string('region');
            $table -> string('city');
            $table -> string('street_address') -> index();
            $table -> string('house_number');

            $table -> morphs('addressable');
            $table -> boolean('is_verified') ->default(false);

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
        Schema::dropIfExists('addresses');
    }
}
