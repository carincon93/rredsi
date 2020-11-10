<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_environments')->insert([
            [
                'id'                        => 1,
                'name'                      => 'Sistemas 1',
                'type'                      => 'Salón',
                'capacity_aprox'            => 60,
                'description'               => 'Description text',
                'is_enabled'                => true,
                'is_available'              => true,
                'educational_institution_id'=> 1
            ]
        ]);
    }
}
