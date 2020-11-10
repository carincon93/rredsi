<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_outputs')->insert([
            [
                'id'                => 1,
                'title'             => 'Title Example',
                'typology'          => 'TypologyExample',
                'description'       => 'DescriptionExample',
                'file'              => '/research/outputs/FileExample.pdf',
                'project_id'        => 1
            ]
        ]);
    }
}
