<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalInstitutionAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_institution_admins')->insert([
            [
                'id'        => 2,
                'node_id'   => 1,
            ]
        ]);
    }
}
