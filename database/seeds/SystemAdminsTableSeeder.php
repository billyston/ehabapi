<?php

use App\Models\SystemAdmin;
use Illuminate\Database\Seeder;

class SystemAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SystemAdmin::class)->create(['email' => 'billyston@gmail.com']);
    }
}
