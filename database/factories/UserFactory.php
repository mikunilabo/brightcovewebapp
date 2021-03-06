<?php
declare(strict_types=1);

use App\Model\Eloquent\Role;
use App\Model\Eloquent\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'company' => $faker->company,
        'role_id' => $faker->randomElement(Role::pluck('id')->all()),
        'password' => 'password',
        'remember_token' => str_random(10),
    ];
});
