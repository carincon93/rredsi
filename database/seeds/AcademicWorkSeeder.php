<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_works')->insert([
            [
                'id'                        => 1,
                'title'                     => 'Title Example',
                'type'                      => 'Type Example',
                'authors'                   => json_encode(['Juan', 'Maria', 'Luis']),
                'grade'                     => 3.5,
                'mentors'                   => json_encode(['Santiago', 'David']),
                'research_group_id'         => 1,
                'knowledge_area_id'         => 1,
                'graduation_id'             => 1
            ]
        ]);
    }
}
