<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'id'            => 1,
                'name'          => 'RREDSI Departamental',
                'location'      => 'Universidad de Caldas',
                'description'   => 'Description Example',
                'start_date'    => '2020-08-19',
                'end_date'      => '2020-08-20',
                'link'          => 'https://redsi.co/caldas-2020'
            ],
            [
                'id'            => 2,
                'name'          => 'Congreso SENA',
                'location'      => 'SENA Regional Caldas',
                'description'   => 'Description Example',
                'start_date'    => '2020-09-10',
                'end_date'      => '2020-09-12',
                'link'          => 'https://sena.edu.co/congreso-2020'
            ]
        ]);
    }
}
