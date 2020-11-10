<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearcherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('researchers')->insert([
            [
                'id'            => 5,
                'cvlac'         => 'www.cvlac.com',
                'is_accepted'   => true,
            ]
        ]);
    }
}
