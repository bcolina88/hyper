<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permisos')
          ->insert([
            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 1,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 2,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 3,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 4,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 5,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 6,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],


            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 7,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 8,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

               [ 'rol_id' => Config::get('constants.options.ROL_SUPERADMINISTRADOR'),
              'maestro_id' => 9,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],



               [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 1,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 2,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 3,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 4,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 5,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 6,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],


            [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 7,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 8,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

               [ 'rol_id' => Config::get('constants.options.ROL_EMPRESARIO'),
              'maestro_id' => 9,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],





               [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 1,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 2,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 3,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 4,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 5,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 6,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],


            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 7,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],

            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 8,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],


            [ 'rol_id' => Config::get('constants.options.ROL_AUTO_EMPLEADO'),
              'maestro_id' => 9,
              'agregar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'editar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'ver' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'inhabilitar' => Config::get('constants.options.PERMISO_AUTORIZADO'),
              'borrar' => Config::get('constants.options.PERMISO_AUTORIZADO')],





             
          ]);
    }
}
