<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalEnvironmentLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_environment_loans')->insert([
            [
                'id'                            => 2,
                'educational_environment_id'    => 1
            ]
        ]);
    }
}
