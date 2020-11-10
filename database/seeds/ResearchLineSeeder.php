<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_lines')->insert([
            [
                'id'                => 1,
                'name'              => 'Diseño y aplicación de TICS',
                'objectives'        => 'ObjectivesExamples',
                'mission'           => 'MissionExample',
                'vision'            => 'VisionExample',
                'achievements'      => 'AchievementsExample',
                'knowledge_area_id' => 1,
                'research_group_id' => 1
            ]
        ]);
    }
}
