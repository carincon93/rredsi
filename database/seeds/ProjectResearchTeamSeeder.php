<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectResearchTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_research_team')->insert([
            'project_id'        => 1,
            'research_team_id'  => 1,
            'is_principal'      => true
        ]);
    }
}
