<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class MaestrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      DB::table('maestros')
          ->insert([[ 'titulo' => 'Escritorio', 'padre_id' => 1],
                    [ 'titulo' => 'Objetivos', 'padre_id' => 2],
                    [ 'titulo' => 'Plancas', 'padre_id' => 3],
                    [ 'titulo' => 'Experimentos', 'padre_id' => 4],
                    [ 'titulo' => 'Campañas', 'padre_id' => 5],
                

                    [ 'titulo' => 'Configuracion', 'padre_id' => 6],
                    [ 'titulo' => 'Usuarios', 'padre_id' => 6],
                    [ 'titulo' => 'Roles', 'padre_id' => 6],
                    [ 'titulo' => 'Mis proyectos', 'padre_id' => 9],
                   
                 
                ]);
    }
}
