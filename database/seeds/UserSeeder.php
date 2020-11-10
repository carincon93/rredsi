<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'id'                => 1,
                'name'              => 'Tatiana Marin',
                'email'             => 'tmarin@ucaldas.edu.co',
                'password'          => Hash::make('12345678'),
                'document_type'     => 'CC',
                'document_number'   => '12345678',
                'cellphone_number'  => '3136133232',
                'status'            => 'Aceptado',
                'interests'         => json_encode(['musica', 'leer']),
                'is_enabled'        => true,
            ],
            [
                'id'                => 2,
                'name'              => 'Hades Salazar',
                'email'             => 'hsalazar@sena.edu.co',
                'password'          => Hash::make('12315678'),
                'document_type'     => 'CC',
                'document_number'   => '12315678',
                'cellphone_number'  => '3136133232',
                'status'            => 'Aceptado',
                'interests'         => json_encode(['musica', 'leer']),
                'is_enabled'        => true,
            ],
            [
                'id'                => 3,
                'name'              => 'Juan Serna',
                'email'             => 'juserna@sena.edu.co',
                'password'          => Hash::make('11145678'),
                'document_type'     => 'CC',
                'document_number'   => '11145678',
                'cellphone_number'  => '3136133232',
                'status'            => 'Aceptado',
                'interests'         => json_encode(['musica', 'leer']),
                'is_enabled'        => true,
            ],
            [
                'id'                => 4,
                'name'              => 'Juana Gonzalez',
                'email'             => 'jgonzalaz@sena.edu.co',
                'password'          => Hash::make('11115678'),
                'document_type'     => 'CC',
                'document_number'   => '11115678',
                'cellphone_number'  => '3136133232',
                'status'            => 'Aceptado',
                'interests'         => json_encode(['musica', 'leer']),
                'is_enabled'        => true,
            ],
            [
                'id'                => 5,
                'name'              => 'Juan Londono',
                'email'             => 'jlondono@sena.edu.co',
                'password'          => Hash::make('11111678'),
                'document_type'     => 'CC',
                'document_number'   => '11111678',
                'cellphone_number'  => '3136133232',
                'status'            => 'Aceptado',
                'interests'         => json_encode(['musica', 'leer']),
                'is_enabled'        => true,
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'user_id'=>1,
                'role_id'=>1
            ],
            [
                'user_id'=>2,
                'role_id'=>1
            ],
            [
                'user_id'=>3,
                'role_id'=>3
            ],
            [
                'user_id'=>4,
                'role_id'=>4
            ],
            [
                'user_id'=>5,
                'role_id'=>5
            ],
        ]);
    }
}
