<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'countries' ) -> insert ([
            'smart_id'          => Str::random( 15 ),
            'name'              => 'Ghana',
            'currency'          => 'GHS',
            'country_code'      => '23321',
            'phone_code'        => '233',
        ]);
    }
}
