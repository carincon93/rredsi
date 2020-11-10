<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'id'                => 1,
            'title'             => 'Title example',
            'start_date'        => '2020-01-01',
            'end_date'          => '2020-12-31',
            'type'              => 'Type example ',
            'abstract'          => 'AbstractExample',
            'keywords'          =>  json_encode(['Word1', 'Word2']),
            'file'              => '/projects/FileExample.pdf',
            'overall_objective' => 'ObjectiveExample',
            'is_privated'       =>  true,
            'is_published'      =>  true
        ]);
    }
}
