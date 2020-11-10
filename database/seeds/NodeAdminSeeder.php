<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('node_admins')->insert([
            [
                'id' => 1
            ]
        ]);
    }
}
