<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalToolLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_tool_loans')->insert([
            [
                'id'                    => 1,
                'educational_tool_id'   => 1
            ]
        ]);
    }
}
