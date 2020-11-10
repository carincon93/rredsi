<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalInstitutionEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_institution_events')->insert([
            [
               'id'                             => 2,
                'educational_institution_id'    => 1
            ]
        ]);
    }
}
