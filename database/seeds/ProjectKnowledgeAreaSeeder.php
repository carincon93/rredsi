<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectKnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_knowledge_area')->insert([
            [
                'project_id'        => 1,
                'knowledge_area_id' => 1
            ]
        ]);
    }
}
