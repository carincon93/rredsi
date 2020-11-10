<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_institutions')->insert([
            [
                'id'                => 1,
                'name'              => 'Sena',
                'nit'               => random_int(0, 10000),
                'address'           => 'Cr23 #61-51',
                'city'              => 'Manizales',
                'phone_number'      => random_int(0, 100000000),
                'website'           => 'www.sena.edu.co',
                'administrator_id'  => 2,
                'node_id'           => 1
            ]
        ]);
    }
}
