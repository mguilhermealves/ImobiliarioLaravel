<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Usuario;
use Illuminate\Support\Str;
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

$factory->define(Usuario::class, function (Faker $faker) {
    return [
        'empresa_id' => 1,
        'nome' => $faker->firstName(),
        'sobrenome' => $faker->lastName,
        'email' => 'davi@voxdigital.com.br',
        'senha' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'reset_token' => Str::random(10),
    ];
});
