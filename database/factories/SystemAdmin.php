<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\SystemAdmin;
use Faker\Generator as Faker;

$factory -> define(SystemAdmin::class, function ( Faker $faker)
{
    return
    [
        'first_name' => 'Michael',
        'middle_name' => 'Kabutey',
        'last_name' => 'Katey',
        'gender' => 'male',

        'department' => 'Technology',
        'position' => 'Programmer',

        'email' => '',
        'password' => 'sysadmin',

        'smart_id' => $faker -> uuid,
        'status' => 'active',
    ];
});
