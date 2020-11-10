<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_groups')->insert([
            [
                'id'                        => 1,
                'name'                      => 'GRINDDA',
                'email'                     => 'info@grindda.com',
                'leader'                    => 'Adriana Rodríguez',
                'gruplac'                   => 'https://gruplac.com/grindda',
                'minciencias_code'          => '12312sad',
                'minciencias_category'      => 'A',
                'website'                   => 'https://www.grindda.com',
                'educational_institution_id'=> 1
            ]
        ]);
    }
}
