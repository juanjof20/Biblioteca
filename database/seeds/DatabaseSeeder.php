<?php

use App\Libro;
use App\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UsuarioSeeder::class);
        $this->call(LibroSeeder::class);
 
        for ($i=0; $i<25; $i++)
        {
            $usuario = Usuario::all()->random();
            $libro = Libro::all()->random()->id;
            $usuario->libros()->attach($libro);
        }
        Schema::enableForeignKeyConstraints();
    }
}