<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_programs')->insert([
            [
                'id'                        => 1,
                'name'                      => 'Tecnólogo en Análisis y Desarrollo de Sistemas de Información',
                'code'                      =>  random_int(100, 1000),
                'academic_level'            => 'Tecnólogo',
                'modality'                  => 'Diurna',
                'daytime'                   => 'Daytime Example',
                'start_date'                => '2020-04-13',
                'end_date'                  => '2022-04-12',
                'educational_institution_id'=> 1
            ]
        ]);
    }
}
