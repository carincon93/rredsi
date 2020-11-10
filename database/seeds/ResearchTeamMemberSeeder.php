<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchTeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_team_members')->insert([
            [
                'comment'               => 'CommentExample',
                'accepted_at'           => new DateTime(),
                'retired_at'            => null,
                'research_team_id'      => 1,
                'user_id'               => 4,
                'is_external'           => true,
                'authorization_letter'  => null
            ]
        ]);
    }
}
