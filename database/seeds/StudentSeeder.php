<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'id'            => 4,
                'cvlac'         => 'www.google.com',
                'is_accepted'   => true,
            ]
        ]);
    }
}
