<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'            => 1,
                'name'          => 'Administrador de nodo',
                'description'   => Str::random(10)
            ],[
                'id'            => 2,
                'name'          => 'Administrador de institucion educativa',
                'description'   => Str::random(10)
            ],[
                'id'            => 3,
                'name'          => 'Administrador de semillero',
                'description'   => Str::random(10)
            ],[
                'id'            => 4,
                'name'          => 'Estudiante',
                'description'   => Str::random(10)
            ],
            [
                'id'            => 5,
                'name'          => 'Investigador',
                'description'   => Str::random(10)
            ],
        ]);
    }
}
