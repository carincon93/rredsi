<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchTeamResearchLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_team_research_line')->insert([
            [
                'research_team_id' => 1,
                'research_line_id' => 1
            ]
        ]);
    }
}
