<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectAcademicProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_academic_program')->insert([
            [
                'project_id'            => 1,
                'academic_program_id'   => 1
            ]
        ]);
    }
}
