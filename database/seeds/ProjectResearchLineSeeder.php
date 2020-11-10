<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectResearchLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_research_line')->insert([
            [
                'project_id'        => 1,
                'research_line_id'  => 1
            ]
        ]);
    }
}
