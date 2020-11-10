<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchTeamKnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_team_knowledge_area')->insert([
            [
                'research_team_id'  => 1,
                'knowledge_area_id' => 1
            ]
        ]);
    }
}
