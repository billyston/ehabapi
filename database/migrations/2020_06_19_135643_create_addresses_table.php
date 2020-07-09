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
            $table -> bigIncrements('id');
            $table -> uuid('smart_id') -> unique();

            $table -> unsignedBigInteger('country_id');
            $table -> string('postal_code');

            $table -> string('region');
            $table -> string('city');
            $table -> string('street_name') -> index();
            $table -> string('house_number') -> nullable();

            $table -> morphs('addressable');
            $table -> boolean('is_verified') ->default(false);

            $table -> timestamps();

            $table -> foreign('country_id') -> references('id') -> on('countries') -> onDelete('cascade');
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
