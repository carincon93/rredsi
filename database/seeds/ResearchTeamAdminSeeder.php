<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchTeamAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_team_admins')->insert([
            [
                'id'                        => 3,
                'educational_institution_id'=> 1,
            ]
        ]);
    }
}
