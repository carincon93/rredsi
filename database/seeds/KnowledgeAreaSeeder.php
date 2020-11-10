<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('knowledge_areas')->insert([
            [
                'id'    => 1,
                'name'  => 'Agronomía',
            ]
        ]);
    }
}
