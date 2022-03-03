<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libro;
use Faker\Generator as Faker;

$factory->define(Libro::class, function (Faker $faker)
{
    return [
        'titulo' => $faker->sentence(6),
        'descripcion' => $faker->paragraph(1), 
    ];
});

//REVISAR LO DE LOS DATOS Y NO PONER LO QUE ROBERT CREO
