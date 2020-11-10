<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loans')->insert([
            [
                'id'                    => 1,
                'start_date'            => '2020-01-01',
                'end_date'              => '2020-04-12',
                'is_returned'           => true,
                'is_accepted'           => true,
                'justification'         => 'Justification Example',
                'authorization_letter'  => 'AuthorizationExample',
                'annotation'            => 'AnnotationExample',
                'returned_at'           => '2020-04-12',
                'accepted_at'           => '2020-01-02',
                'project_id'            => 1
            ],
            [
                'id'                    => 2,
                'start_date'            => '2020-03-27',
                'end_date'              => '2020-04-08',
                'is_returned'           => true,
                'is_accepted'           => true,
                'justification'         => 'Justification Example',
                'authorization_letter'  => 'AuthorizationExample',
                'annotation'            => 'AnnotationExample',
                'returned_at'           => '2020-04-08',
                'accepted_at'           => '2020-03-27',
                'project_id'            => 1
            ]
        ]);
    }
}
