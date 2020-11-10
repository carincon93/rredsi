<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nodes')->insert([
            [
                'id'                => 1,
                'state'             => 'Caldas',
                'administrator_id'  => 1
            ]
        ]);
    }
}
