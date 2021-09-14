<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statuses')->insert([
            'name' =>  'Created'
        ]);
        DB::table('statuses')->insert([
            'name' =>  'In Progress'
        ]);
        DB::table('statuses')->insert([
            'name' =>  'Completed'
        ]);
    }
}
