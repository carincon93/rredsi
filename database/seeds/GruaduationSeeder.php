<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruaduationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('graduations')->insert([
            [
                'id'                    => 1,
                'is_graduated'          => true,
                'year'                  => 2020,
                'academic_program_id'   => 1,
                'user_id'               => 4
            ]
        ]);
    }
}
