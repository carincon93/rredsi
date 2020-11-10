<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_project')->insert([
            [
                'event_id'  => 1,
                'project_id'=> 1
            ]
        ]);
    }
}
