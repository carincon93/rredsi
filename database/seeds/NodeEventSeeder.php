<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('node_events')->insert([
            [
                'id'        => 1,
                'node_id'   => 1
            ]
        ]);
    }
}
