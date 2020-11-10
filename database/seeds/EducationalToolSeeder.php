<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educational_tools')->insert([
            [
                'id'                        => 1,
                'name'                      => 'Impresora 3D',
                'description'               => 'Description example',
                'qty'                       => 1,
                'is_available'              => true,
                'is_enabled'                => true,
                'educational_environment_id'=> 1
            ]
        ]);
    }
}
