<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_teams')->insert([
            [
                'id'                            => 1,
                'name'                          => 'Amarillo',
                'mentor_name'                   => 'Alfonso Mejía',
                'mentor_email'                  => 'amejia@sena.edu.co',
                'mentor_cellphone'              => '123123123',
                'overall_objective'             => 'ObjectiveExample',
                'mission'                       => 'MissionExample',
                'vision'                        => 'VisionExample',
                'regional_projection'           => 'RegionalProjectionExample',
                'knowledge_production_strategy' => 'TextExample',
                'thematic_research'             => json_encode(['Thematic1', 'Thematic2']),
                'creation_date'                 => new DateTime(),
                'administrator_id'              => 3,
                'research_group_id'             => 1,
                'student_leader_id'             => null
            ]
        ]);
    }
}
